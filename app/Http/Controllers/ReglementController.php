<?php

namespace App\Http\Controllers;

use App\Reglement;
use App\Facture;
use App\Locataire;
use App\Location;
use App\Appliquer;
use App\Compte;
use App\Quittance;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReglementController extends Controller
{
   
	public function index()
    {
        $factures = Facture::where('archiver',0)->orderBy('id', 'DESC')->get();
        $locataires = Locataire::orderBy('nom', 'ASC')->get();
        $locations = Location::orderBy('ref', 'ASC')->get();
        $reglements = Reglement::where('archiver',0)->orderBy('created_at', 'DESC')->get();
        $appliquers = Appliquer::get();

        return view('pages.reglement', compact('factures', 'locations', 'locataires', 'reglements', 'appliquers'));
    }
	
	
	public function rech_location(Request $request)
    {	
		$locataire_id = $request->var_id;
      
        $locations = Location::orderBy('ref', 'ASC')->where('locataire_id', $locataire_id)
			->where('archiver', 0)
			->where('etat', 'En cours')
			->get();
	 
	 
	 	$mabox = '';
	 	$mabox .= '<select class="form-control" id="location_rech_recu_id" name="location_rech_recu_id" onChange="method_rech_bail()">';
		
		$mabox .= '<option value="">Choisir bail</option>';
		foreach($locations as $var){
			$mabox .= '<option value="'.$var->id.'">';
			$mabox .= $var->ref.' ('.$var->bien->libelle.')';
			$mabox .= '</option>';
		}

		$mabox.= '</select>';
		
		
		return $mabox;
    }
	
	public function rech_facture(Request $request)
    {	
		$var_id = $request->var_id;
		
        $factures = Facture::orderBy('ref', 'ASC')->where('location_id', $var_id)
			->where('archiver', 0)
			->get();
		
		$mabox = '';
		
	 	$mabox .= '<select class="form-control" id="facture_rech_id" name="facture_rech_id" onChange="method_rech_montant()">';
		$mabox .= '<option value="">Choisir bail</option>';
		foreach($factures as $var){
			$mabox .= '<option value="'.$var->id.'">';
			$mabox .= $var->ref.' ('.$var->nature.')';
			$mabox .= '</option>';
		}
		$mabox.= '</select>';
		
		return $mabox;
        
    }
	
	public function montant(Request $request)
    {	
		$var_id = $request->var_id;
		
        $facture = Facture::where('id', $var_id)
			->where('archiver', 0)
			->first();
			
		return $facture;
    }
	
	
	public function store(Request $request)
    {   
        $id = $request->r_facture_id;
        $facture = Facture::whereId($id)->first();
		//echo $id; exit();
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
            'montant' => $request->montant,
            'date_reglement' => $request->date_reglement,
            'user_id' => $request->ruser_id,
            'user_nom' => $request->ruser_nom
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
        }

        return redirect()->back()->withOk('Ajouté avec succès');
    }
    

    public function delete(Request $request)
    {
        $id_nvo = $request->id_nvo;
		$var_id= $request->var_id;
		
        Reglement::where('id', $var_id)->update(['archiver' => $id_nvo]);
		
		return $id_nvo;
    }

	public function reglement_print(Request $request, $id)
    {
        $reglement = Reglement::where('id', $id)->first();
        //return view('pages.reglement_print', compact('reglement')); 

        $pdf = PDF::loadView('pages.reglement_print', compact('reglement'));
		
		$nom ='Reçu - '.$reglement->ref.' - '.date('dmY');

         return $pdf->download($nom.".pdf");

    }
	
	public function reglement_print_direct(Request $request, $id)
    {
        $reglement = Reglement::where('id', $id)->first();
        return view('pages.reglement_print', compact('reglement')); 

      
    }

	
	
}
