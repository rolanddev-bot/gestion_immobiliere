<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Appartenir;
use App\Appliquer;
use App\Bien;
use App\Charge;
use App\Element;
use App\Equiper;
use App\Equiper_descript;
use App\Etat;
use App\Facture;
use App\Local_element;
use App\Des_element;
use App\Locataire;
use App\Location;
use App\Mode;
use App\Proprietaire;
use App\Reglement;
use App\Repositories\LocationRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    protected $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function index()
    {
        $locations = Location::orderBy('id', 'DESC')->where('archiver', 0)->get();
        $locataires = Locataire::orderBy('nom', 'ASC')->get();
        $biens = Bien::orderBy('libelle', 'ASC')->get();
        $proprietaires = Proprietaire::orderBy('nom', 'ASC')->get();
        $appliquers = Appliquer::get();

        return view('pages.location', compact('locations', 'locataires', 'biens', 'proprietaires', 'appliquers'));
    }

    public function search(Request $request)
    {
        $prop_id = $request->prop_id;

        $appars = Appartenir::where('proprietaire_id', $prop_id)->get();

        $mabox = '<select class="form-control" id="bien_id" name="bien_id">';

        foreach ($appars as $appar) {
            if ($appar->bien->mandat == 1) {
                $mabox .= '<option value="'.$appar->bien->id.'">';

                $mabox .= $appar->bien->libelle;

                $mabox .= '</option>';
            }
        }

        $mabox .= '</select>';

        return $mabox;
    }

    public function create()
    {
        $locataires = Locataire::orderBy('nom', 'ASC')->where('archiver', 0)->where('acquereur', 0)->get();
        $biens = Bien::orderBy('libelle', 'ASC')->where('libre', 1)
                ->where('mandat', 1)
                ->where('archiver', 0)
                ->where('etat_location', 0)
                ->get();

        $props = Proprietaire::orderBy('nom', 'ASC')->where('archiver', 0)->where('en_vente', 0)->get();
        $modes = Mode::orderBy('libelle', 'ASC')->where('masquer', 0)->get();

        $appliquers = Appliquer::get();

        return view('pages.location_create', compact('locataires', 'biens', 'props', 'appliquers', 'modes'));
    }

    public function store(Request $request)
    {
        /*
        $bien = Bien::whereId($request->bien_id)->first();
        if($bien->libre == 1) {
            return redirect()->back()->withOk('Désolé! Le bien choisi à un contrat en cours');
        }
        */

        $location_id = DB::table('locations')->max('id');

        $app_nb = Appartenir::where('bien_id', $request->bien_id)->count();
        if ($app_nb == 0) {
            return redirect()->back()->withOk("Désolé! Ce bien n'a pas encore de propriétaire.");
        }

        $mandat_nb = DB::table('locations')->where('archiver', 0)->where('bien_id', $request->bien_id)->count();

        if ($mandat_nb > 0) {
            return redirect()->back()->withOk('Désolé! Ce bien a un bail en cours. Pour créer un nouveau bail de ce bien, veuillez archiver l ancien. ');
        }

        $code = '';
        $num = $location_id + 1;

        if (strlen($num) == 1) {
            $code = '00'.$num;
        } elseif (strlen($num) == 2) {
            $code = '0'.$num;
        } else {
            $code = $num;
        }

        $cur_date_c = date('Y');
        $ref = 'LSP-'.$code.'-'.$cur_date_c;
        $ref_dg = 'DG-'.$code.'-'.$cur_date_c.'-'.$code;

        $location = Location::create([
        'ref' => $ref,
        'ref_depot_garantie' => $ref_dg,
        'user_id' => $request->user_id,
        'bien_id' => $request->bien_id,
        'locataire_id' => $request->locataire_id,
        'frais_enregistrement' => $request->frais_enregistrement,

        'loyer' => $request->loyer,

        'revision_annuelle_loyer' => $request->revision_annuelle_loyer,
        'frais_agence' => $request->frais_agence,
        'date_location' => $request->date_location,
        'duree' => $request->duree,
        'caution' => $request->caution,
        'detail' => $request->detail,
        'periodicite_loyer' => $request->periodicite_loyer,
        'revision_annuelle_loyer' => $request->revision_annuelle_loyer,

        'charge' => $request->charge,
        'etat' => $request->etat,
        'date_echeance' => $request->date_echeance,
        'date_resiliation' => $request->date_resiliation,
        'frais_timbre' => $request->frais_timbre,
        'jour_paiement' => $request->jour_paiement,
        'mode_id' => $request->mode_id,
        'taux_penalite' => $request->taux_penalite,
        'nbre_depot' => $request->nbre_depot,
        'type' => $request->type,
        ]);

        //Rendre le bien occupé
        Bien::where('id', $request->bien_id)->update([
            'libre' => 1,
            'etat_location' => 1,
        ]);

        $location_max = Location::max('id');

        $periodicite = '';

        $day = date('d');
        $mois = date('m');
        $annee = date('Y');

        //Charge+Loyer
        $mt_total = 0;
        $mt_total_def = 0;
        $mt_charge = 0;
        $nature = '';

        $mt_total = $location->charge + $location->loyer;

        $date_debut_mois_en_cours = Date::createFromDate($annee, $mois, $day);
        $date_fin = Date::createFromDate($annee, $mois, $day);

        //Générer la première facture
        if ($location->periodicite_loyer == 'Mensuel') {
            $periodicite = 'mensuel';
            $start = $date_debut_mois_en_cours->add('1 month')->firstOfMonth();
            $end = $date_fin->add('1 month')->lastOfMonth();
            $mt_total_def = $mt_total;
            $nature = $this->format_date($start->format('n/Y'));
        } elseif ($location->periodicite_loyer == 'Bimestriel') {
            $periodicite = 'bimestriel';
            $start = $date_debut_mois_en_cours->add('1 month')->firstOfMonth();
            $end = $date_fin->add('2 month')->lastOfMonth();
            $mt_total_def = $mt_total * 2;
            $nature = $this->format_date($start->format('n/Y')).' - '.$this->format_date($end->format('n/Y'));
        } elseif ($location->periodicite_loyer == 'Trimestriel') {
            $periodicite = 'trimestriel';
            $start = $date_debut_mois_en_cours->add('1 month')->firstOfMonth();
            $end = $date_fin->add('3 month')->lastOfMonth();
            $mt_total_def = $mt_total * 3;
            $nature = $this->format_date($start->format('n/Y')).' - '.$this->format_date($end->format('n/Y'));
        } elseif ($location->periodicite_loyer == 'Semestriel') {
            $periodicite = 'semestriel';
            $start = $date_debut_mois_en_cours->add('1 month')->firstOfMonth();
            $end = $date_fin->add('4 month')->lastOfMonth();
            $mt_total_def = $mt_total * 4;
            $nature = $this->format_date($start->format('n/Y')).' - '.$this->format_date($end->format('n/Y'));
        } elseif ($location->periodicite_loyer == 'Annuel') {
            $periodicite = 'annuel';
            $start = $date_debut_mois_en_cours->add('1 month')->firstOfMonth();
            $end = $date_fin->add('12 month')->lastOfMonth();
            $mt_total_def = $mt_total * 12;
            $nature = $this->format_date($start->format('n/Y')).' - '.$this->format_date($end->format('n/Y'));
        }

        $facture_id_max = DB::table('factures')->max('id');
        $ref = $this->facture_ref_codage($facture_id_max);

        Facture::create([
                    'ref' => $ref,
                    'location_id' => $location->id,
                    'nature' => $nature,
                    'montant' => $mt_total_def,
                    'date_debut' => $start,
                    'date_fin' => $end,
                    'mois' => $start->format('m'),
                    'annee' => $start->format('Y'),
                    'etat' => 0,
                    'periodicite_loyer' => $periodicite,
                    'date_facture' => date('Y-m-d'),
                    ]);

        return redirect('location/'.$location->id)->withOk('Contrat ajouté avec succès');
    }

    public function facture_ref_codage($facture_id)
    {
        $code = '';
        $num = $facture_id + 1;

        if (strlen($num) == 1) {
            $code = '00'.$num;
        } elseif (strlen($num) == 2) {
            $code = '0'.$num;
        } else {
            $code = $num;
        }

        $annee = date('Y');
        $ref = 'AL-'.$code.'-'.$annee;

        return $ref;
    }

    //Convert Date
    public function format_date($maDate)
    {
        setlocale(LC_TIME, 'fr', 'fr_FR', 'fr_FR.ISO8859-1');
        $nom_jour_fr = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        $mois_fr = ['', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août',
                'Septembre', 'Octobre', 'Dovembre', 'Décembre', ];

        // on extrait la date du jour date("w/d/n/Y")
        // on extrait la date du jour date("n/Y")
        list($mois, $annee) = explode('/', $maDate);

        $maDate = $mois_fr[$mois].' '.$annee;

        return $maDate;
    }

    public function show($id)
    {
        $location = Location::where('id', $id)->first();
        $appliquers = Appliquer::where('location_id', $location->id)->get();
        $charges = Charge::orderBy('libelle', 'ASC')->get();

        $equipers = Equiper::where('bien_id', $location->bien->id)->get();
        $elts = Local_element::get();
        $elements = Element::get();

        $etat = Etat::where('location_id', $id)->where('entree_sortie', 'Entrée')->first();
        $etats = Etat::where('location_id', $id)->where('entree_sortie', 'Sortie')->first();

        return view('pages.location_detail', compact('location', 'appliquers', 'charges', 'equipers', 'elts', 'elements', 'etat', 'etats'));
    }

    public function charge($id)
    {
        $location = $this->locationRepository->getById($id);
        $appliquers = Appliquer::where('location_id', $location->id)->get();
        $charges = Charge::where('type_charge','Locataire')->orderBy('libelle', 'ASC')->get();

        return view('pages.location_charge', compact('location', 'appliquers', 'charges'));
    }

    public function edit($id)
    {
        $location = $this->locationRepository->getById($id);
        $biens = Bien::where('libre', 0)->orderBy('libelle', 'ASC')->get();
        $proprietaires = Proprietaire::orderBy('nom', 'ASC')->where('archiver', 0)->get();
        $locataires = Locataire::where('archiver', 0)->orderBy('nom', 'ASC')->get();
        $appliquers = Appliquer::get();
        $modes = Mode::orderBy('libelle', 'ASC')->where('masquer', 0)->get();

        return view('pages.location_edit', compact('locataires', 'biens', 'proprietaires', 'appliquers', 'location', 'modes'));
    }

    public function update(Request $request)
    {
        $location = Location::whereId($request->location_id)->orderBy('id', 'DESC')->first();

        Location::where('id', $request->location_id)->update([
            'frais_enregistrement' => $request->frais_enregistrement,
            'loyer' => $request->loyer,
            'revision_annuelle_loyer' => $request->revision_annuelle_loyer,
            'frais_agence' => $request->frais_agence,
            'date_location' => $request->date_location,
            'date_resiliation' => $request->date_resiliation,

            'duree' => $request->duree,
            'caution' => $request->caution,
            'detail' => $request->detail,
            'periodicite_loyer' => $request->periodicite_loyer,
            'revision_annuelle_loyer' => $request->revision_annuelle_loyer,

            'etat' => $request->etat,
            'charge' => $request->charge,
            'frais_timbre' => $request->frais_timbre,
            'jour_paiement' => $request->jour_paiement,
            'mode_id' => $request->mode_id,
            'taux_penalite' => $request->taux_penalite,
            'archiver' => $request->archiver,
            'type' => $request->type,
            'nbre_depot' => $request->nbre_depot,
        ]);

        return redirect('location/'.$location->id)->withOk('Location modifiée');
    }

    //------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------
    //----------------- CONTROLER ----------------
    //------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------
    public function archive_location(Request $request)
    {
        if ($request->archiver == 0) {
            Location::where('id', $request->id)->update(['archiver' => 1]);
        } else {
            Location::where('id', $request->id)->update(['archiver' => 0]);
        }

        return redirect('location')->with('ok');
    }

    public function appli(Request $request)
    {
        Appliquer::Create([
            'location_id' => $request->location_id,
            'charge_id' => $request->charge_id,
            'date_charge' => date('Y-m-d'),
            'montant_charge' => $request->montant_charge,
        ]);

        return redirect()->back()->withOk('Mise à jour effectuée! ');
    }

    public function applisupp(Request $request)
    {
        Appliquer::whereId($request->appliquer_id)->delete();

        return redirect()->back()->withOk('Charge supprimée! ');
    }

    //------------ REPORT ------------

    public function occupation()
    {
        $locations = Location::whereIn('etat', ['En cours', 'Suspendu'])->orderBy('id', 'DESC')->get();
        $locataires = Locataire::orderBy('nom', 'ASC')->get();
        $biens = Bien::orderBy('libelle', 'ASC')->get();
        $proprietaires = Proprietaire::orderBy('nom', 'ASC')->get();
        $appliquers = Appliquer::get();

        return view('pages.location_occupation', compact('locations', 'locataires', 'biens', 'proprietaires', 'appliquers'));
    }

    public function paiement()
    {
        $reglements = Reglement::orderBy('created_at', 'DESC')->get();
        $locataires = Locataire::orderBy('nom', 'ASC')->get();

        //var_dump($reglements);
        return view('pages.facture_paiement', compact('reglements', 'locataires'));
    }

    public function imprimer_location(Request $request, $id)
    {
        $locations = Location::where('id', $id)->first();

        $equipers = Equiper_descript::where('bien_id', $locations->bien_id)->get();
        $elements =Des_element::get();


        $montant_charge = Appliquer::where('location_id', $id)->sum('montant_charge');
        $id_typelocataire = $locations->locataire_id;
        $type_location = $locations->type;
        $typelocataire = Locataire::where('id', $id_typelocataire)->value('type_locataire_acq');
        $agence = Agence::whereId(1)->first();

        if ($type_location == 'Commercial') {
            $locationsper_morale = Location::where('locataire_id', $id_typelocataire)->first();
            $pdf = PDF::loadView('pages.location_print_professionnel', compact('elements','equipers','locations', 'locationsper_morale', 'montant_charge', 'agence'));

            $nom = 'Bail Pro - '.$locations->ref.' - '.date('dmY');

            return $pdf->download($nom.'.pdf');
        } else {
            $locationsper_physique = Location::where('locataire_id', $id_typelocataire)->first();
            $anne = date('Y', strtotime($locationsper_physique->date_echeance));
            $duree = ($locationsper_physique->duree) + $anne;
            $fin_contrat = date('d-m', strtotime($locationsper_physique->date_echeance)).'-'.$duree;

            $pdf = PDF::loadView('pages.location_print_habitation', compact('elements','equipers', 'locations', 'fin_contrat', 'locationsper_physique', 'montant_charge', 'agence'));

            $nom = 'Bail Hab - '.$locationsper_physique->ref.' - '.date('dmY');

            return $pdf->download($nom.'.pdf');
        }
    }

    public function depot_garantie_location(Request $request, $id)
    {
        $locations = Location::where('id', $id)->first();
        $id_typelocataire = $locations->locataire_id;
        $typelocataire = Locataire::where('id', $id_typelocataire)->value('type_locataire_acq');
        if ($typelocataire == 'personne morale') {
            $adresse = Locataire::where('id', $id_typelocataire)->value('adresse_societe');
        } else {
            $adresse = Locataire::where('id', $id_typelocataire)->value('adresse');
        }
        $pdf = PDF::loadView('pages.location_depot_garantie_pdf', compact('locations', 'adresse'));

        $nom = 'Depot Gar - '.$locations->ref_depot_garantie.' - '.date('dmY');

        return $pdf->download($nom.'.pdf');
    }
}
