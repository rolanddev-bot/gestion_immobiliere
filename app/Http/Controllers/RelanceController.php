<?php


namespace App\Http\Controllers;

use App\Relance;
use App\Appliquer;
use App\Bien;
use App\Equipement;
use App\Equiper;
use App\Quittance;
use App\Facture;
use App\Location;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class RelanceController extends Controller
{
    public function index()
    {
		$relances = Relance::where('archiver', 0)->get();
		return view('pages.relance', compact('relances'));
    }
    //********************* imprimer quittance ************** */

    public function quittance_print(Request $request, $id)
    {
      
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request){
        Equipement::where('id', $request->mequipement_id)->update([
            'libelle' => $request->mlibelle,
            'type' => $request->mtype
        ]);

        return redirect()->back()->withOk("Mise à jour effectuée! ");
    }

    public function delete(Request $request)
    {
        $id_nvo = $request->id_nvo;
		$var_id= $request->var_id;
		
        Relance::where('id', $var_id)->update(['archiver' => $id_nvo]);
		
		return 'OK';
    }

}
