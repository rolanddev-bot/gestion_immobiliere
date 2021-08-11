<?php

namespace App\Http\Controllers;

use App\Appartenir;
use App\Bien;
use App\Mandat;
use App\Proprietaire;
use App\Quittance;
use App\Reversement;
use App\Versement;
use Barryvdh\DomPDF\Facade as PDF;
use Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReversementController extends Controller
{
    public function index()
    {
        $revers = Reversement::orderBy('id', 'DESC')->where('archiver', 0)->get();
        $mandats = Mandat::orderBy('id', 'DESC')->where('archiver', 0)->get();
        $props = Proprietaire::where('en_vente',0)->orderBy('id', 'ASC')->where('archiver', 0)->get();
        $biens = bien::orderBy('libelle', 'ASC')->where('archiver', 0)->get();
        $quittances = Quittance::where('archiver', 0)->get();

        //var_dump($quittances); exit();

        return view('pages.reversement', compact('revers', 'mandats', 'props', 'biens', 'quittances'));
    }

    public function prop(Request $request)
    {
        $bien_id = $request->bien_id;

        $mandat = Bien::where('bien_id', $bien_id)->first();
        $proprietaire_id = $request->proprietaire_id;
        $quittances = $request->quittance_id;

        foreach ($quittances as $key => $pr) {
            Versement::create(['mandat_id' => $mandat->id, 'quittance_id' => $pr]);
        }

        return view('pages.reversement_phase1', compact('appartenirs'));
    }

    public function update(Request $request)
    {
        $id = $request->reversement_id;

        Reversement::where('id', $id)->update([
             'detail' => $request->detail,
            'tva' => $request->tva,
            'impot' => $request->impot,
            'date_revers' => $request->date_revers,
                ]);

        return redirect('reversement/'.$id)->withOk('Modifié avec succès!');
    }

    public function rech_quittance(Request $request)
    {
        $var_id = $request->var_id;

        $quittances = Quittance::where('bien_id', $var_id)
            ->where('archiver', 0)
            ->where('verser', 0)
            ->get();

        $mabox = '<select class="form-control" id="quittance" name="quittance[]" required multiple>';

        foreach ($quittances as $quit) {
            //if($appar->bien->immeuble_id != 0){

            $mabox .= '<option value="'.$quit->id.'">';

            $mabox .= $quit->ref.' - '.$quit->facture->nature;

            $mabox .= '</option>';
            //}
        }

        $mabox .= '</select>';

        return $mabox;

        //return 'OK';
    }

    public function store(Request $request)
    {
        $quittances = $request->input('quittance');

        $bien_id = $request->bien_id;

        $mandat = Mandat::where('bien_id', $bien_id)->where('archiver', 0)->first();

        //var_dump($mandat_id); exit();

        $num1 = $mandat->id;

        $rever_id = DB::table('reversements')->max('id');

        $code = '';
        $code1 = '';
        $code2 = '';
        $num = $rever_id + 1;

        if (strlen($num) == 1) {
            $code = '00'.$num;
        } elseif (strlen($num) == 2) {
            $code = '0'.$num;
        } else {
            $code = $num;
        }
        if (strlen($num1) == 1) {
            $code1 = '00'.$num1;
        } elseif (strlen($num1) == 2) {
            $code1 = '0'.$num1;
        } else {
            $code1 = $num1;
        }

        $ref = 'RL-'.$code.'-'.date('Y').'-'.$code1;

        //echo $ref; exit();

        $rever = Reversement::create([
            'detail' => $request->detail,
            'mandat_id' => $mandat->id,
            'tva' => $request->tva,
            'impot' => $request->impot,
            'date_revers' => $request->date_revers,
            'ref' => $ref,
        ]);

        $rever_id = DB::table('reversements')->max('id');

        foreach ($quittances as $quit) {
            $quittance = Quittance::where('id', $quit)->first();

            Versement::create([
                'quittance_id' => $quittance->id,
                'reversement_id' => $rever_id,
                'taux' => $mandat->honoraire,
                'montant' => $quittance->facture->montant,
            ]);

            Quittance::where('id', $quittance->id)->update(['verser' => 1]);
        }

        return redirect('reversement/'.$rever->id)->withOk('Reversement effectué!');
    }

    public function show($id)
    {
        $reversement = Reversement::whereId($id)->first();

        $bien = Bien::whereId($reversement->mandat->bien->id)->first();
        $appartenirs = Appartenir::where('bien_id', $bien->id)->get();
        $appartenirs_nb = Appartenir::where('bien_id', $bien->id)->count();

        $quittances = Quittance::where('bien_id', $bien->id)->where('verser', 0)->get();
        $quittances_r = Quittance::where('bien_id', $bien->id)->where('verser', 1)->get();

        return view('pages.reversement_detail', compact('reversement', 'appartenirs', 'quittances',
                                                        'appartenirs_nb', 'quittances_r'));
    }

    public function edit($id)
    {
        $rever = Reversement::where('id', $id)->first();

        return view('pages.reversement_edit', compact('rever'));
    }

    public function reversement_print(Request $request, $id)
    {
        $rever = Reversement::where('id', $id)->first();
        $mandat = Mandat::where('id', $rever->mandat_id)->first(); // id de bien
        $props = Appartenir::where('bien_id', $mandat->bien_id)->get();

        $nbre_rever = Versement::where('reversement_id', $id)->count();
        $mont_rever = Versement::where('reversement_id', $id)->get();
        $somm_rever = Versement::where('reversement_id', $id)->sum('montant');


        $pdf = PDF::loadView('pages.reversement_print', compact('somm_rever','mont_rever','rever','nbre_rever', 'props', 'mandat'));
        $nom = 'Reversement - '.$rever->ref.' - '.date('dmY');
        // return $pdf->download($nom.'.pdf');
        return $pdf->download($nom.'.pdf');
    }

    public function reversement_print_direct(Request $request, $id)
    {
        $rever = Reversement::where('id', $id)->first();
        $mandat = Mandat::where('id', $rever->mandat_id)->first();
        $props = Appartenir::where('bien_id', $mandat->bien_id)->get();

        return view('pages.reversement_print', compact('rever', 'props', 'mandat'));
    }

    public function destroy($id)
    {
    }
}
