<?php


namespace App\Http\Controllers;

use App\Appartenir;
use App\Appliquer;
use App\Bien;
use App\Equipement;
use App\Equiper;
use App\Quittance;
use App\Facture;
use App\Location;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class QuittanceController extends Controller
{
    public function index()
    {
		$quittances = Quittance::where('archiver', 0)->get();
		return view('pages.quittance', compact('quittances'));
    }
    //********************* imprimer quittance ************** */

    public function quittance_print(Request $request, $id)
    {
        $idbien= $request->bien;
       $quittance = Quittance::where('id',$id)->first(); //infos quittance
       $id_facture= $quittance->facture_id;
       $facture= Facture::where('id',$id_facture)->first();//infos facture
       $biens= Bien::where('id',$idbien); //infos de bien
       $id_location= $facture->location_id;
       $location= Location::where('id',$id_location)->first(); //infos location
       $id_bien = $location->bien_id;
       $id_location = $location->id;
       $id_locataire = $location->locataire_id;
       $somme_charge = Appliquer::where('location_id',$id_location)->sum('montant_charge');
       $props = Appartenir::where('bien_id',$id_bien)->get(); //infos propriétaire

        $pdf = PDF::loadView('pages.quittance_print',compact('quittance','somme_charge','facture','location','props'));

         // return $pdf->download('depot_garantie.pdf');

         $nom ='Quittance - '.$quittance->ref.' - '.date('dmY');

             return $pdf->download($nom.'.pdf');
    }

	public function quittance_print_direct(Request $request, $id)
    {
       $quittance = Quittance::where('id',$id)->first(); //infos quittance
       $id_facture= $quittance->facture_id;
       $facture= Facture::where('id',$id_facture)->first(); //infos facture
       $id_location= $facture->location_id;
       $location= Location::where('id',$id_location)->first(); //infos location
       $id_bien = $location->bien_id;
       $id_location = $location->id;
       $id_locataire = $location->locataire_id;
       $somme_charge = Appliquer::where('location_id',$id_location)->sum('montant_charge');
       $props = Appartenir::where('bien_id',$id_bien)->get(); //infos propriétaire

        return view('pages.quittance_print',compact('quittance','somme_charge','facture','location','props'));


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

    public function archive_quittance(Request $request)
    {
        if ($request->archiver == 0) {
            Quittance::where('id', $request->id)->update(['archiver' => 1]);
        } else {
            Quittance::where('id', $request->id)->update(['archiver' => 0]);
        }

        return redirect('quittance')->with('ok');
    }

}
