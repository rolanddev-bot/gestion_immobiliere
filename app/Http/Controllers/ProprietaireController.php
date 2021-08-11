<?php

namespace App\Http\Controllers;

use App\Appartenir;
use App\Banque;
use App\Proprietaire;
use Illuminate\Http\Request;
use Redirect;

//use Illuminate\Http\RedirectResponse;

class ProprietaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proprietaire = Proprietaire::where('archiver', 0)->where('en_vente', 0)->orderBy('nom', 'ASC')->get();

        return view('pages.proprietaire')->with('proprietaire', $proprietaire);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banques = Banque::orderBy('libelle', 'ASC')->get();

        return view('pages.proprietaire_create', compact('banques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
           'profession' => $request->profession,
           'etablie_le' => $request->etablie_le,
           'domicile_a' => $request->domicile_a,
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
          ]);

        $id_max = Proprietaire::max('id');

        return redirect('proprietaire/'.$id_max)->withOk('Ajouté avec succès!');
    }

    public function show($id)
    {
        $prop = Proprietaire::whereId($id)->first();
        $apparts = Appartenir::where('proprietaire_id', $prop->id)->get();

        return view('pages.proprietaire_show', compact('prop', 'apparts'));
    }

    public function edit($id)
    {
        $prop = Proprietaire::whereId($id)->first();
        $banques = Banque::orderBy('libelle', 'ASC')->get();

        return view('pages.proprietaire_edit', compact('prop', 'banques'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

        return redirect('proprietaire/'.$request->prop_id)->with('ok');
    }

    public function delete(Request $request)
    {
        if ($request->archiver == 0) {
            Proprietaire::where('id', $request->id)->update(['archiver' => 1]);
        } else {
            Proprietaire::where('id', $request->id)->update(['archiver' => 0]);
        }

        return redirect('proprietaire')->with('ok');
    }
}
