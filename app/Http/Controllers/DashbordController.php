<?php

namespace App\Http\Controllers;

use App\Proprietaire;
use App\Locataire;
use App\Location;
use App\Bien;
use App\Facture;
use App\Quittance;
use App\Reglement;
use App\Appliquer;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Date as FacadesDate;
use Illuminate\Support\Facades\DB;

class DashbordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //----------------------------------------------------------------
		//-------------------- Requêtes
		//Nbre Facture en attente
		$fact_nb_gle = DB::table('factures')->join('locations', 'factures.location_id', '=', 'locations.id')
			->where('factures.etat', 0)
			->where('locations.etat', 'En cours')
			->count();




		$appliquers = Appliquer::get();

		$mt_charge =0;
		$mt_total =0;






		//Traitement Date
		$day = date('d');
		$mois = date('m');
		$annee = date('Y');







		//------------- PARTIE MENSUELLE -----------------------------------------
		//Init
        $date_debut_mois_en_cours = Date::createFromDate($annee, $mois, $day);
		$date_fin = Date::createFromDate($annee, $mois, $day);

		$start = $date_debut_mois_en_cours->add('1 month')->firstOfMonth();
		$end =  $date_fin->add('1 month')->lastOfMonth();

		$location_mensuels = Location::where('etat', 'En cours')
			->where('periodicite_loyer', 'Mensuel')
			->get();
		foreach($location_mensuels as $location){



			$mt_charge = DB::table('appliquers')
					->join('locations', 'appliquers.location_id', '=', 'locations.id')
					->where('appliquers.location_id', '=', $location->id)
					->sum('appliquers.montant_charge');


				$fact_nb = Facture::where('mois', $start->format('m'))
					->where('annee', $start->format('Y'))
					->where('location_id', $location->id)
					->count();

				if($fact_nb == 0){//S'il n'existe pas de facture pour le mois prochain alors créer là

					$facture_id_max = DB::table('factures')->max('id');
					$ref =  $this->facture_ref_codage($facture_id_max);

					$mt_total = $mt_charge + $location->loyer;


				Facture::create([
					'ref' => $ref,
					'location_id' => $location->id,
					'nature' => $this->format_date($start->format('n/Y')),
					'montant' => $mt_total,
					'date_debut' => $start,
					'date_fin' => $end,
					'mois' => $start->format('m'),
					'annee' => $start->format('Y'),
					'etat' => 0,
					'date_facture' => date('Y-m-d')
					]);

				}

			$ref = '';
			}

/*

		//------------- PARTIE BIMENSTRIEL -----------------------------------------
		//Init
		$mt_total = 0;
		$mt_charge = 0;

		$date_debut_mois_en_cours_b = Date::createFromDate($annee, $mois, $day);
		$date_fin_b = Date::createFromDate($annee, $mois, $day);

		$start_b = $date_debut_mois_en_cours_b->add('1 month')->firstOfMonth();
		$end_b =  $date_fin_b->add('2 month')->lastOfMonth();

		$location_bimestriels = Location::where('etat', 'En cours')
			->where('periodicite_loyer', '=', 'Bimestriel')
			->get();



		foreach($location_bimestriels as $loc_b){

			$mt_charge_b = DB::table('appliquers')
					->join('locations', 'appliquers.location_id', '=', 'locations.id')
					->where('appliquers.location_id', '=', $loc_b->id)
					->sum('appliquers.montant_charge');


			$fact_last_id = DB::table('factures')->join('locations', 'factures.location_id', '=', 'locations.id')
			->where('factures.etat', '=', 0)
			->where('locations.id', '=', $loc_b->id)
			->select('factures.id')
			->max('factures.id');

			$mt_total = $mt_charge + $loc_b->loyer;

			//Cas 1: cas où c'est la première facture de ce bimestriel
			if($fact_last_id == ''){

				Facture::create([
					'ref' => '01',
					'location_id' => $loc_b->id,
					'nature' => $this->format_date($start_b->format('n/Y')),
					'montant' => $mt_total,
					'date_debut' => $start_b,
					'date_fin' => $end_b,
					'mois' => $start_b->format('m'),
					'annee' => $start_b->format('Y'),
					'etat' => 0,
					'bimestriel' => 'oui',
					'date_facture' => date('Y-m-d')
					]);

				}else{//Cas 2: Ce n'est pas la première facture de ce bimestriel
				$facture_b = Facture::whereId($fact_last_id)->first();

	$nb_facture_superieur = DB::table('factures')->join('locations', 'factures.location_id', '=', 'locations.id')
			->where('factures.etat', '=', 0)
			//->where('locations.id', '=', $loc_b->id)
			->where('factures.id', '=', $facture_b->id)
			->where('factures.date_fin', '<', $start_b)
			->select('factures.id')
			->count();

				if($nb_facture_superieur>0){

				Facture::create([
					'ref' => '01',
					'location_id' => $loc_b->id,
					'nature' => $this->format_date($start_b->format('n/Y')),
					'montant' => $mt_total,
					'date_debut' => $start_b,
					'date_fin' => $end_b,
					'mois' => $start_b->format('m'),
					'annee' => $start_b->format('Y'),
					'etat' => 0,
					'bimestriel' => 'oui',
					'date_facture' => date('Y-m-d')
					]);
					}
			}


			}
			$fact_last = Facture::whereId($fact_last_id)->first();


				$fact_nb_b = Facture::where('location_id', $location->id)
					//->where('annee', $start_b->format('Y'))
					->where('periodicite_loyer', '=', 'Bimestriel')
					->where('date_fin', '<', $fact_last->date_debut)
					->count();

			//echo $fact_nb_b;
		//exit();

				if($fact_nb_b == 0){//S'il n'existe pas de facture pour le mois prochain alors créer là

					$facture_id_max = DB::table('factures')->max('id');
					$ref =  $this->facture_ref_codage($facture_id_max);

					$mt_total = $mt_charge + $location->loyer;

			}

		*/
		//----------------------------------------------------------------
		//--------------------

		$proprietaire_nba = Proprietaire::where('actif', 0)->count(); //Actif
        $proprietaire_nbi = Proprietaire::where('actif', 1)->count();//inactif

        $locataire_nba = Locataire::where('actif', 0)->count();
        $locataire_nbi = Locataire::where('actif', 1)->count();

        $bien_nba = Bien::where('libre', 0)->count();
        $bien_nbi = Bien::where('libre', 1)->count();

        $contrat_nba = Location::where('Etat',['En cours', 'Suspendu'])->count();
        $contrat_nbi = Location::where('Etat', 'Résilié')->count();

        return view('dashbord', compact('proprietaire_nba', 'proprietaire_nbi', 'locataire_nba',
        'locataire_nbi', 'bien_nba', 'bien_nbi', 'contrat_nbi', 'contrat_nba', 'fact_nb_gle'));

    }


	public function facture_ref_codage($facture_id)
	{
        $code = '';
        $num = $facture_id + 1;

        if(strlen($num) == 1){$code = '00'.$num;}elseif (strlen($num) == 2) {$code = '0'.$num; }else{$code = $num; }

        $annee = date('Y');
        $ref = 'AL-'.$code.'-'.$annee;

		return $ref;
	}

	//Convert Date
	public function format_date($maDate)
	{
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
		$nom_jour_fr = array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
		$mois_fr = Array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août",
				"Septembre", "Octobre", "Dovembre", "Décembre");

		// on extrait la date du jour date("w/d/n/Y")
		// on extrait la date du jour date("n/Y")
		list($mois, $annee) = explode('/', $maDate);

		$maDate = $mois_fr[$mois].' '.$annee;


		return $maDate;
	}





	public function portail($id)
	{

		return view('auth.portail_login', compact('id'));
	}


}
