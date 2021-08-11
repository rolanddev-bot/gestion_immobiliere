<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Besoin;
use App\Budget;
use App\Locataire;
use App\Location;
use App\Mode;
use App\Typebien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_acquereur()
    {
        $locataire = DB::table('locataires')->where('archiver', 0)->where('acquereur', 1)->get();

        return view('pages.acquereur', compact('locataire'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_acquereur()
    {
        $banques = Banque::orderBy('libelle', 'ASC')->get();

        return view('pages.acquereur_create', compact('banques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store_acquereur(Request $request)
    {
        if (isset($request->photo)) {
            $file = $request->photo;
            $fileName = $file->getClientOriginalName();
            $file->move(public_path().'/assets/dossier/', $fileName);
        } else {
            $fileName = 'aucun';
        }

        Locataire::create([
                'nom' => strtoupper($request->nom),
                'prenom' => ucwords($request->prenom),
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

                'compte_contribuable' => $request->compte_contribuable,
                'acquereur' => $request->acquereur,
                'type_locataire_acq' => $request->type_locataire,
                'nom_societe' => $request->nom_societe_loc,
                'adresse_societe' => $request->adresse_societe_loc,
                'telephone_societe' => $request->telephone_societe_loc,
                'numero_registre' => $request->numero_registre_loc,
                'nom_representant' => $request->nom_representant_loc,
                'contact1_representant' => $request->contact1_representant_loc,
                'contact2_representant' => $request->contact2_representant_loc,
                'compte_bancaire' => $request->compte_bancaire ? $request->compte_bancaire : '',
                'banque_id' => $request->banque_id ? $request->banque_id : 1,
       ]);
        $id_max = Locataire::max('id');

        return redirect('acquereur')->withOk('Acquéreur ajouté avec succès!');
    }

    public function edit_acquereur($id)
    {
        $loca = Locataire::whereId($id)->first();
        $banques = Banque::orderBy('libelle', 'ASC')->get();

        return view('pages.acquereur_edit', compact('loca', 'banques'));
    }

    public function update_acquereur(Request $request)
    {
        if (isset($request->photo)) {
            $file = $request->photo;
            $fileName = $file->getClientOriginalName();
            $file->move(public_path().'/assets/dossier/', $fileName);
        } else {
            $fileName = 'aucun';
        }

        Locataire::where('id', $request->loca_id)->update([
            'nom' => strtoupper($request->nom),
                'prenom' => ucwords($request->prenom),
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
                'banque_id' => $request->banque_id,
            ]);

        return redirect('acquereur')->withOk('Acquéreur Modifié avec succès!');
    }

    public function show_acquereur($id)
    {
        $locataire = Locataire::whereId($id)->first();
        $locations = Location::where('locataire_id', $locataire->id)->get();

        return view('pages.acquereur_show', compact('locataire', 'locations'));
    }

    public function archive_acquereur(Request $request)
    {
        if ($request->archiver == 0) {
            Locataire::where('id', $request->id)->update(['archiver' => 1]);
        } else {
            Locataire::where('id', $request->id)->update(['archiver' => 0]);
        }

        return redirect('acquereur')->with('Archivé avec succès!');
    }

    ////////////////// gestion des besoins/////////////////////////

    public function besoin_index()
    {
        $besoins = Besoin::where('archiver', 0)->get();

        return view('pages.besoin', compact('besoins'));
    }

    public function besoin_create()
    {
        $modes = Mode::orderBy('libelle', 'ASC')->get();
        $typebiens = Typebien::orderBy('libelle', 'ASC')->get();
        $acquereurs = Locataire::where('archiver', '0')->where('acquereur', 1)->get();

        return view('pages.besoin_create', compact('modes', 'typebiens', 'acquereurs'));
    }

    public function besoin_store(Request $request)
    {
        $nbre_typebien = count($request->type_bien);
        if ($nbre_typebien > 0) {
            foreach ($request->type_bien as $item => $v) {
                $data2 = [
                'locataire_id' => $request->acquereur,
                'typebien_id' => $request->type_bien[$item],
                'libelle' => $request->libelle[$item],
                'nbre_piece' => $request->nbre_piece[$item],
                'superficie' => $request->superficie[$item],
                'delai_acquisition' => $request->delai[$item],
                'adresse' => $request->adresse[$item],
                'detail' => $request->detail[$item],
        ];
                Besoin::insert($data2);
            }
        }

        return redirect('besoin')->withOk('Besoin ajouté avec succès!');
        /* Besoin::create([
             'typebien_id' => $request->type_bien,
             'libelle' => $request->libelle,
             'adresse' => $request->adresse,
             'nbre_piece' => $request->nbre_piece,
             'superficie' => $request->superficie,
             'delai_acquisition' => $request->delai,
             'detail' => $request->detail,
        ]);

         return redirect('besoin')->withOk('Besoin ajouté avec succès!');*/
    }

    public function besoin_edit($id)
    {
        $modes = Mode::orderBy('libelle', 'ASC')->get();
        $typebiens = Typebien::orderBy('libelle', 'ASC')->get();
        $besoin = Besoin::where('id', $id)->first();
        $acquereurs = Locataire::where('archiver', '0')->where('acquereur', 1)->get();

        return view('pages.besoin_edit', compact('modes', 'typebiens', 'besoin', 'acquereurs'));
    }

    public function besoin_update(Request $request)
    {
        Besoin::where('id', $request->besoin_id)->update([
                'typebien_id' => $request->type_bien,
                'locataire_id' => $request->acquereur,
                'libelle' => $request->libelle,
                'adresse' => $request->adresse,
                'nbre_piece' => $request->nbre_piece,
                'superficie' => $request->superficie,
                'delai_acquisition' => $request->delai,
                'detail' => $request->detail,
            ]);

        return redirect('besoin')->withOk('Besoin Modifié avec succès!');
    }

    public function besoin_show($id)
    {
        $besoin = Besoin::whereId($id)->first();
        // $locations = Location::where('locataire_id', $locataire->id)->get();

        return view('pages.besoin_show', compact('besoin'));
    }

    public function besoin_archive(Request $request)
    {
        if ($request->archiver == 0) {
            Besoin::where('id', $request->id)->update(['archiver' => 1]);
        } else {
            Besoin::where('id', $request->id)->update(['archiver' => 0]);
        }

        return redirect('besoin')->with('Archivé avec succès!');
    }

    //*****       creer plusieurs  besoins *******************************//
    public function besoin_add()
    {
        // $modes = Mode::orderBy('libelle', 'ASC')->get();
        $typebiens = Typebien::orderBy('libelle', 'ASC')->get();
        //  $arr['data'] = Locataire::orderBy('id', 'asc')->get();
        // return json_encode($arr);
        $besoin = '<div class="besoin_remove" id="besoin_remove">
           <div class="row">
	<div class="col-md-3">
      	<div class="form-group">
            <strong id="">Type bien<b style="color: red;">*</b></strong>
            <select class="form-control" id="type_bien" name="type_bien[]" required>
                <option value="">Choisir</option>';

        foreach ($typebiens as $typebien) {
            $besoin .= '<option value="'.$typebien->id.'">'.$typebien->libelle.'</option>';
        }
        $besoin .= '</select>
        	</div>
    	</div>
     <div class="col-md-3">
		<div class="form-group">
            <strong>Libellé<b style="color: red;">*</b></strong>
            <input type="text" name="libelle[]" id="libelle" value="" class="form-control">
			</div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-3">
			<div class="form-group">
				<strong>Nombre piéce(s) <b style="color: red;">*</b></strong>
				<input type="text" name="nbre_piece[]" id="nbre_piece"  class="form-control" >
			</div>
        </div>

        <div class="col-md-3">
			<div class="form-group">
				<strong>Superficie <b style="color: red;">*</b></strong>
				<input type="text" name="superficie[]" id="superficie"  class="form-control" >
			</div>
		</div>
                <div class="col-md-3">
                    <div class="form-group">
                        <strong>Date clôture<b style="color: red;">*</b></strong>
                        <input type="date" name="delai[]" id="delai" required class="form-control" >
                    </div>
                </div>
        </div>
	<div class="row">
    <div class="col-md-4">
			<div class="form-group">
				<strong>Adresse <b style="color: red;">*</b></strong>
				<textarea name="adresse[]" id="adresse" rows="3"  class="form-control" ></textarea>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<strong>Détail</strong>
				<textarea name="detail[]" id="detail" rows="3"  class="form-control" ></textarea>
			</div>
        </div>
    </div>
     <hr>
     <a href="javascript:void(0)" style="font-size:20px;" class="text-center btn btn-danger btn-lg" id="supprimer_besoin"><i class="fas fa-times"></i></a>
     </div>';

        return $besoin;
    }

    // *********************************** gestion des budgets  ************************************//

    public function budget_index()
    {
        $budgets = Budget::where('archiver', 0)->get();

        return view('pages.budget', compact('budgets'));
    }

    public function budget_create()
    {
        $modes = Mode::orderBy('libelle', 'ASC')->get();
        $besoins = Besoin::where('etat_budget', 0)->orderBy('libelle', 'ASC')->get();
        $acquereur = Locataire::where('acquereur', 1)->get();

        return view('pages.budget_create', compact('modes', 'besoins', 'acquereur'));
    }

    public function budget_store(Request $request)
    {
        Budget::create([
                'besoin_id' => $request->besoin_id,
                'mode_id' => $request->mode_id,
                'montant' => $request->montant,
                'modalite' => $request->modalite,
                'detail' => $request->detail,
       ]);

        Besoin::where('id', $request->besoin_id)->update([
        'etat_budget' => 1,
       ]);

        return redirect('budget')->withOk('Budget ajouté avec succès!');
    }

    public function budget_edit($id)
    {
        $modes = Mode::orderBy('libelle', 'ASC')->get();
        $budget = Budget::where('id', $id)->first();
        $besoins = Besoin::where('etat_budget', 0)->orderBy('libelle', 'ASC')->get();

        return view('pages.budget_edit', compact('modes', 'budget', 'besoins'));
    }

    public function budget_update(Request $request)
    {
        Budget::where('id', $request->budget_id)->update([
                'besoin_id' => $request->besoin_id,
                'mode_id' => $request->mode_id,
                'montant' => $request->montant,
                'modalite' => $request->modalite,
                'detail' => $request->detail,
        ]);

        return redirect('budget')->withOk('Budget modifié avec succés!');
    }

    public function budget_archive(Request $request)
    {
        if ($request->archiver == 0) {
            Budget::where('id', $request->id)->update(['archiver' => 1]);
        } else {
            Budget::where('id', $request->id)->update(['archiver' => 0]);
        }

        return redirect('budget')->with('Archivé avec succès!');
    }

    public function search_besoin(Request $request)
    {
        $loca_id = $request->locataire_id;
        $besoins = Besoin::where('locataire_id', $loca_id)->get();

        //$appars = Appartenir::where('proprietaire_id', $prop_id)->get();

        $mabox = '<select class="form-control" id="besoin_id" name="besoin_id" onChange="method_quittance()">';

        $mabox .= '<option value="">Choisir bien</option>';

        foreach ($besoins as $besoin) {
            //if($appar->bien->immeuble_id != 0){

            $mabox .= '<option value="'.$besoin->id.'">';

            $mabox .= $besoin->libelle.'-'.$besoin->adresse;

            $mabox .= '</option>';
            //}
        }

        $mabox .= '</select>';

        return $mabox;
    }

    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
}
