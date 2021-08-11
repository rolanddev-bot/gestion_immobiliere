<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Immeuble;
use App\Contenir;
use App\Bien;
use App\Location;
use App\Commune;

use App\Repositories\ImmeubleRepository;

class ImmeubleController extends Controller
{
    protected $immeubleRepository;
	
    public function __construct(ImmeubleRepository $immeubleRepository)
    {
        $this->immeubleRepository = $immeubleRepository;
    }
    

    public function index()
    {      
        $immeubles = Immeuble::orderBy('libelle', 'ASC')->get(); 
        $locations = Location::get(); 
        $biens = Bien::orderBy('libelle', 'ASC')->get(); 
		$communes = Commune::orderBy('libelle', 'ASC')->get(); 
        $contenirs = Contenir::get(); 


		return view('pages.immeuble', compact('biens', 'immeubles', 'contenirs','locations', 'communes'));
    }

    public function store(Request $request)
    {
        Immeuble::create([
            'libelle' => $request->libelle_immeuble,
            'section' => $request->section_immeuble,
            'parcelle' => $request->parcelle_immeuble,
            'lot' => $request->lot_immeuble,
            'ilot' => $request->ilot_immeuble,
            'commune_id' => $request->commune_immeuble,
            'adresse' => $request->adresse_immeuble,
            'detail' => $request->detail_immeuble,
        ]);

        return redirect()->back()->withOk('Ajouté avec succès!');

    }

    public function update(Request $request)
    {
        
        Immeuble::where('id', $request->id_immeuble)->update([
            'libelle' => $request->libelle_immeuble,
            'section' => $request->section_immeuble,
            'parcelle' => $request->parcelle_immeuble,
            'lot' => $request->lot_immeuble,
            'ilot' => $request->ilot_immeuble,
            'commune_id' => $request->commune_immeuble,
            'adresse' => $request->adresse_immeuble,
            'detail' => $request->detail_immeuble
        ]);


        return redirect('immeuble')->withOk('Modifié avec succès!');
    }

    public function delete(Request $request)
    {
        

        Immeuble::where('id', $request->id)->update([ 'archiver' => 1]);

        return 'ok';
    }

    

    public function appartaffiche(Request $request)
    {
        $id = $request->immeuble_id;
        
        return $this->ajourner($id);
        
    }


    //Delete Appart
    public function appartdelete(Request $request)
    {
        $contenir = Contenir::where('id', $request->id)->first();
        $id = $contenir->immeuble_id;

        //Rendre le bien dispo pour immeuble
        Bien::where('id', $contenir->bien->id)->update(['immeuble' => 0]);

        Contenir::where('id', $contenir->id)->delete();

        return $this->ajourner($id);
    }
    

    public function appartcreate(Request $request)
    {
        $id = $request->abien_id;

        Bien::where('id', $id)->update(['immeuble' => 1]);

        Contenir::create([
            'bien_id' => $id,
            'immeuble_id' => $request->aimmeuble_id                     
         ]);   

         return $this->ajourner($request->aimmeuble_id );
         
    }
	
	public function show($id)
	{
		$immeuble = Immeuble::where('id', $id)->first();
		$communes = Commune::orderBy('libelle', 'ASC')->get();
		
		return view('pages.immeuble_edit', compact('immeuble', 'communes'));
		
		//return redirect('immeuble')->withOk('Ajouté avec succès!');
	}

    
    public function ajourner($id)
    {
        $vars = Contenir::where('immeuble_id', $id)->get();
        $biens = Bien::where('immeuble', 0)->orderBy('libelle', 'ASC')->get(); 

       
        $rglt = '<table style="margin:auto; width:100%" id="tab_reglement" border="1" >';
        $rglt .= '<thead class="bg-warning"><tr><td>N°</td><td>Libellé</td><td>Réf</td><td>Action</td></tr></thead>';
        $i=1;

        foreach($vars as $var){
            $rglt .= '<tr><td>'.$i++.'</td><td>'.$var->bien->libelle.'</td><td>'.$var->bien->ref.'</td><td><a href="javascript:void(0)" id="supprimerAppart" data-bien_id="'.$var->id.'">Supprimer</a></td></tr>';
        }
       
        $rglt .= '</tr></table>';

        return $rglt;
    }


}
