<?php

namespace App\Http\Controllers;

use App\Des_element;
use App\Local_element;
use Illuminate\Http\Request;

class LocalelementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        Local_element::create([
            'equipement_id' => $request->equipement_id,
            'element_id' => $request->element_id,
            'equiper_id' => $request->equiper_id,
            'detail' => $request->detail,
        ]);

        return redirect()->back()->withOk('Element ajouté!');
    }

    public function store_description(Request $request)
    {
        Des_element::create([
            'description_id' => $request->id_description,
            'equiper_descript_id' => $request->des_equiper_id,
            'libelle' => $request->element_des,
            'detail' => $request->detail,
        ]);

        return redirect()->back()->withOk('Element ajouté!');
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
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        //echo $request->localelement_id; exit();

        Local_element::where('id', $id)->delete();

        return redirect()->back()->withOk('Elément supprimé avec succès!');
    }

    public function des_delete(Request $request, $id)
    {
        //echo $request->localelement_id; exit();

        Des_element::where('id', $id)->delete();

        return redirect()->back()->withOk('Elément descriptif supprimé avec succès!');
    }
}
