<?php

namespace App\Http\Controllers;

use App\Agence;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    public function index()
    {
        $agence = Agence::where('id', 1)->first();

        return view('pages.agence', compact('agence'));
    }

    public function store(Request $request)
    {
        Agence::create([
            'denomination' => $request->denomination,
            'siege' => $request->siege,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'telephone' => $request->telephone,
            'forme' => $request->forme,
            'numero_registre' => $request->numero_registre,
            'capital' => $request->capital,
            'detail' => $request->detail,
        ]);

        return redirect()->back()->withOk('Ajouté avec succès!');
    }

    public function update(Request $request)
    {
        Agence::where('id', $request->agence_id)->update([
            'denomination' => $request->denomination,
            'siege' => $request->siege,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'telephone' => $request->telephone,
            'forme' => $request->forme,
            'numero_registre' => $request->numero_registre,
            'capital' => $request->capital,
            'email_agence' => $request->email_agence,
            'num_rccm' => $request->numero_rccm,
            'numero_agrement' => $request->numero_agrement,
            'sexe_representant' => $request->sexe_representant,
            'representer_par' => $request->representer_par,
            'poste_representant' => $request->poste_representant,
            'date_relance' => $request->date_relance,

            'detail' => $request->detail,
        ]);

        return redirect()->back()->with('ok');
    }

    public function delete(Request $request)
    {
        Agence::where('id', $request->id)->delete();

        return 'Supprimé avec succès!';
    }

    public function appartaffiche(Request $request)
    {
        $id = $request->agence_id;

        return $this->ajourner($id);
    }

    public function ajourner($id)
    {
    }
}
