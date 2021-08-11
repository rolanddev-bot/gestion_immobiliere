<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Locataire;
use App\Appliquer;
use App\Location;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocataireController extends Controller
{


    public function index()
    {
        $locataire = DB::table('locataires')->where('archiver', 0)->where('acquereur',0)->get();

        return view('pages.locataire')->with('locataire', $locataire);
    }



    public function create()
    {
        $banques = Banque::orderBy('libelle', 'ASC')->get();

        return view('pages.locataire_create', compact('banques'));
    }



    public function store(Request $request)
    {
        if (isset($request->photo)) {
            $file = $request->photo;
            $fileName = $file->getClientOriginalName();
            $file->move(public_path().'/assets/dossier/', $fileName);
        } else {
            $fileName = 'aucun';
        }

        Locataire::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'domicile_a' => $request->domicile_a,
                'etablie_le' => $request->etablie_le,
                'nationalite' => $request->nationalite,
                'autres' => $request->emaila,
                'date_naissance' => $request->date_naissance,
                'sexe' => $request->sexe,
                'type_piece' => $request->type_piece,
                'numero_piece' => $request->numero_piece,
                'photo' => $fileName,

                'mob1' => $request->mobile1,
                'client' => $request->client,
                'locataire' => $request->locataire,
                'mob2' => $request->mobile2,
                'adresse' => $request->adresse,

                'compte_contribuable' => $request->compte_contribuable,
                'type_locataire_acq' => $request->type_locataire,
                'nom_societe' => $request->nom_societe_loc,
                'adresse_societe' => $request->adresse_societe_loc,

                'capital_societe' => $request->capital_societe,

                'telephone_societe' => $request->telephone_societe_loc,
                'numero_registre' => $request->numero_registre_loc,
                'nom_representant' => $request->nom_representant_loc,
                'contact1_representant' => $request->contact1_representant_loc,
                'contact2_representant' => $request->contact2_representant_loc,
				'compte_bancaire' => $request->compte_bancaire?$request->compte_bancaire:'',
                'banque_id' => $request->banque_id?$request->banque_id:1
       ]);
        $id_max = Locataire::max('id');

        return redirect('locataire/'.$id_max)->withOk('Locataire ajouté!');
    }

    public function show($id)
    {
        $locataire = Locataire::whereId($id)->first();
        $locations = Location::where('locataire_id', $locataire->id)->get();
        $appliquers= Appliquer::get();

		$fact_nb = DB::table('factures')->join('locations', 'factures.location_id', '=', 'locations.id')
			->where('factures.etat', '=', 0)
			->where('locations.locataire_id', '=', $id)
			->count();

		$factures = DB::table('factures')->join('locations', 'factures.location_id', '=', 'locations.id')
			->where('factures.etat', '=', 0)
			->select('factures.nature as lib_fact', 'factures.ref as ref_fact', 'factures.montant as montant_fact', 'locations.ref as ref_loca')
			->get();


        return view('pages.locataire_show', compact('locataire', 'locations','fact_nb', 'appliquers', 'factures'));
    }

    public function edit($id)
    {
        $loca = Locataire::whereId($id)->first();
        $banques = Banque::orderBy('libelle', 'ASC')->get();

        return view('pages.locataire_edit', compact('loca', 'banques'));
    }


    public function update(Request $request)
    {
        if (isset($request->photo)) {
            $file = $request->photo;
            $fileName = $file->getClientOriginalName();
            $file->move(public_path().'/assets/dossier/', $fileName);
        } else {
            $fileName = 'aucun';
        }

        Locataire::where('id', $request->loca_id)->update([
            	'nom' => $request->nom,
                'prenom' => $request->prenom,
                'autres' => $request->emaila,  // le champs autres c'est l'email
                'date_naissance' => $request->date_naissance,
                'sexe' => $request->sexe,
                'type_piece' => $request->type_piece,
                'numero_piece' => $request->numero_piece,
                'photo' => $fileName,

            // 'image_piece' => json_encode($dataimage),
                'mob1' => $request->mobile1,
                'client' => $request->client,
                'locataire' => $request->locataire,
                'mob2' => $request->mobile2,
                'adresse' => $request->adresse,
                'compte_bancaire' => $request->compte_bancaire,
                'compte_contribuable' => $request->compte_contribuable,
                'type_locataire_acq' => $request->type_locataire,
                'nom_societe' => $request->nom_societe,
                'adresse_societe' => $request->adresse_societe,
                'telephone_societe' => $request->telephone_societe,
                'numero_registre' => $request->numero_registre,
                'nom_representant' => $request->nom_representant,
                'contact1_representant' => $request->contact1_representant,
                'contact2_representant' => $request->contact2_representant,
                 'banque_id' => $request->banque_id?$request->banque_id:1
            ]);

        return redirect('locataire/'.$request->loca_id)->withOk('Locataire Modifié!');
    }


    public function archive_locataire(Request $request)
    {
        if ($request->archiver == 0) {
            Locataire::where('id', $request->id)->update(['archiver' => 1]);
        } else {
            Locataire::where('id', $request->id)->update(['archiver' => 0]);
        }

        return redirect('locataire')->with('ok');
    }

}
