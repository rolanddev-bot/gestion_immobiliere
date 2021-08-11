<?php

namespace App\Http\Controllers;

use App\Appartenir;
use App\Bien;
use App\Charge;
use App\Commune;
use App\Des_element;
use App\Description;
use App\Element;
use App\Equipement;
use App\Equiper;
use App\Equiper_descript;
use App\Equiper_descripts;
use App\Immeuble;
use App\Local_element;
use App\Location;
use App\Proprietaire;
use App\Typebien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BienController extends Controller
{
    public function index()
    {
        $biens = Bien::orderBy('libelle', 'ASC')->where('archiver', 0)->get();

        $typebiens = Typebien::orderBy('libelle', 'ASC')->get();
        $communes = Commune::orderBy('libelle', 'ASC')->get();
        $immeubles = Immeuble::orderBy('libelle', 'ASC')->get();

        $proprietaires = Proprietaire::orderBy('nom', 'ASC')->get();

        return view('pages.bien', compact('biens', 'typebiens', 'communes', 'immeubles', 'proprietaires'));
    }

    public function cat($id)
    {
        $typebien = Typebien::whereId($id)->first();
        $biens = Bien::orderBy('libelle', 'ASC')->where('typebien_id', $id)->where('archiver', 0)->where('a_vendre', 0)->get();

        return view('pages.bien', compact('biens', 'typebien'));
    }

    public function create($id)
    {
        $typebien = Typebien::whereId($id)->first();

        $proprietaires = Proprietaire::where('en_vente', 0)->orderBy('nom', 'ASC')->get();

        return view('pages.bien_create', compact('typebien', 'proprietaires'));
    }

    public function store(Request $request)
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
            'immeuble_id' => $request->immeuble_id ? $request->immeuble_id : 0,
            'immeuble' => $request->immeuble ? $request->immeuble : '',
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
            'non_viabilise' => $request->non_viabilise ? 1 : 0,
            'non_meuble' => $request->non_meuble ? 1 : 0,
            'occupe' => $request->occupe ? 1 : 0,

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

            return redirect('bien/'.$immeuble_id)->withOk($msg);
        } else {
            $bien_id_max = Bien::max('id');
            $msg = 'Bien ajouté avec succès!';
            foreach ($proprietaires as $key => $pr) {
                Appartenir::create(['bien_id' => $bien_id_max, 'proprietaire_id' => $pr]);
            }

            return redirect('bien/'.$bien_id_max)->withOk($msg);
        }
    }

    public function edit($id)
    {
        $bien = Bien::where('id', $id)->first();

        $typebien = Typebien::where('id', $bien->typebien_id)->first();
        $communes = Commune::orderBy('libelle', 'ASC')->get();
        $immeubles = Immeuble::orderBy('libelle', 'ASC')->get();

        $proprietaires = Proprietaire::orderBy('nom', 'ASC')->get();

        if ($bien->immeuble_id != 0 and $bien->typebien->id == 4) {
            return view('pages.bien_appart_edit', compact('bien', 'typebien', 'communes', 'immeubles', 'proprietaires'));
        } else {
            return view('pages.bien_edit', compact('bien', 'typebien', 'communes', 'immeubles', 'proprietaires'));
        }
    }

    public function update(Request $request)
    {
        $id = $request->bien_id;
        $immeuble_id = $request->immeuble_id;
        //echo $id; exit();

        Bien::where('id', $id)->update([
     'typebien_id' => $request->typebien_id,
    'libelle' => $request->libelle,
    'immeuble' => $request->immeuble ? $request->immeuble : '',
    'immeuble_id' => $request->immeuble_id ? $request->immeuble_id : '',
    'nbre_piece' => $request->nbre_piece ? $request->nbre_piece : 0,
    'surface_habitable' => $request->surface_habitable ? $request->surface_habitable : 0,
    'surface' => $request->surface ? $request->surface : 0,
    'type_commerce' => $request->type_commerce ? $request->type_commerce : '',
    'type_maison' => $request->type_maison ? $request->type_maison : '',
    'type_immeuble' => $request->type_immeuble ? $request->type_immeuble : '',

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

        //Redirection

        if ($immeuble_id != 0) {
            return redirect('bien/'.$immeuble_id)->withOk('Appartement modifié avec succès!');
        } else {
            return redirect('bien/'.$id)->withOk('Bien modifié avec succès!');
        }
    }

    public function show($id)
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
        $descriptions = Description::orderBy('libelle','ASC')->get();

        $equipers = Equiper::where('bien_id', $id)->get();
        $equipers_des = Equiper_descript::where('bien_id', $id)->get();

        $locations = Location::where('bien_id', $id)->get();


        $elts = Local_element::get();
        $elts_des = Des_element::get();

        $elements = Element::get();
        $des_elements = Des_element::get();
        $appartenirs = Appartenir::where('bien_id', $id)->get();

        return view('pages.bien_detail', compact('elts_des','des_elements','equipers_des','descriptions','bien', 'equipers', 'equipements', 'elts', 'elements', 'locations', 'appartenirs', 'apparts', 'app_1', 'app_2', 'app_3', 'app_4', 'app_5'));
    }

    public function equipercreate(Request $request)
    {
        Equiper::create([
            'bien_id' => $request->bien_id,
            'equipement_id' => $request->equipement_id,
            'detail' => $request->detail,
        ]);

        return redirect('bien/'.$request->bien_id)->withOk('Ajouté avec succès!');
    }

    //  **********************************gestion de description des biens ************************//
    public function descript_create(Request $request)
    {
        Equiper_descript::create([
            'bien_id' => $request->bien_id,
            'description_id' => $request->description_id,
            'detail' => $request->detail,
        ]);

        return redirect('bien/'.$request->bien_id)->withOk('Ajouté avec succès!');
    }

    public function equipersup(Request $request, $id)
    {
        $eqp = Equiper::where('id', $id)->first();

        Local_element::where('equiper_id', $eqp->id)->delete();

        Equiper::where('id', $id)->delete();

        return redirect()->back()->withOk('Supprimé avec succès!');
    }

    public function des_equipersup(Request $request, $id)
    {
        $eqp = Equiper_descript::where('id', $id)->first();

        Des_element::where('id',$eqp->id)->delete();

        Equiper_descript::where('id', $id)->delete();

        return redirect()->back()->withOk('Supprimé avec succès!');
    }







    public function delete(Request $request)
    {
        Proprietaire::where('id', $request->id)->update(['archiver' => $request->archive_value]);

        return 'suppbien';
    }

    //***************************** pour les charges**************************************** *///

    public function indexcharge()
    {
        $charges = DB::table('charges')->get();

        return view('pages.charge')->with('charges', $charges);
    }

    public function createcharge(Request $request)
    {
        request()->validate([
            'libelle' => 'required',
            'type_charge' => 'required',
            ]);

        if ($request->charge_id == '') {
            Charge::create([
                'libelle' => $request->libelle,
                'type_charge' => $request->type_charge,
            ]);

            return 'create';
        } else {
            Charge::where('id', $request->charge_id)->update([
                'libelle' => $request->libelle,
                'type_charge' => $request->type_charge,
            ]);

            return 'edit';
        }

        return response()->json();
    }

    public function deletecharge(Request $request)
    {
        Charge::where('id', $request->id)->delete();

        return 'supp';
    }

    // ****************************************** findes charges ************************************************//
}
