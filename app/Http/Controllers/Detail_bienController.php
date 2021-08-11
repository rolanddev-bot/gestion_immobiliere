<?php

namespace App\Http\Controllers;

use App\Bien;
use App\Equipement;
use Illuminate\Http\Request;

class Detail_bienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $datas = Bien::where('id', $id)->get();
        $details = Equipement::where('bien_id', $id)->get();

        return view('pages.detail_bien', compact('datas', 'details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id_equipement == '') {
            Equipement::create([
                'bien_id' => $request->bienid,
                'libelle' => $request->libelle,
                'type_detail' => $request->type_detail,
            ]);
            // $biens = Bien::orderBy('id', 'desc')->get();
            $datas = Bien::where('id', $request->bienid)->get();
            $details = Equipement::where('bien_id', $request->bienid)->get();

            return view('pages.detail_bien', compact('datas', 'details'));
        } else {
            Equipement::where('id', $request->id_equipement)->update([
                'libelle' => $request->libelle,
                'type_detail' => $request->type_detail,
            ]);

            return 'edit';
        }

        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Equipement::where('id', $request->id_equipementm)->update([
            'libelle' => $request->libellem,
            'type_detail' => $request->type_detailm,
        ]);

        $datas = Bien::where('id', $request->bienidm)->get();
        $details = Equipement::where('bien_id', $request->bienidm)->get();

        return view('pages.detail_bien', compact('datas', 'details'));

        // return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id, $detailid)
    {
        Equipement::where('id', $id)->delete();

        return redirect()->route('detail_bienaffiche', ['id' => $detailid]);
    }
}
