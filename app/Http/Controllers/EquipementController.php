<?php


namespace App\Http\Controllers;


use App\Bien;
use App\Equipement;
use App\Element;
use App\Equiper;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function index()
    {
        $equipements = Equipement::orderBy('libelle', 'ASC')->get();
        $elts = Element::orderBy('libelle', 'ASC')->get();
        return view('pages.equipement', compact('equipements', 'elts'));
    }

    public function store(Request $request)
    {

        Equipement::create([
            'type' => $request->type,
            'libelle' => $request->libelle
            ]);

        return redirect()->back()->withOk("Enregistrement effectuée! ");
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
		if($request->archiver ==0) Equipement::where('id', $request->equipement_id)->update(['archiver' => 1]);
		else Equipement::where('id', $request->id)->update(['archiver' => 0]);

        return redirect()->back()->withOk("Equipement archivé! ");
    }
	
	
    public function archive_equipement(Request $request)
    {
        if ($request->archiver == 1) {
            Equipement::where('id', $request->equipement_id)->update(['archiver' => 0]);

            return redirect()->back()->withOk('Elément désarchivé! ');
        } else {
            Equipement::where('id', $request->equipement_id)->update(['archiver' => 1]);

            return redirect()->back()->withOk('Equipement archivé! ');
        }
    }

    //********  archiver ou desarchiver un element *********** */

    public function archive_element(Request $request)
    {
        if ($request->archiver == 1) {
            Element::where('id', $request->element_id)->update(['archiver' => 0]);

            return redirect()->back()->withOk('Elément désarchivé! ');
        } else {
            Element::where('id', $request->element_id)->update(['archiver' => 1]);

            return redirect()->back()->withOk('Elément archivé! ');
        }
    }

    public function storeelement(Request $request)
    {
        Element::create([
            'libelle' => $request->libelle,
            'detail' => $request->detail,
            ]);

        return redirect()->back()->withOk('Enregistrement effectuée! ');
    }

}
