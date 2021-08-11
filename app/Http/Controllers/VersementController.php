<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Reversement;
use App\Versement;
use App\Mandat;
use App\Bien;
use App\Quittance;
use App\Proprietaire;
use App\Appartenir;

class VersementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    
	
	
    public function create()
    {
        
    }

  
    public function store(Request $request)
    {
		$quittance_id = $request->quittance;
		$rev_id = $request->reversement_id;
		$i=0;
		
	
		
		foreach($quittance_id as $id){
			
		$quittance =  Quittance::whereId($id)->first();

        Versement::create([
            'quittance_id' => $id,
            'reversement_id' => $rev_id,
            'montant' => $quittance->facture->montant
        ]);
		
		Quittance::where('id', $id)->update([ 'verser' => 1]);
			
		}


        return redirect()->back()->withOk("Reversement effectué!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reversement = Reversement::whereId($id)->first();
		
		$bien = Bien::whereId($reversement->mandat->bien->id)->first();
		$appartenirs =Appartenir::where('bien_id', $bien->id)->get();
		$appartenirs_nb =Appartenir::where('bien_id', $bien->id)->count();
		
		
		$quittances = Quittance::where('bien_id', $bien->id)->get();
		
		return view('pages.reversement_detail', compact('reversement', 'appartenirs', 'quittances', 'appartenirs_nb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
