<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Proprietaire;
use App\Mandat;
use App\Locataire;
use App\Location;
use App\Etat;
use App\Bien;
use App\Facture;
use App\Reglement;
use App\Reversement;
use App\Quittance;

use Local_element;
use App\Element;
use App\Equiper;
use App\Charge;
use App\Appliquer;

use App\Repositories\AgenceRepository;

class ArchiveController extends Controller
{


    public function proprietaire()
    {
        $proprietaires = Proprietaire::where('archiver', 1)->orderBy('nom', 'ASC')->get();

		return view('archives.proprietaire_archive', compact('proprietaires'));
    }





    public function locataire()
    {
        $locataires = Locataire::where('archiver', 1)->orderBy('nom', 'ASC')->get();

		return view('archives.locataire_archive', compact('locataires'));

    }

    public function location()
    {
        $locations = Location::where('archiver', 1)->orderBy('date_location', 'DESC')->get();

        $locataires = Locataire::orderBy('nom', 'ASC')->get();
        $biens = Bien::orderBy('libelle', 'ASC')->get();
        $proprietaires = Proprietaire::orderBy('nom', 'ASC')->get();
        $appliquers = Appliquer::get();

        return view('archives.location_archive', compact('locations', 'locataires', 'biens', 'proprietaires', 'appliquers'));

    }

    public function facture()
    {
        $facts = Facture::where('archiver', 1)->orderBy('id', 'DESC')->get();

		return view('archives.facture', compact('facts'));
    }



    public function mandat()
    {
        $mandats = Mandat::where('archiver', 1)->orderBy('id', 'DESC')->get();

		return view('archives.mandat_archive', compact('mandats'));
    }



    public function etat()
    {
        $etats = Etat::where('archiver', 1)->get();


		return view('archives.etat_archive', compact('etats'));
    }



	public function loyer()
    {
        $factures = Facture::where('archiver', 1)->get();
		$reglements = Reglement::orderBy('created_at', 'DESC')->get();
        $appliquers = Appliquer::get();

		return view('archives.facture_archive', compact('factures', 'reglements', 'appliquers'));
    }

	public function facturation()
    {
        $revers = Reversement::where('archiver', 1)->get();

		return view('archives.reversement_archive', compact('revers'));
    }


	public function honoraire()
    {
        //$revers = Honora::where('archiver', 1)->get();

		return view('archives.honoraire_archive');
    }

	public function relance()
    {
        //$revers = Honora::where('archiver', 1)->get();

		return view('archives.relance_archive');
    }

	public function quittance()
    {
        $quittances = Quittance::where('archiver', 1)->get();
		//var_dump($quittances); exit();

		return view('archives.quittance_archive', compact('quittances'));
    }


	public function reglement()
    {
        $reglements = Reglement::where('archiver', 1)->get();

		return view('archives.reglement_archive', compact('reglements'));
    }






	//---------- BIEN --------------------------------------------------

	public function bien()
    {
        $biens = Bien::where('archiver', 1)->where('typebien_id', 1)->orderBy('typebien_id', 'ASC')->get();

		return view('archives.bien_archive', compact('biens'));
    }

	public function bien_maison()
    {
        $biens = Bien::where('archiver', 1)->where('typebien_id', 2)->get();

		return view('archives.bien_maison_archive', compact('biens'));
    }



	public function bien_appartement()
    {
        $biens = Bien::where('archiver', 1)->where('typebien_id', 3)->get();

		return view('archives.bien_appartement_archive', compact('biens'));
    }


	public function bien_immeuble()
    {
        $biens = Bien::where('archiver', 1)->where('typebien_id', 4)->get();

		return view('archives.bien_immeuble_archive', compact('biens'));
    }

	public function bien_commerce()
    {
        $biens = Bien::where('archiver', 1)->where('typebien_id', 5)->get();

		return view('archives.bien_commerce_archive', compact('biens'));
    }




}
