<?php

namespace App\Http\Controllers;


use App\Honoraire;
use App\Locataire;
use App\Location;
use App\Reglement;
use App\Appliquer;
use App\Appartenir;
use App\Reversement;
use App\Hnoraire;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Repositories\HonoraireRepository;

use Illuminate\Http\Request;

class HonoraireController extends Controller
{
   
    
    public function index()
    {
        $honoraires = Honoraire::orderBy('id', 'DESC')->where('archiver', 0)->get();
		$revers = Reversement::where('archiver', 0)->get();
       

        return view('pages.honoraire', compact('honoraires', 'revers'));
    }


    public function hono_print(Request $request, $id)
    {
        $hono= Honoraire::where('id', $id)->first();
		$appartenirs = Appartenir::where('bien_id', $hono->reversement->mandat->bien->id)->get();
		
		//return view('pages.honoraire_print', compact('hono', 'appartenirs'));

        
        $pdf = PDF::loadView('pages.honoraire_print', compact('hono', 'appartenirs'));

        $nom ='Facture - '.$hono->ref.' - '.date('dmY');
        
		return $pdf->download($nom.'.pdf');
    }
	
	public function hono_print_direct(Request $request, $id)
    {
        $hono = Honoraire::where('id', $id)->first();
		$appartenirs = Appartenir::where('bien_id', $hono->reversement->mandat->bien->id)->get();
        
        return view('pages.honoraire_print', compact('hono', 'appartenirs'));

        
    }
	
	
	public function store(Request $request)
	{
		
		Honoraire::create([
			'ref' => date('mY'),
			'reversement_id' =>$request->reversement_id,
			'nom_agent'=>$request->nom_agent, 
			'delai'=>$request->delai, 
			'detail'=>$request->detail, 
			'montant_lettre' =>$request->montant_lettre, 
			'mode' =>$request->mode
		]);
		
		return redirect()->back()->withOk('Ajouté');
		
	}



    
}
