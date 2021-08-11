<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Appartenir;
use App\Bien;
use App\Des_element;
use App\Equiper;
use App\Equiper_descript;
use App\Local_element;
use App\Location;
use App\Mandat;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MandatController extends Controller
{
    public function index()
    {
        $biens = DB::table('biens')->where('etat_mandat', 0)->get();
        $mandats = Mandat::orderBy('id', 'desc')->where('archiver', 0)->where('mandat_vente', 0)->get();

        return view('pages.mandat', compact('biens', 'mandats'));
    }

    public function create()
    {
        $props = DB::table('proprietaires')->where('archiver', 0)->where('en_vente', 0)->get();

        return view('pages.mandat_create', compact('props'));
    }

    public function search(Request $request)
    {
        $prop_id = $request->prop_id;

        $appars = Appartenir::where('proprietaire_id', $prop_id)->get();

        $mabox = '<select class="form-control" id="bien_id" name="bien_id" onChange="method_quittance()">';

        $mabox .= '<option value="">Choisir bien</option>';

        foreach ($appars as $appar) {
            //if($appar->bien->immeuble_id != 0){

            $mabox .= '<option value="'.$appar->bien->id.'">';

            $mabox .= $appar->bien->libelle;

            $mabox .= '</option>';
            //}
        }

        $mabox .= '</select>';

        return $mabox;
    }

    public function store(Request $request)
    {
        //echo $request->bien_id; exit();

        $app_nb = Appartenir::where('bien_id', $request->bien_id)->count();
        if ($app_nb == 0) {
            return redirect()->back()->withOk("Désolé! Ce bien n'a pas encore de propriétaire.");
        }

        $mandat_nb = DB::table('mandats')->where('archiver', 0)->where('bien_id', $request->bien_id)->count();

        if ($mandat_nb > 0) {
            return redirect()->back()->withOk('Désolé! Ce bien a un mandat en cours. Pour créer un nouveau mandat de ce bien, veuillez archiver l ancien. ');
        }

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
                'impot' => $request->impot,
                'type_mandat' => $request->type_mandat,
                'ref' => $ref,
                'date_enregistrement' => $request->date_enregistrement,
                'commission' => $request->commission,
                'honnoraire' => $request->honnoraire,
                'date_prise_effet' => $request->date_prise_effet,
                'nbre_renouvellement' => $request->nbre_renouvellement,
                'frequence_compte_rendu' => $request->frequence_compte_rendu,
                'duree' => $request->duree,
                'doc1' => $fileName1 ? $fileName1 : '',
                'doc2' => $fileName2 ? $fileName2 : '',
                'frais_cloture' => $request->frais_cloture,
                'detail' => $request->detail,
            ]);

        $id = $mandat->bien_id;
        Bien::where('id', $id)->update(['mandat' => 1]);

        return redirect('mandat/'.$mandat->id)->withOk('Ajouté avec succès');
    }

    public function show($id)
    {
        $mandat = Mandat::where('id', $id)->first();

        //echo $mandat->id; exit();
        $biens = Bien::where('id', '')->first();
        $appartenirs = Appartenir::where('bien_id', $mandat->bien->id)->get();

        return view('pages.mandat_detail', compact('mandat', 'appartenirs'));
    }

    public function edit($id)
    {
        $mandat = Mandat::whereId($id)->first();

        return view('pages.mandat_edit', compact('mandat'));
    }

    public function update(Request $request)
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

                'duree' => $request->duree,
            ]);

        return redirect('mandat/'.$id)->withOk('Modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive(Request $request)
    {
        $id_nvo = $request->id_nvo;
        $var_id = $request->var_id;

        Mandat::where('id', $var_id)->update(['archiver' => $id_nvo]);

        return $id_nvo;
    }

    // **** affichage des details du mandat ******************//
    public function mandatdetail_affiche(Request $request, $id)
    {
        $mandats = Mandat::where('id', $id)->get();
        $biens = Bien::where('id', '')->first();

        return view('pages.mandat_detail', compact('mandats'));
    }

    //  *********** gestion des fichers d'impression et de pdf de mandat *****************//
    public function mandat_imprimer(Request $request, $id)
    {
        $mandats = Mandat::where('id', $id)->first();
        $proprietaire = Appartenir::where('bien_id', $mandats->bien_id)->get();
        $location = Location::where('bien_id', $mandats->bien_id)->first();

        $equipers = Equiper_descript::where('bien_id', $mandats->bien_id)->get();
        $elements =Des_element::get();

        if (isset($location->loyer)) {
            $loyer = $location->loyer;
        } else {
            $loyer = 'pas de bail';
        }

        $typemandat = $mandats->type_mandat;
        $agence = Agence::whereId(1)->first();

        if ($typemandat == 'Commercial') {
            // $venteid = $vente->id;
            $mandat_comms = Mandat::where('type_mandat', $typemandat)->first();
            $pdf = PDF::loadView('pages.mandat_print_commerciale', compact('elements','equipers','mandats','proprietaire','agence',
            'typemandat', 'mandat_comms', 'loyer'));
            $nom = 'MC - '.$mandats->ref.' - '.date('dmY');

            return $pdf->download($nom.'.pdf');

        // return $pdf->stream('mandat_commerciale.pdf');
        } else {
            $mandat_habis = Mandat::where('type_mandat', $typemandat)->first();
            $pdf = PDF::loadView('pages.mandat_print_habitation', compact('elements','equipers','mandats','proprietaire','agence',
             'typemandat', 'mandat_habis', 'loyer'));
            $nom = 'MH - '.$mandats->ref.' - '.date('dmY');

            return $pdf->download($nom.'.pdf');

            // return $pdf->stream('mandat_habitation.pdf');
        }
    }

    public function mandat_imprimer_direct(Request $request, $id)
    {
        $mandats = Mandat::where('id', $id)->first();
        $proprietaire = Appartenir::where('bien_id', $mandats->bien_id)->get();
        $location = Location::where('bien_id', $mandats->bien_id)->first();

        $equipers = Equiper_descript::where('bien_id', $mandats->bien_id)->get();
        $elements =Des_element::get();

        if (isset($location->loyer)) {
            $loyer = $location->loyer;
        } else {
            $loyer = 'pas de bail';
        }

        $typemandat = $mandats->type_mandat;
        $agence = Agence::whereId(1)->first();


        if ($typemandat == 'Commercial') {
            // $venteid = $vente->id;
            $mandat_comms = Mandat::where('type_mandat', $typemandat)->first();

            return view('pages.mandat_print_commerciale', compact('elements','equipers','mandats','proprietaire','agence',
            'typemandat', 'mandat_comms', 'loyer'));
            $nom = 'MC - '.$mandats->ref.' - '.date('dmY');

            return $pdf->download($nom.'.pdf');
        } else {
            $mandat_habis = Mandat::where('type_mandat', $typemandat)->first();

            return view('pages.mandat_print_habitation', compact('elements','equipers','mandats','proprietaire','agence',
             'typemandat', 'mandat_habis', 'loyer'));
            $nom = 'MH - '.$mandats->ref.' - '.date('dmY');

            return $pdf->download($nom.'.pdf');
        }
    }

    public function delete(Request $request)
    {
        $id_nvo = $request->id_nvo;
        $var_id = $request->var_id;

        Location::where('id', $var_id)->update(['archiver' => $id_nvo]);

        return 'OK';
    }
}
