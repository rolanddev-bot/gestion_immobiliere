<?php

namespace App\Http\Controllers;

use App\Bien;
use App\Etat;
use App\Locataire;
use App\Equiper;
use App\Location;
use App\Element;
use App\Local_element;

use Barryvdh\DomPDF\Facade as PDF;
use App\Repositories\EtatRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

class EtatController extends Controller
{
    protected $etatRepository;

    public function __construct(EtatRepository $etatRepository)
    {
        $this->etatRepository = $etatRepository;
    }

    public function index()
    {
        $etats = Etat::orderBy('id', 'DESC')->get();
        $locataires = Locataire::orderBy('nom', 'ASC')->get();

        return view('pages.etat', compact('etats', 'locataires'));
    }

    

    public function show($id)
    {
		$etat = $this->etatRepository->getById($id);
		$i = $etat->entree_sortie;
		//echo $i; exit();
		if( $i == 'Entrée') {
			$etat = Etat::whereId($id)->first();
			$etats = $etat;
		}
		else{
		
        	$etats = Etat::whereId($id)->first();
			$etat = $etats;
		}
		
		 $location = Location::where('id', $etat->location->id)->first();

			$equipers = Equiper::where('bien_id', $location->bien->id)->get(); 
			$elts = Local_element::get(); 
			$elements = Element::get(); 


        return view('pages.etat_show', compact('etat', 'etats', 'location', 'location', 'equipers', 'elts', 'elements'));
    }
	
	
	public function store(Request $request)
    {
        $id = $request->location_id;
		
		$location = Location::whereId($id)->first();
		
		$etat_id = DB::table('etats')->max('id');

		$code = ''; $num = $etat_id + 1;

		if (strlen($num) == 1) { $code = '00'.$num;} elseif (strlen($num) == 2) { $code = '0'.$num; } else { $code = $num;}

		$ref = 'ET-'.$code.'-'.date('Y');

        $etat = Etat::create([
            'ref' => $ref,
            'user_id' => $request->user_id,
            'location_id' => $id,
            'entree_sortie' => $request->entree_sortie,
            'date_etat' => $request->date_etat,
            'avis_bailleur' => $request->avis_bailleur,
            'detail' => $request->detail,
            'avis_locataire' => $request->avis_bailleur
            ]);

        return redirect('etat/'.$etat->id)->withOk('Etat modifié avec succès!');
    }

    public function edit($id)
    {
        $etat = $this->etatRepository->getById($id);

        return view('etat_edit', compact('etat'));
    }

    public function update(Request $request)
    {
            $id = $request->etat_id;
            $location_id = $request->location_id;
            $entree_sortie = $request->entree_sortie;

 
            $eqps = $request->input('equiper_id');
            $nbre_champ = $request->nbre_champ;

            
            foreach($eqps as $eqp){
                $num_ligne = Str::after($eqp, '-');
                $num_element = $slice = Str::of($eqp)->before('-');

                $var = 'note'.$num_ligne;

           
               Local_element::where('id', $num_element)->update([ 'note' => $request->$var ]);
                
            }
             

            Etat::where('id', $id)->update([
                //'entree_sortie' => $request->entree_sortie,
                'date_etat' => $request->date_etat,
                'avis_bailleur' => $request->avis_bailleur,
                'avis_locataire' => $request->avis_locataire,
                'detail' => $request->detail,
                'cloture' => $request->cloture
                ]);
 
            return redirect('etat/'.$id)->withOk("Etat ".$entree_sortie." modifié avec succès!");
    }

    public function delete(Request $request)
    {
        $id_nvo = $request->id_nvo;
		$var_id= $request->var_id;
		
        Etat::where('id', $var_id)->update(['archiver' => $id_nvo]);
		
		return 'Archivé avec succès!';
    }


    public function print(Request $request, $id)
    {
        $location = Location::whereId($id)->first();
        $equipers = Equiper::where('bien_id', $location->bien->id)->get(); 
        $elts = Local_element::get(); 
        $elements = Element::get(); 

        $etat = Etat::where('location_id', $id)->where('entree_sortie', 'Entrée')->first();
        $etats = Etat::where('location_id', $id)->where('entree_sortie', 'Sortie')->first();

        return view('pages.etat_print');

        exit();

        //$pdf = PDF::loadView('pages.etat_print', compact('etat'));

        $nom ="ETAT".$id;
        
        return $pdf->download($nom.'.pdf');

    }

}
