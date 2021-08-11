<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bien;
use App\Appartement;

use Illuminate\Support\Facades\DB;

class AppartementController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

   
	
    public function store(Request $request)
    {
		$bien_id = $request->bien_id;
		
        $appart_id = DB::table('appartements')->max('id');
       	$ref = $appart_id.'-'.date('m').date('y');
		//echo $request->libre; exit();
		
		Appartement::create([
			'ref' => $ref,
			'bien_id' => $bien_id,
			'libelle' => $request->libelle,
			'nbre_piece' => $request->nbre_piece?$request->nbre_piece:0,
			'surface_habitable' => $request->surface_habitable?$request->surface_habitable:0,
			'surface' => $request->surface?$request->surface:0,

			'libre' => $request->libre,
			'meuble' => $request->meuble ? 1 : 0,
			'balcon' => $request->balcon ? 1 : 0,
			'cuisine' => $request->cuisine ? 1 : 0,
			'piscine' => $request->piscine ? 1 : 0,
			
			'detail' => $request->detail
		]);
		
		return redirect()->back()->withOk('Ajouté avec succès!');
    }

 
	
    public function show($id)
    {
        //
    }

   
	
    public function edit($id)
    {
        $appart = Appartement::whereId($id)->first();
		
		
		return view('pages.appartement_edit', compact('appart'));
    }

    
    public function update(Request $request)
    {
		
		$appart = Appartement::whereId($request->appart_id)->first();
		
		//echo $appart->id; exit();
        Appartement::where('id', $appart->id)->update([
			
			//'bien_id' => $bien_id,
			'libelle' => $request->libelle,
			'nbre_piece' => $request->nbre_piece?$request->nbre_piece:0,
			'surface_habitable' => $request->surface_habitable?$request->surface_habitable:0,
			'surface' => $request->surface?$request->surface:0,

			'libre' => $request->libre ? 1 : 0,
			'meuble' => $request->meuble ? 1 : 0,
			'balcon' => $request->balcon ? 1 : 0,
			'cuisine' => $request->cuisine ? 1 : 0,
			'piscine' => $request->piscine ? 1 : 0,
			
			'detail' => $request->detail
		]);
		
		return redirect('bien/'.$appart->bien->id)->withOk('Appartement modifié avec succès!');
    }

    
    public function destroy($id)
    {
        //
    }
}
