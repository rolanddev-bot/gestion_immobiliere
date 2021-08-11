<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Mode;
use Illuminate\Http\Request;

class BanqueController extends Controller
{
    public function index()
    {
        $banques = Banque::orderBy('libelle', 'ASC')->get();
        $modes = Mode::orderBy('libelle', 'ASC')->get();

        return view('pages.banque', compact('banques','modes'));
    }

    public function banque_store(Request $request)
    {
        if ($request->banque_id != '') {
            Banque::where('id', $request->banque_id)->update([
                'detail' => $request->detail,
                'libelle' => strtouper($request->libelle)
            ]);

            return redirect()->back()->withOk('Banque modifiée avec succès!');
        } else {
            Banque::create([
                'detail' => $request->detail,
                'libelle' => strtouper($request->libelle)
            ]);

            return redirect()->back()->withOk('Banque ajoutée avec succès!');
        }
    }


 // ***************script d'ajout des mode de paiement ***********************************//
    public function mode_store(Request $request)
    {
        if ($request->mode_id != '') {
            Mode::where('id', $request->mode_id)->update([
                'libelle' => $request->libelle_mode,
            ]);

            return redirect()->back()->withOk1('Mode modifié avec succès!');
        } else {
            Mode::create([
                'libelle' => $request->libelle_mode,
            ]);

            return redirect()->back()->withOk1('Mode ajouté avec succès!');
        }
    }
}
