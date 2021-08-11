<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bien;
use App\Charge;
use App\Location;

class ChargeController extends Controller
{
    public function charge()
    {
        $charges = Charge::orderBy('libelle', 'ASC')->get();
        $locations = Location::whereIn('etat', ['En cours', 'Suspendu'] )->orderBy('id', 'DESC')->get();

        return view('pages.charge_depense', compact('charges', 'locations'));
    }
}
