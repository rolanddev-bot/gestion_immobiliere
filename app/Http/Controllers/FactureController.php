<?php

namespace App\Http\Controllers;


use App\Facture;
use App\Locataire;
use App\Location;
use App\Reglement;
use App\Appliquer;
use App\Compte;
use App\Quittance;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Repositories\FactureRepository;

use Illuminate\Http\Request;

class FactureController extends Controller
{
    protected $locationRepository;

    public function __construct(FactureRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function index()
    {
        $factures = Facture::orderBy('id', 'DESC')->where('archiver', 0)->get();
        $locataires = Locataire::orderBy('nom', 'ASC')->get();
        $locations = Location::orderBy('ref', 'ASC')->get();
        $reglements = Reglement::orderBy('created_at', 'DESC')->get();
        $appliquers = Appliquer::get();

        return view('pages.facture', compact('factures', 'locations', 'locataires', 'reglements','appliquers'));
    }

    //Champ select
    public function rech_locataire(Request $request)
    {
        $locations = Location::where('locataire_id', $request->locataire_rech_id)->get();

        $mabox = '<select class="form-control" id="location_id" name="location_id" required>';

       // $mt_charge =0;


        $loyer = 0;
        $appliquers = Appliquer::get();
        foreach ($locations as $location) {
            $mt_charge =0;
            foreach($appliquers as $appliquer){
                if($location->id == $appliquer->location_id AND $appliquer->charge->type_charge == 'Locataire')

                $mt_charge = $mt_charge + $appliquer->montant_charge;
            }

            $mabox .= '<option value="'.$location->id.'">';

            $loyer = $location->loyer + $mt_charge;
            $mabox .= $location->bien->libelle.' - '.$loyer.' FCFA';

            $mabox .= '</option>';

            $loyer = 0;
        }
        $mabox .= '</select>';

        return $mabox;
    }

    public function store(Request $request)
    {
        $facture_id = DB::table('factures')->max('id');

        $code = '';
        $num = $facture_id + 1;
        if (strlen($num) == 1) {
            $code = '00'.$num;
        } elseif (strlen($num) == 2) {
            $code = '0'.$num;
        } else {
            $code = $num;
        }

        $annee = date('Y');
        $ref = 'AE-'.$code.'-'.$annee;

        Facture::create([
            'ref' => $ref,
            'user_id' => $request->user_id,
            'user_nom' => $request->user_nom,
            'location_id' => $request->location_id,
            'nature' => $request->nature,
            'montant' => $request->montant,
            'autre' => $request->autre,
            'montant_lettre' => $request->montant_lettre,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'etat' => 0,
            'date_facture' => $request->date_facture
            ]);

        return 'OK';
    }

    public function update(Request $request)
    {
        Facture::where('id', $request->mfacture_id)->update([
            'nature' => $request->mnature,
            'montant' => $request->mmontant,
            'autre' => $request->mautre,
            'montant_lettre' => $request->mmontant_lettre,
            'date_debut' => $request->mdate_debut,
            'date_fin' => $request->mdate_fin,
            'etat' => 0,
            'date_facture' => $request->mdate_facture,
            ]);

        return 'Mise à jour effectuée avec succès!';

        //return $request->mfacture_id;
    }

    public function delete(Request $request)
    {
        $id_nvo = $request->id_nvo;
		$var_id= $request->var_id;

        Facture::where('id', $var_id)->update(['archiver' => $id_nvo]);

		return 'OK';
    }

    public function facturereglementaffiche(Request $request)
    {
        return $this->ajourner($request->facture_id);
    }

    public function reglementajouter(Request $request)
    {
        $id = $request->r_facture_id;
        $facture = Facture::whereId($id)->first();

        $num1 = $facture->location->id;

        $reglement_id = DB::table('reglements')->max('id');

        $code = ''; $code1 = ''; $code2=''; $num = $reglement_id + 1;

        if (strlen($num) == 1) { $code = '00'.$num;} elseif (strlen($num) == 2) { $code = '0'.$num; } else { $code = $num;}
        if (strlen($num1) == 1) { $code1 = '00'.$num1;} elseif (strlen($num1) == 2) { $code1 = '0'.$num1; } else { $code1 = $num1;}
        $an = date('Y');
        $ref = 'RL-'.$code1.'-'.$an.'-'.$code;




        //Créer règlement
        Reglement::create([
            'ref' => $ref,
            'facture_id' => $id,
            'montant' => $request->r_facture_montant2,
            'date_reglement' => $request->r_facture_datereglt,
            'user_id' => $request->ruser_id,
            'user_nom' => $request->ruser_nom,
            ]);

        $facture = Facture::where('id', $id)->first();
        $reglements_mt = Reglement::where('facture_id', $id)->sum('montant');

        $nap = abs($facture->montant - $reglements_mt);
        $res = 0;
        $etat = '';
        $avoir = 0;

        if ($facture->montant == $reglements_mt) {
            $res = 0;
            $etat = 'Soldé';
            $avoir = 0;
        } elseif ($facture->montant > $reglements_mt) {
            $res = $nap;
            $etat = 'Non soldé';
            $avoir = 0;
        } elseif ($facture->montant < $reglements_mt) {
            $res = 0;
            $etat = 'Soldé';
            $avoir = $nap;
        }

        //Créer compte
        Compte::create([
            'location_id' => $facture->location->id,
            'reste' => $res,
            'avoir' => $avoir,
            'etat' => $etat
        ]);


        //Créer la quittance
        if($etat == 'Soldé'){

            $quittance_id = DB::table('quittances')->max('id');

            $num_q = $quittance_id + 1;

            if (strlen($num_q) == 1) { $code2 = '00'.$num_q;} elseif (strlen($num_q) == 2) { $code2 = '0'.$num_q; }
            else { $code2 = $num_q;}

            $ref_quittance = 'QL-'.$code1.'-'.$an.'-'.$code2;


            Quittance::create([
                'ref' => $ref_quittance,
                'facture_id' => $id,
				'bien_id' => $facture->location->bien_id,
                'mois' =>  intval(date('m', strtotime($facture->date_debut))),
                'annee' =>  intval(date('Y', strtotime($facture->date_debut))),
                'date_quittance' => date('Y-m-d')
            ]);

			 Facture::where('id', $facture->id)->update(['etat' => 1]);
        }

        return $this->ajourner($id);
    }


    public function reglementdelete(Request $request)
    {
        $reglement = Reglement::where('id', $request->id)->first();
        $facture_id = $reglement->facture_id;

        Reglement::where('id', $request->id)->delete();

        return $this->ajourner($facture_id);
    }


    public function ajourner($var)
    {
        $facture = Facture::where('id', $var)->first();

        $reglements = Reglement::where('facture_id', $var)->get();

        $reglements_mt = Reglement::where('facture_id', $var)->sum('montant');

        $nap = abs($facture->montant - $reglements_mt);
        $res = '';
        $etat = '';
        $avoir = 0;

        if ($facture->montant == $reglements_mt) {
            $res = 0;
            $etat = 'Soldé';
            $avoir = 0;
        } elseif ($facture->montant > $reglements_mt) {
            $res = $nap;
            $etat = 'Non soldé';
            $avoir = 0;
        } elseif ($facture->montant < $reglements_mt) {
            $res = 0;
            $etat = 'Soldé';
            $avoir = $nap;
        }



        $rglt = '<table style="margin:auto; width:100%" id="tab_reglement" border="1" >';
        $rglt .= '<thead class="bg-warning"><tr><td>N°</td><td>Montant Versé</td><td>Date</td><td>Agent (ID)</td><td>Action</td></tr></thead>';

        foreach ($reglements as $reglement) {
            $rglt .= '<tr><td>'.$reglement->ref.'</td><td>'.strrev(wordwrap(strrev($reglement->montant), 3, ' ', true)).'</td><td>'.date('m/d/Y', strtotime($reglement->date_reglement)).'</td><td algn="center">
            '.$reglement->user_nom.'</td><td><a href="reglement-print/'.$reglement->id.'" tittle="Reçu de versement" id="reglement_print" data-reglement_id="'.$reglement->id.'">Imprimer</a>
            </td></tr>'
            ;
        }

        $rglt .= '<tr ><td colspan="2">Total Versé: <span class="text-danger">'.strrev(wordwrap(strrev($reglements_mt), 3, ' ', true)).'
        </td><td colspan="2">Total restant: <span class="text-danger">'.strrev(wordwrap(strrev($res), 3, ' ', true)).'</span></td><td colspan="">Avoir: <span class="text-danger">'.strrev(wordwrap(strrev($avoir), 3, ' ', true)).'</span></td>';
        $rglt .= '</tr></table>';

        return $rglt;
    }



    public function facture_print(Request $request, $id)
    {
        $facture = Facture::where('id', $id)->first();
        $location = Location::where('id', $facture->location_id)->first();
        $mt_charge = Appliquer::where('location_id', $facture->location_id)->sum('montant_charge');
        //return view('pages.facture_print1', compact('facture')); exit();
        $pdf = PDF::loadView('pages.facture_print', compact('facture', 'location','mt_charge'));

        return $pdf->download('facture.pdf');
    }




}
