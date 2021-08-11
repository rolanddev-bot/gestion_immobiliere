<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Typebien;

class TypebienController extends Controller
{
    public function index()
    {
        $typebiens = DB::table('typebiens')->get();

        return view('pages.typebien')->with('typebiens', $typebiens);
    }

    public function create(Request $request)
    {
        request()->validate([
            'libelle' => 'required',
            'details' => 'required',
            ]);
        $nbr = Typebien::where('libelle', '=', $request->libelle)->count();

        if ($request->typebien_id == '') {
            if ($nbr == 0) {
                Typebien::create(['libelle' => $request->libelle,
                              'details' => $request->details,
               ]);

                return 'ok';
            } else {
                return 'existe';
            }
        } else {
            Typebien::where('id', $request->typebien_id)->update([
                    'libelle' => $request->libelle,
                    'details' => $request->details,
                ]);

            return 'edit';
        }

        return response()->json();
    }

    public function delete(Request $request)
    {
        Typebien::where('id', $request->id)->update([ 'archiver' => 1 ]);

        return 'supp';

    }
}
