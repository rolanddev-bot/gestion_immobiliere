<?php

namespace App\Http\Controllers;

use App\Acheter;
use App\Appartenir;
use App\Banque;
use App\Bien;
use App\Commune;
use App\Element;
use App\Equipement;
use App\Equiper;
use App\Immeuble;
use App\Local_element;
use App\Locataire;
use App\Location;
use App\Mandat;
use App\Proprietaire;
use App\Reglementvente;
use App\Typebien;
use App\Vente;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locataires = DB::table('locataires')->get();
        $biens = Bien::where('etat_vente', 'non vendu')->get();
        $ventes = Vente::orderBy('id', 'desc')->get();
        $acheters = Acheter::get();

        //$ventes = DB::table('ventes')->get();

        return view('pages.vente', compact('locataires', 'biens', 'ventes', 'acheters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function acheteur()
    {
        $locataires = DB::table('locataires')->get();
        //  $arr['data'] = Locataire::orderBy('id', 'asc')->get();

        // return json_encode($arr);
        $ach = '<div class="row">
        <strong>Acheteur <b style="color: red;">*</b></strong>
        <select name="acheteur[]" id="acheteur" class="form-control col-md-6">
         <option value="">Acheteur</option>';
        foreach ($locataires as $locataire) {
            $ach .= '<option value="'.$locataire->id.'">'.$locataire->nom.' '.$locataire->nom.'</option>';
        }
        $ach .= '</select>
            &nbsp;&nbsp; &nbsp;
            <a href="javascript:void(0)" id="supprimer_acheteur" style="font-size:20px;"class="col-md-2 btn btn-danger"> <i class="fas fa-times" > </i></a>
            </div> <br> ';

        return $ach;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
             'pu' => 'required',
             'date_vente' => 'required',
             //'acheteur' => 'required',
             ]);

        $brand = '#V';
        $cur_date = date('m-y');
        $invoice = $brand.$cur_date;
        $vente = rand(000, 999);
        $Refvente = $invoice.$vente.'#';

        $montant_ht = $request->pu;
        $remise = $request->remise;
        $tva = $request->tva;
        $montant_remise = ($montant_ht * $remise) / 100;
        $mtva = $montant_ht - $montant_remise;
        $montantht_tva = ($mtva * $tva) / 100;
        $montant_ttc = $montant_ht - $montant_remise + $montantht_tva;

        if ($request->vente_id == '') {
            $data = Vente::create([
                 'reference' => $Refvente,
                 'tva' => $request->tva,
                 'bien_id' => $request->bien_vente,
                 'prix_unitaire' => $request->pu,
                 'remise' => $request->remise,
                 'date_vente' => $request->date_vente,
                 'commentaire' => $request->commentaire,
                 'montant_total' => $montant_ttc,
                 'reste_payer' => $montant_ttc,
                 'payer' => 0,
                 'statut' => 'non soldé',
                ]);

            $id = $data->id;
            $idbien = $data->bien_id;
            Bien::where('id', $idbien)->update([
                    'etat_vente' => 'vendu',
                ]);

            $nbre_acheteur = count($request->acheteur);

            // return $request->acheteur;
            if ($nbre_acheteur > 0) {
                foreach ($request->acheteur as $item => $v) {
                    $data2 = [
                    'vente_id' => $id,
                    'locataire_id' => $request->acheteur[$item],
            ];
                    Acheter::insert($data2);
                }
            }

            return $Refvente;
        }

        // return $nbre_acheteur;
        else {
            Vente::where('id', $request->vente_id)->update([
               'tva' => $request->tva,
               'bien_id' => $request->bien_vente,
               'prix_unitaire' => $request->pu,
               'remise' => $request->remise,
               'date_vente' => $request->date_vente,
               'commentaire' => $request->commentaire,
               'montant_total' => $montant_ttc,
           ]);

            return 'edit_vente';
        }

        return response()->json();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    //*********************vente detail**************************
    public function show(Request $request, $id)
    {
        $acheters = Acheter::where('vente_id', $id)->get();
        $vente = Vente::where('id', $id)->first();
        $locataires = DB::table('locataires')->get();

        return view('pages.vente_detail', compact('acheters', 'vente', 'locataires'));
    }

    public function createdetail(Request $request)
    {
        if ($request->acheter_id == '') {
            //ggggggggggggg
            $nbre_acheteur = count($request->acheteur);

            // return $request->acheteur;
            if ($nbre_acheteur > 0) {
                foreach ($request->acheteur as $item => $v) {
                    $data2 = [
                    'vente_id' => $request->vente_id,
                    'locataire_id' => $request->acheteur[$item],
            ];
                    Acheter::insert($data2);
                }
            }
            // $biens = Bien::orderBy('id', 'desc')->get();
            //  $ventes = Vente::where('id', $request->vente_id)->get();
            // $acheters = Acheter::where('vente_id', $request->vente_id)->get();
            // $locataires = DB::table('locataires')->get();

            return redirect()->route('vente_detailaffiche', ['id' => $request->vente_id]);
        }
    }

    public function updatedetail(Request $request)
    {
        Acheter::where('id', $request->acheter_idm)->update([
            'locataire_id' => $request->acheteurm,
        ]);

        return redirect()->route('vente_detailaffiche', ['id' => $request->vente_idm]);
    }

    public function deletedetail($acheter_id, $vente_id)
    {
        Acheter::where('id', $vente_id)->delete();

        return redirect()->route('vente_detailaffiche', ['id' => $acheter_id]);
    }

    ////************************* debut gestion des reglements de la vente***************************** */

    public function ventereglementaffiche(Request $request)
    {
        return $this->ajournervente($request->vente_id);
    }

    public function reglementventeajouter(Request $request)
    {
        $id = $request->vente_id_reglement;
        $montantvente = Vente::where('id', $id)->value('montant_total');
        $reglementvente_mt = Reglementvente::where('vente_id', $id)->sum('montant_reglement');
        $parametre = $montantvente - ($reglementvente_mt + $request->reglement_montant_vente);
        if ($parametre < 0) {
            return 'pas possible';
        }
        $data = Reglementvente::create([
            'vente_id' => $id,
            'montant_reglement' => $request->reglement_montant_vente,
            'date_reglement' => $request->reglement_datereglt_vente,
            'user_id' => $request->user_id_reglement,
            'user_nom' => $request->user_nom_reglement,
            ]);

        $montantreg = $data->montant_reglement + $reglementvente_mt;
        // $restepayer = $montantvente - $montantreg;
        if ($parametre > 0) {
            $etats = 'non soldé';
        } else {
            $etats = 'soldé';
        }

        Vente::where('id', $id)->update([
            'payer' => $montantreg,
            'reste_payer' => $parametre,
            'statut' => $etats,
        ]);

        return $this->ajournervente($id);
    }

    public function ajournervente($var)
    {
        $vente = Vente::where('id', $var)->first();

        $reglements = Reglementvente::where('vente_id', $var)->get();

        $reglements_mt = Reglementvente::where('vente_id', $var)->sum('montant_reglement');

        $nap = abs($vente->montant_total - $reglements_mt);
        $res = '';
        $etat = '';
        $avoir = 0;

        if ($vente->montant_total == $reglements_mt) {
            $res = 0;
            $etat = 'Soldé';
            $avoir = 0;
        } elseif ($vente->montant_total > $reglements_mt) {
            $res = $nap;
            $etat = 'Non soldé';
            $avoir = 0;
        } elseif ($vente->montant_total < $reglements_mt) {
            $res = 0;
            $etat = 'Soldé';
            $avoir = $nap;
        }

        $i = 1;
        $rglt = '<table style="margin:auto; width:100%" id="tab_reglement" border="1" >';
        $rglt .= '<thead class="bg-warning"><tr><td>N°</td><td>Montant Versé</td><td>Date</td><td>Agent (ID)</td><td>Action</td></tr></thead>';
        foreach ($reglements as $reglement) {
            $rglt .= '<tr><td>'.$i++.'</td><td>'.$reglement->montant_reglement.'</td><td>'.$reglement->date_reglement.'</td><td>
            '.$reglement->user_nom.'</td><td>
            <a href="reglementventequittance/'.$reglement->id.'" id="quittanceReglementvente" data-reglementvente_id="'.$reglement->id.'">Imprimer </a></td></tr>';
        }

        $rglt .= '<tr ><td colspan="2">Total Versé: <span class="text-danger">'.$reglements_mt.'
        </td><td colspan="2">Total restant: <span class="text-danger">'.$res.'</span></td>';
        $rglt .= '</tr></table>';

        return $rglt;
    }

    //  ****************  suppression d'un reglement et mise a jour des paiement ***********************//
    public function reglementventedelete(Request $request)
    {
        $reglementvente = Reglementvente::where('id', $request->id)->first();
        $vente_id = $reglementvente->vente_id;
        $montant_supp = $reglementvente->montant_reglement;

        $montantvente = Vente::where('id', $vente_id)->value('montant_total');
        $reglementvente_mt = Reglementvente::where('vente_id', $request->id)->sum('montant_reglement');
        $payer = $reglementvente_mt - $montant_supp;
        $monrestepayer = $montantvente - $payer;

        Vente::where('id', $vente_id)->update([
            'payer' => $payer,
            'reste_payer' => $monrestepayer,
            'statut' => 'non soldé',
        ]);

        Reglementvente::where('id', $request->id)->delete();

        return $this->ajournervente($vente_id);
    }

    // ********************************* gestion des quittance de la vente ****************************************//
    public function reglementventequittance(Request $request, $id)
    {
        $reglements = Reglementvente::where('id', $id)->first();
        $venteid = $reglements->vente_id;
        $infosventes = Acheter::where('vente_id', $venteid)->first();
        $pdf = PDF::loadView('pages.ventereglement_quittance', compact('reglements', 'infosventes'));

        return $pdf->download('quittance.pdf');
    }

    public function listevente_pdf()
    {
        $ventes = Vente::orderBy('id', 'desc')->get();
        $acheters = Acheter::get();
        $pdf = PDF::loadView('pages.vente_pdf', compact('ventes', 'acheters'));

        return $pdf->download('liste_vente.pdf');
    }

    public function vente_facture($id)
    {
        $vente = Vente::where('id', $id)->first();
        $venteid = $vente->id;
        $acheter = Acheter::where('vente_id', $venteid)->first();
        $pdf = PDF::loadView('pages.vente_facture', compact('vente', 'acheter'));

        return $pdf->download('vente_facture.pdf');
    }

    public function proprietaire_vente()
    {
        $proprietaire = Proprietaire::where('archiver', 0)->where('en_vente', 1)->orderBy('nom', 'ASC')->get();

        return view('pages.proprietaire_vente', compact('proprietaire'));
    }

    public function proprietaire_v_create()
    {
        $banques = Banque::orderBy('libelle', 'ASC')->get();

        return view('pages.proprietaire_vente_create', compact('banques'));
    }

    public function proprietaire_v_store(Request $request)
    {
        if ($request->hasfile('documents')) {   //c'est le registre de commerce
            $datadoc = [];
            foreach ($request->file('documents') as $file) {
                $name = time().'-'.$file->getClientOriginalName();
                $datadoc[] = $name;
                $file->move(public_path().'/assets/dossier/', $name);
            }
        } else {
            $datadoc = [];
        } ///////////////////*********************////////////////////////////// */

        //////////////****************************** *////////////////////
        if (isset($request->photo)) {
            $file = $request->photo;
            $fileName = $file->getClientOriginalName();
            $file->move(public_path().'/assets/dossier/', $fileName);
        } else {
            $fileName = 'aucun';
        }

        Proprietaire::create([
            'nom' => strtoupper($request->nom),
           'prenom' => ucwords($request->prenom),
           'type_proprietaire' => $request->type_proprietaire,
           'emailto' => $request->email,
           'mobile1' => $request->mobile1,
            'mobile2' => $request->mobile2,
           'date_naissance' => $request->date_naissance,
           'sexe' => $request->sexe,
           'type_piece' => $request->type_piece,
           'numero_piece' => $request->numero_piece,
           'photo' => $fileName,
          // 'image_piece' => json_encode($dataimage),
           'document' => json_encode($datadoc),  //c'est le registre de commerce
           'telephone' => $request->telephone,

           'adresse' => $request->adresse,
           'nom_societe' => ucwords($request->nom_societe),
           'numero_registre' => $request->numero_registre,
           'telephone_societe' => $request->telephone_societe,
           'adresse_societe' => $request->adresse_societe,
           'nom_representant' => ucwords($request->nom_representant),  // c'est le nom et le prenom
           'contact1_representant' => $request->contact1_representant,
           'contact2_representant' => $request->contact2_representant,

            'compte_contribuable' => $request->compte_contribuable ? $request->compte_contribuable : '',
           'compte_bancaire' => $request->compte_bancaire ? $request->compte_bancaire : '',
            'banque_id' => $request->banque_id ? $request->banque_id : 1,
            'en_vente' => $request->en_vente,
          ]);

        //$id_max = Proprietaire::max('id');

        return redirect('proprietaire_vente')->withOk('Ajouté avec succès!');
    }

    public function proprietaire_v_edit($id)
    {
        $prop = Proprietaire::where('id', $id)->first();
        $banques = Banque::orderBy('libelle', 'ASC')->get();

        return view('pages.proprietaire_v_edit', compact('prop', 'banques'));
    }

    public function proprietaire_v_update(Request $request)
    {
        $fileName = 'aucun';

        if (isset($request->photo)) {
            $file = $request->photo;
            $fileName = $file->getClientOriginalName();
            $file->move(public_path().'/assets/dossier/', $fileName);
        }

        Proprietaire::where('id', $request->prop_id)->update([
            'nom' => strtoupper($request->nom),
            'prenom' => ucwords($request->prenom),
            'type_proprietaire' => $request->type_proprietaire,
            'emailto' => $request->email,
            'sexe' => $request->sexe,
            'adresse' => $request->adresse,
            'type_piece' => $request->type_piece,
            'numero_piece' => $request->numero_piece,
            'date_naissance' => $request->date_naissance,

            'mobile1' => $request->mobile1,
            'mobile2' => $request->mobile2,
            'telephone' => $request->telephone,

            'photo' => $fileName,
            'nom_societe' => ucwords($request->nom_societe),
            'numero_registre' => $request->numero_registre,
            'telephone_societe' => $request->telephone_societe,
            'adresse_societe' => $request->adresse_societe,
            'nom_representant' => ucwords($request->nom_representant),  // c'est le nom et le prenom
            'contact1_representant' => $request->contact1_representant,
            'contact2_representant' => $request->contact2_representant,

            'compte_contribuable' => $request->compte_contribuable ? $request->compte_contribuable : '',
            'compte_bancaire' => $request->compte_bancaire ? $request->compte_bancaire : '',
            'banque_id' => $request->banque_id ? $request->banque_id : 1,
        ]);

        return redirect('proprietaire_vente')->withOk('Modifié avec succès!');
    }

    public function proprietaire_v_show($id)
    {
        $prop = Proprietaire::whereId($id)->first();
        $apparts = Appartenir::where('proprietaire_id', $prop->id)->get();

        return view('pages.proprietaire_v_show', compact('prop', 'apparts'));
    }

    public function mandat_vente()
    {
        $biens = DB::table('biens')->where('etat_mandat', 0)->get();
        $mandats = Mandat::orderBy('id', 'desc')->where('archiver', 0)->where('mandat_vente', 1)->get();

        return view('pages.mandat_vente', compact('biens', 'mandats'));
    }

    public function mandat_vente_create()
    {
        $props = DB::table('proprietaires')->where('archiver', 0)->where('en_vente', 1)->get();
        return view('pages.mandat_vente_create', compact('props'));
    }

    public function mandat_vente_store(Request $request)
    {
        $fileName1 = '';
        $fileName2 = '';

        if (isset($request->doc1)) {
            $file = $request->doc1;
            $fileName1 = $file->getClientOriginalName().time();
            $file->move(public_path().'/assets/dossier/Mandat_doc', $fileName1);
        }

        if (isset($request->doc2)) {
            $file = $request->doc1;
            $fileName2 = $file->getClientOriginalName().time();
            $file->move(public_path().'/assets/dossier/Mandat_doc', $fileName2);
        }

        $mandat_id = DB::table('mandats')->max('id');

        $code = '';
        $num = $mandat_id + 1;

        if (strlen($num) == 1) {
            $code = '00'.$num;
        } elseif (strlen($num) == 2) {
            $code = '0'.$num;
        } else {
            $code = $num;
        }

        $ref = 'SP-'.$code.'-'.date('Y');

        $mandat = Mandat::create([
                'bien_id' => $request->bien_id,
                'ref_reversement_loyer' => $ref,
                'mandat_vente' => $request->mandat_vente,
                'valeur_bien' => $request->valeur_bien,
               // 'type_mandat' => $request->type_mandat,
                'ref' => $ref,
                'date_enregistrement' => $request->date_enregistrement,
                'commission' => $request->commission,
               // 'honnoraire' => $request->honnoraire,
                'date_prise_effet' => $request->date_prise_effet,
                'nbre_renouvellement' => $request->nbre_renouvellement,
                //'frequence_compte_rendu' => $request->frequence_compte_rendu,
                //'duree' => $request->duree,
                'doc1' => $fileName1 ? $fileName1 : '',
                'doc2' => $fileName2 ? $fileName2 : '',
                'frais_cloture' => $request->frais_cloture,
                'detail' => $request->detail,
            ]);

        $id = $mandat->bien_id;
        Bien::where('id', $id)->update(['mandat' => 1]);

        return redirect('mandat_vente')->withOk('Ajouté avec succès');
    }


    public function mandat_vente_edit($id)
    {
		$mandat = Mandat::whereId($id)->first();

		return view('pages.mandat_vente_edit', compact('mandat'));
    }



    public function mandat_vente_show($id)
    {
        $mandat = Mandat::where('id', $id)->first();
		//echo $mandat->id; exit();
        $biens = Bien::where('id', '')->first();
		$appartenirs =Appartenir::where('bien_id', $mandat->bien->id)->get();
        return view('pages.mandat_vente_detail', compact('mandat', 'appartenirs'));
    }



    public function mandat_vente_update(Request $request)
    {
		$id = $request->mandat_id;


            Mandat::where('id', $id)->update([

                //'bien_id' => $request->bien_id,
                 'type_mandat' => $request->type_mandat,
                 'date_enregistrement' => $request->date_enregistrement,
                 'commission' => $request->commission,
                 'honnoraire' => $request->honnoraire,
				 'impot' => $request->impot,

				 'frais_cloture' => $request->frais_cloture,

                 'date_prise_effet' => $request->date_prise_effet,
                 'date_enregistrement' => $request->date_enregistrement,
                 'nbre_renouvellement' => $request->nbre_renouvellement,
                 'frequence_compte_rendu' => $request->frequence_compte_rendu,
                'duree' => $request->duree
            ]);

		return redirect('mandat_vente_show/'.$id)->withOk('Modifié avec succès');
    }

    // gestion des biens en vente

    public function bien_vente()
    {
        $biens = Bien::where('archiver', 0)->where('typebien_id', 1)->where('a_vendre', 1)->orderBy('typebien_id', 'ASC')->get();

        return view('pages.bien_vente', compact('biens'));
    }

    public function bien_appart_vente()
    {
        $biens = Bien::where('archiver', 0)->where('typebien_id', 3)->where('a_vendre', 1)->get();

        return view('pages.bien_appart_vente', compact('biens'));
    }

    public function bien_maison_vente()
    {
        $biens = Bien::where('archiver', 0)->where('typebien_id', 2)->where('a_vendre', 1)->get();

        return view('pages.bien_maison_vente', compact('biens'));
    }

    public function bien_immeuble_vente()
    {
        $biens = Bien::where('archiver', 0)->where('typebien_id', 4)->where('a_vendre', 1)->get();

        return view('pages.bien_immeuble_vente', compact('biens'));
    }

    public function bien_commerce_vente()
    {
        $biens = Bien::where('archiver', 0)->where('typebien_id', 5)->where('a_vendre', 1)->get();

        return view('pages.bien_commerce_vente', compact('biens'));
    }

    //************ appel de la page de creation du bien en fonction du menu de bien au niveau de la vente**** */
    public function catvente($id)
    {
        $typebien = Typebien::whereId($id)->first();
        $biens = Bien::orderBy('libelle', 'ASC')->where('typebien_id', $id)->where('archiver', 0)->get();
        $proprietaires = Proprietaire::where('archiver', 0)->where('en_vente', 1)->orderBy('nom', 'ASC')->get();

        return view('pages.bien_vente_create', compact('biens', 'typebien', 'proprietaires'));
    }

        //*************** script d'insertion des biens au niveau de la vente*************** */
    public function bien_vente_store(Request $request)
    {
        $bien_id = DB::table('biens')->max('id');
        $ref = $bien_id.'-'.date('m').date('y');
        $typebien_id = $request->typebien_id;
        $typebien = Typebien::whereId($typebien_id)->first();

        $immeuble_id = $request->immeuble_id;

        $proprietaires = $request->proprietaires;

        Bien::create([
            'ref' => $ref,
            'libelle' => $request->libelle,
            'a_vendre' => $request->a_vendre,
            'immeuble_id' => $request->immeuble_id ? $request->immeuble_id : 0,
            'immeuble' => $request->immeuble,
            'nbre_piece' => $request->nbre_piece ? $request->nbre_piece : 0,
            'surface_habitable' => $request->surface_habitable ? $request->surface_habitable : 0,
            'surface' => $request->surface ? $request->surface : 0,
            'type_commerce' => $request->type_commerce ? $request->type_commerce : '',
            'type_maison' => $request->type_maison ? $request->type_maison : '',
            'type_immeuble' => $request->type_immeuble ? $request->type_immeuble : '',

            'typebien_id' => $request->typebien_id,

            'adresse' => $request->adresse,
            'lot' => $request->lot,
            'ilot' => $request->ilot,
            'section' => $request->section,
            'parcelle' => $request->parcelle,

            'libre' => $request->libre ? 1 : 0,
            'meuble' => $request->meuble ? 1 : 0,
            'balcon' => $request->balcon ? 1 : 0,
            'cuisine' => $request->cuisine ? 1 : 0,
            'parking_externe' => $request->parking_externe ? 1 : 0,
            'parking' => $request->parking ? 1 : 0,
            'garage' => $request->garage ? 1 : 0,
            'piscine' => $request->piscine ? 1 : 0,
            'viabilise' => $request->viabilise ? 1 : 0,
            'terrasse' => $request->terrasse ? 1 : 0,
            'ascenseur' => $request->ascenseur ? 1 : 0,

            'detail' => $request->detail,
        ]);

        $msg = $typebien->libelle.' ajouté(e) avec succès!';

        if ($immeuble_id != '') {
            $msg = 'Appartement ajouté avec succès!';

            return redirect('bien_vente_detail/'.$immeuble_id)->withOk($msg);
        } else {
            $bien_id_max = Bien::max('id');
            $msg = 'Bien ajouté avec succès!';
            foreach ($proprietaires as $key => $pr) {
                Appartenir::create(['bien_id' => $bien_id_max, 'proprietaire_id' => $pr]);
            }

            return redirect('bien_vente_detail/'.$bien_id_max)->withOk($msg);
        }
    }


  //*************** appel de la page detail au niveau de la vente*************** */
    public function bien_vente_detail($id)
    {
        $bien = Bien::whereId($id)->first();

        $apparts = Bien::where('immeuble_id', $bien->id)->get();

		//Compter les apparts
		$app_1 = Bien::where('immeuble_id', $bien->id)->where('nbre_piece', 1)->count();
		$app_2 = Bien::where('immeuble_id', $bien->id)->where('nbre_piece', 2)->count();
		$app_3 = Bien::where('immeuble_id', $bien->id)->where('nbre_piece', 3)->count();
		$app_4 = Bien::where('immeuble_id', $bien->id)->where('nbre_piece', 4)->count();
		$app_5 = Bien::where('immeuble_id', $bien->id)->where('nbre_piece', 5)->count();


        $equipements = Equipement::orderBy('libelle', 'ASC')->get();
        $equipers = Equiper::where('bien_id', $id)->get();
        $locations = Location::where('bien_id', $id)->get();

        $elts = Local_element::get();
        $elements = Element::get();
        $appartenirs = Appartenir::where('bien_id', $id)->get();

        return view('pages.bien_vente_detail', compact('bien', 'equipers', 'equipements', 'elts', 'elements', 'locations', 'appartenirs', 'apparts', 'app_1', 'app_2', 'app_3', 'app_4', 'app_5'));
    }


//******** script d'appel de la page de modification des biens au niveau de la vente***/
    public function bien_vente_edit($id)
    {
        $bien = Bien::where('id', $id)->first();

		$typebien = Typebien::where('id', $bien->typebien_id)->first();
        $communes = Commune::orderBy('libelle', 'ASC')->get();
        $immeubles = Immeuble::orderBy('libelle', 'ASC')->get();

        $proprietaires = Proprietaire::orderBy('nom', 'ASC')->get();

		if($bien->immeuble_id !=0 AND $bien->typebien->id ==4)
		return view('pages.bien_appart_edit', compact('bien', 'typebien', 'communes', 'immeubles', 'proprietaires'));

        else
        return view('pages.bien_vente_edit', compact('bien', 'typebien', 'communes', 'immeubles', 'proprietaires'));
    }

    // ************script de modification des biens au niveau de la vente************

    public function bien_vente_update(Request $request){

        $id = $request->bien_id;
		$immeuble_id = $request->immeuble_id;
		//echo $id; exit();
	 Bien::where('id', $id)->update([
     'typebien_id' => $request->typebien_id,
	'libelle' => $request->libelle,
	'immeuble' => $request->immeuble,
	'immeuble_id' => $request->immeuble_id?$request->immeuble_id:'',
	'nbre_piece' => $request->nbre_piece?$request->nbre_piece:0,
	'surface_habitable' => $request->surface_habitable?$request->surface_habitable:0,
	'surface' => $request->surface?$request->surface:0,
	'type_commerce' => $request->type_commerce?$request->type_commerce:'',
	'type_maison' => $request->type_maison?$request->type_maison:'',
	'type_immeuble' => $request->type_immeuble?$request->type_immeuble:'',

	'adresse' => $request->adresse,
	'lot' => $request->lot,
	'ilot' => $request->ilot,
	'section' => $request->section,
	'parcelle' => $request->parcelle,


	'libre' => $request->libre ? 1 : 0,
	'meuble' => $request->meuble ? 1 : 0,
	'balcon' => $request->balcon ? 1 : 0,
	'cuisine' => $request->cuisine ? 1 : 0,
	'parking_externe' => $request->parking_externe ? 1 : 0,
	'parking' => $request->parking ? 1 : 0,
	'garage' => $request->garage ? 1 : 0,
	'piscine' => $request->piscine ? 1 : 0,
	'viabilise' => $request->viabilise ? 1 : 0,
	'terrasse' => $request->terrasse ? 1 : 0,
	'ascenseur' => $request->ascenseur ? 1 : 0,

	'detail' => $request->detail

        ]);
		//Redirection

        if($immeuble_id != 0)

        	return redirect('bien_vente_detail/'.$immeuble_id)->withOk('Appartement modifié avec succès!');

		else
           // return redirect('bien_vente_detail/'.$id)->withOk('Bien modifié avec succès!');

            return redirect('bien_vente_detail/'.$id)->withOk('Bien modifié avec succès!');
    }


}
