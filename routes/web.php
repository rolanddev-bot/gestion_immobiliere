<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('pages.verifier_logout');
});

//Route::get('/portail/{id}', 'DashbordController@portail')->name('portail');

Route::get('/test', function () {
    return view('pages.test');
});

Auth::routes();

Route::get('/home', 'DashbordController@index')->name('dashbord'); 
Route::get('/', 'DashbordController@index')->name('dashbord');
Route::get('/Dashbord', 'DashbordController@index')->name('Dashbord');

Route::get('/proprietaire', 'ProprietaireController@index')->name('proprietaire');
Route::get('/proprietaire-create', 'ProprietaireController@create')->name('createproprietaire');
Route::post('/proprietaire-store', 'ProprietaireController@store')->name('proprietairestore');
Route::get('/proprietaire/{id}/edit', 'ProprietaireController@edit')->name('proprietaireedit');
Route::get('/proprietaire/{id}', 'ProprietaireController@show')->name('proprietaireshwo');
Route::post('/proprietaire-update', 'ProprietaireController@update')->name('proprietaireupdate');
Route::post('/proprietaire-delete', 'ProprietaireController@delete')->name('proprietairedelete');

//LOcataire
Route::get('/locataire', 'LocataireController@index')->name('locataire');
Route::get('/locataire/{id}', 'LocataireController@show')->name('locataireshow');
Route::get('/locataire-create', 'LocataireController@create')->name('locatairecreate');
Route::get('/locataire/{id}/edit', 'LocataireController@edit')->name('locataire_edit');

Route::post('/locataire-update', 'LocataireController@update')->name('locataireupdate');
Route::post('/locataire-store', 'LocataireController@store')->name('locataire_store');
Route::post('/archive_locataire', 'LocataireController@archive_locataire')->name('archive_locataire');
//************************************** pour type bien***********************************************************************
Route::get('/typebien', 'TypebienController@index')->name('typebien');
Route::post('/createtypebien', 'TypebienController@create')->name('createtypebien');
Route::post('/deletetypebien', 'TypebienController@delete')->name('deletetypebien');
//************************************** fin type bien***********************************************************************
//************************************** pour les charges****************************************************

Route::get('/charge', 'BienController@indexcharge')->name('charge');
Route::post('/createcharge', 'BienController@createcharge')->name('createcharge');
Route::post('/deletecharge', 'BienController@deletecharge')->name('deletecharge');
//************************************** pour les biens****************************************************

Route::get('/bien', 'BienController@index')->name('bien');
Route::get('/bien/{id}/create/', 'BienController@create')->name('biencreate');
Route::post('/bien-store', 'BienController@store')->name('bienstore');
Route::get('/bien/{id}/edit', 'BienController@edit')->name('bienedit');
Route::get('/bien/{id}/cat', 'BienController@cat')->name('biencat');
Route::post('/bien-update', 'BienController@update')->name('bienupdate');

Route::post('/deletebien', 'BienController@delete')->name('deletebien');
Route::get('/bien/{id}', 'BienController@show')->name('biendetail');

Route::post('/equipercreate', 'BienController@equipercreate')->name('equipercreate');
Route::get('/equipersup/{id}', 'BienController@equipersup')->name('equipersup');
Route::get('/des_equipersup/{id}', 'BienController@des_equipersup')->name('des_equipersup');

// ***************************************gestion des ventes et  factures ventes***************************************//

Route::get('/vente', 'VenteController@index')->name('vente');
Route::post('/createvente', 'VenteController@store')->name('createvente');
Route::get('/ajout_acheteur', 'VenteController@acheteur')->name('ajout_acheteur');
Route::get('/vente/{id}/edit', 'VenteController@show')->name('vente_detailaffiche');
Route::get('/createventedetail', 'VenteController@createdetail')->name('createventedetail');
Route::get('/updateventedetail', 'VenteController@updatedetail')->name('updateventedetail');
Route::get('/deleteventedetail/{vente_id}/{acheter_id}', 'VenteController@deletedetail')->name('deleteventedetail');

// ********************regelement de la vente*********************************
Route::post('/ventereglementaffiche', 'VenteController@ventereglementaffiche')->name('ventereglementaffiche');
Route::post('/reglementventeajouter', 'VenteController@reglementventeajouter')->name('reglementventeajouter');
Route::post('/reglementventedelete', 'VenteController@reglementventedelete')->name('reglementventedelete');

//******************* */ gestion des quitances des reglements *******************************************//

Route::get('/reglementventequittance/{id}', 'VenteController@reglementventequittance')->name('reglementventequittance');
Route::get('/ventequittance_pdf', 'VenteController@listevente_pdf')->name('ventequittance_pdf');
Route::get('/vente_facture/{id}', 'VenteController@vente_facture')->name('vente_facture');

// ***************************************gestion des locations ***************************************//

Route::get('/location', 'LocationController@index')->name('location');
Route::get('/location-create', 'LocationController@create')->name('locationcreate');
Route::post('/location-store', 'LocationController@store')->name('locationstore');
Route::get('/location/{id}/edit', 'LocationController@edit')->name('locationedit');
Route::post('/locationupdate', 'LocationController@update')->name('locationupdate');
Route::post('/deletelocation', 'LocationController@delete')->name('deletelocation');

Route::post('/archive_location', 'LocationController@archive_location')->name('archive_location');

Route::get('/imprimer_location/{id}', 'LocationController@imprimer_location')->name('imprimer_location');
Route::get('/depot_garantie_location/{id}', 'LocationController@depot_garantie_location')->name('depot_garantie_location');

// ***************************************gestion des factures location ***************************************//

Route::get('/facture', 'FactureController@index')->name('facturereglement');
Route::post('/createfacture', 'FactureController@store')->name('facturetore');
Route::post('/facturedelete', 'FactureController@delete')->name('facturedelete');
Route::post('/updatefacture', 'FactureController@update')->name('updatefacture');
Route::post('/facture_rech_locataire', 'FactureController@rech_locataire')->name('rech_locataire');

Route::get('/facture-print/{id}', 'FactureController@facture_print')->name('facture_print');
Route::get('/reglement-print/{id}', 'ReglementController@reglement_print')->name('reglement_print');
Route::get('/reglement-print-direct/{id}', 'ReglementController@reglement_print_direct')->name('reglement_print_direct');

Route::post('/facturereglementaffiche', 'FactureController@facturereglementaffiche')->name('facturereglementaffiche');

Route::post('/reglement-store', 'ReglementController@store')->name('reglementstore');
Route::post('/reglementdelete', 'ReglementController@delete')->name('reglementdelete');

//Recherche dans liste de sélection
Route::post('reglement_rech_location', 'ReglementController@rech_location')->name('reglement_rech_location');
Route::post('reglement_rech_facture', 'ReglementController@rech_facture')->name('reglement_rech_facture');
Route::post('reglement_rech_montant', 'ReglementController@montant')->name('reglement_rech_montant');

// ***************************************gestion des mandats ***************************************//

 Route::get('/mandat', 'MandatController@index')->name('mandat');
 Route::get('/mandat/{id}', 'MandatController@show')->name('mandatshow');
 Route::post('/createmandat', 'MandatController@store')->name('createmandat');
 Route::post('/deletemandat', 'MandatController@delete')->name('deletemandat');

Route::post('/rech_mandat', 'MandatController@search')->name('search_mandat');
Route::post('/rech_mandat1', 'LocationController@search')->name('search_mandat1');

Route::post('/search_besoin', 'AchatController@search_besoin')->name('search_besoin');

 // ***************************************gestion des equipements et autres parties ********************************//
 Route::get('/detail_bienaffiche/{id}', 'Detail_bienController@index')->name('detail_bienaffiche');
 Route::get('/detail_biencreate', 'Detail_bienController@store')->name('detail_biencreate');
 Route::get('/deletedetails/{detailid}/{id}', 'Detail_bienController@delete')->name('deletedetails');
 Route::get('/detail_bienupdate', 'Detail_bienController@update')->name('detail_bienupdate');

 //nouvelle mise a jour du09/10/2020

 Route::get('/etat', 'EtatController@index')->name('etat');
 Route::get('/etat-create', 'EtatController@index')->name('etatcreate');
 Route::post('/etat-store', 'EtatController@store')->name('etatstore');
 Route::post('/etatupdate', 'EtatController@update')->name('etatupdtate');
 Route::post('/etatdelete', 'EtatController@delete')->name('etatdelete');
 Route::get('/etat-print/{id}', 'EtatController@print')->name('etatprint');
 Route::get('/etat/{id}', 'EtatController@show')->name('etatshow');

//Etat1
Route::get('/etat1', 'Etat1Controller@index')->name('etat1');
 Route::get('/etat1-create', 'Etat1Controller@index')->name('etat1create');
 Route::post('/etat1-store', 'Etat1Controller@store')->name('etat1store');
 Route::post('/etat1update', 'Etat1Controller@update')->name('etat1updtate');
 Route::post('/etat1delete', 'Etat1Controller@delete')->name('etatdelete');
 Route::get('/etat1-print/{id}', 'Etat1Controller@print')->name('etatprint');
 Route::get('/etat1/{id}', 'Etat1Controller@show')->name('etatshow');

 //Immeuble
 Route::get('/immeuble', 'ImmeubleController@index')->name('immeuble');
 Route::get('/immeuble/{id}/edit', 'ImmeubleController@show')->name('immeubleshwo');
 Route::post('/immeublecreate', 'ImmeubleController@store')->name('immeublestore');
 Route::post('/immeuble-update', 'ImmeubleController@update')->name('immeubleupdate');
 Route::post('/immeubledelete', 'ImmeubleController@delete')->name('immeubledelete');

 Route::post('/appartaffiche', 'ImmeubleController@appartaffiche')->name('appartaffiche');
 Route::post('/appartcreate', 'ImmeubleController@appartcreate')->name('appartcreate');
 Route::post('/appartdelete', 'ImmeubleController@appartdelete')->name('appartdelete');

 //--------------------------POTE

Route::post('/equipercreate', 'BienController@equipercreate')->name('equipercreate');
Route::post('/descript_create', 'BienController@descript_create')->name('descript_create');
Route::post('/equipersup', 'BienController@equipersup')->name('equipersup');
Route::get('/location/{id}', 'LocationController@show')->name('locationshow');
Route::get('/location-charge/{id}', 'LocationController@charge')->name('locationcharge');

Route::post('/appli', 'LocationController@appli')->name('appli');
Route::post('/applisupp', 'LocationController@applisupp')->name('applisupp');

//Rapport
Route::get('/location-occupation', 'LocationController@occupation')->name('location_occupation');

Route::get('/location-paiement', 'LocationController@paiement')->name('location_paiement');
Route::get('/charge-depense', 'ChargeController@charge')->name('charge_depense');

//Equipement
    Route::get('equipement', 'EquipementController@index')->name('equipement');
 Route::get('equipementstore', 'EquipementController@store')->name('equipementstore');
 Route::get('equipementupdate', 'EquipementController@update')->name('equipementupdate');
 Route::get('equipementsup', 'EquipementController@delete')->name('equipementsup');

 Route::get('agence', 'AgenceController@index')->name('agence');
 Route::post('agenceupdate', 'AgenceController@update')->name('agenceupdate');

//Honoraire
 Route::get('honoraire', 'HonoraireController@index')->name('honoraire');
 Route::get('honoraire-print/{id}', 'HonoraireController@hono_print')->name('hono_print');
 Route::get('honoraire-print-direct/{id}', 'HonoraireController@hono_print_direct')->name('hono_print_direct');
 Route::post('honoraire-store', 'HonoraireController@store')->name('honorairestore');

//Reversement

 Route::get('reversement', 'ReversementController@index')->name('reversement');
 Route::get('reversement/{id}', 'ReversementController@show')->name('reversementshow');
 Route::post('reversementstore', 'ReversementController@store')->name('reversementstore');
 Route::get('reversement/{id}/edit', 'ReversementController@edit')->name('reversementedit');
 Route::post('reversement-update', 'ReversementController@update')->name('reversementupdate');
 Route::post('reversementsup', 'ReversementController@delete')->name('reversementsup');
Route::get('/reversement-print/{id}', 'ReversementController@reversement_print')->name('reversement_print');
Route::get('/reversement-print-direct/{id}', 'ReversementController@reversement_print_direct')->name('reversement_print_direct');

 Route::post('rech_quittance', 'ReversementController@rech_quittance')->name('rech_quittance');
 Route::post('versement-store', 'VersementController@store')->name('versement_store');

 Route::post('prop_rech', 'ReversementController@prop')->name('prop_rech');

  // routes de quittance
 Route::get('/quittance_print/{id}', 'QuittanceController@quittance_print')->name('quittance_print');
 Route::get('/quittance-print-direct/{id}', 'QuittanceController@quittance_print_direct')->name('quittance_print_direct');
 Route::post('/archive_quittance', 'QuittanceController@archive_quittance')->name('archive_quittance');
 Route::get('/quittance', 'QuittanceController@index')->name('quittance');

 Route::get('element_store', 'EquipementController@storeelement')->name('element_store');
 Route::get('elementsup', 'EquipementController@archive_element')->name('elementsup');

Route::post('local-element-store', 'LocalelementController@store')->name('localelementstore');
Route::post('store_description', 'LocalelementController@store_description')->name('store_description');

 Route::get('local-element-delete/{id}', 'LocalelementController@delete')->name('localelementdelete');
 Route::get('des_delete/{id}', 'LocalelementController@des_delete')->name('des_delete');

//Route Mandat
 Route::get('/mandat', 'MandatController@index')->name('mandat');
 Route::get('/mandat-create', 'MandatController@create')->name('mandatcreate');
 Route::post('/mandat-store', 'MandatController@store')->name('mandatstore');
 Route::post('/mandat-update', 'MandatController@update')->name('mandatupdate');
 Route::post('/archivemandat', 'MandatController@archive')->name('archivemandat');
 Route::get('/mandat/{id}', 'MandatController@show')->name('mandatdetail_affiche');
 Route::get('/mandat/{id}/edit', 'MandatController@edit')->name('mandatedit');
 Route::get('/mandat_imprimer/{id}', 'MandatController@mandat_imprimer')->name('mandat_imprimer');
 Route::get('/mandat_imprimer_direct/{id}', 'MandatController@mandat_imprimer_direct')->name('mandat_imprimer_direct');

Route::get('user', 'UserController@index');
Route::post('password-reinit', 'UserController@reinit');
Route::get('user-print/{id}', 'UserController@imprimer');
Route::post('user-modif-pass', 'UserController@modifpass');
Route::post('user-sup', 'UserController@sup');
Route::get('user-excel/{forma}', 'UserController@excel');
Route::get('moncompte', 'UserController@compte');

Route::get('banque', 'BanqueController@index');
Route::post('banque_store', 'BanqueController@banque_store')->name('banque_store');
Route::post('mode_store', 'BanqueController@mode_store')->name('mode_store');

Route::get('quittance', 'QuittanceController@index');

//---------- ROUTE LEGA 18/11/2020

// terrain
Route::get('/terrain', 'BienController@index_terrain')->name('terrain');
Route::get('/terrain_create', 'BienController@terrain_create')->name('terrain_create');
Route::post('/terrain_store', 'BienController@terrain_store')->name('terrain_store');
Route::get('/terrain_detail/{id}', 'BienController@terrain_detail')->name('terrain_detail');
Route::get('/terrain_update/{id}', 'BienController@terrain_update')->name('terrain_update');
Route::post('/terrain_edit', 'BienController@terrain_edit')->name('terrain_edit');
Route::post('/archiver_terrain', 'BienController@archiver_terrain')->name('archiver_terrain');

// maison
Route::get('/maison', 'BienController@index_maison')->name('maison');
Route::get('/maison_create', 'BienController@maison_create')->name('maison_create');
Route::post('/maison_store', 'BienController@maison_store')->name('maison_store');
Route::post('/maison_edit', 'BienController@maison_edit')->name('maison_edit');
Route::get('/maison_update/{id}', 'BienController@maison_update')->name('maison_update');
Route::post('/archiver_maison', 'BienController@archiver_maison')->name('archiver_maison');

// commerce
Route::get('/commerce', 'BienController@index_commerce')->name('commerce');
Route::get('/commerce_create', 'BienController@commerce_create')->name('commerce_create');
Route::post('/commerce_store', 'BienController@commerce_store')->name('commerce_store');
Route::get('/commerce_update/{id}', 'BienController@commerce_update')->name('commerce_update');
Route::post('/commerce_edit', 'BienController@commerce_edit')->name('commerce_edit');
Route::post('/archiver_commerce', 'BienController@archiver_commerce')->name('archiver_commerce');

// appartement
Route::get('/appartement', 'BienController@index_appartement')->name('appartement');
Route::get('/appartement_create', 'BienController@appartement_create')->name('appartement_create');

Route::post('/appartement-store', 'AppartementController@store')->name('appartementstore');
Route::post('/appartement-update', 'AppartementController@update')->name('appartementupdate');

Route::get('/appartement/{id}/edit', 'AppartementController@edit')->name('appartement_edit');
Route::post('/archiver_appartement', 'BienController@archiver_appartement')->name('archiver_appartement');

//Relance
Route::get('/relance', 'RelanceController@index')->name('relance');
Route::post('/relancedelete', 'RelanceController@delete')->name('relancedelete');

//--- Archive -----------
Route::get('proprietaire-archive', 'ArchiveController@proprietaire');

Route::get('mandat-archive', 'ArchiveController@mandat');
Route::get('locataire-archive', 'ArchiveController@locataire');
Route::get('location-archive', 'ArchiveController@location');
Route::get('etat-archive', 'ArchiveController@etat');
Route::get('loyer-archive', 'ArchiveController@loyer');
Route::get('facturation-archive', 'ArchiveController@facturation');
Route::get('honoraire-archive', 'ArchiveController@honoraire');

//Loyer
Route::get('reglement-archive', 'ArchiveController@reglement');
Route::get('relance-archive', 'ArchiveController@relance');
Route::get('quittance-archive', 'ArchiveController@quittance');

//Bien
Route::get('bien-archive', 'ArchiveController@bien'); //Terrain
Route::get('bien-immeuble-archive', 'ArchiveController@bien_immeuble');
Route::get('bien-commerce-archive', 'ArchiveController@bien_commerce');
Route::get('bien-appartement-archive', 'ArchiveController@bien_appartement');
Route::get('bien-maison-archive', 'ArchiveController@bien_maison');

Route::get('/reglement', 'ReglementController@index')->name('reglement');

//*************************  gestion des achats******************* */
                              // gestion des acquereurs //
Route::get('/acquereur', 'AchatController@index_acquereur')->name('acquereur');
Route::get('/create_acquereur', 'AchatController@create_acquereur')->name('create_acquereur');
Route::post('/store_acquereur', 'AchatController@store_acquereur')->name('store_acquereur');
Route::post('/update_acquereur', 'AchatController@update_acquereur')->name('update_acquereur');
Route::post('/archive_acquereur', 'AchatController@archive_acquereur')->name('archive_acquereur');
Route::get('/edit_acquereur/{id}', 'AchatController@edit_acquereur')->name('edit_acquereur');
Route::get('/show_acquereur/{id}', 'AchatController@show_acquereur')->name('show_acquereur');

//--------------------- gestion des besoins
Route::get('/besoin', 'AchatController@besoin_index')->name('besoin');
Route::get('/besoin_create', 'AchatController@besoin_create')->name('besoin_create');
Route::post('/besoin_store', 'AchatController@besoin_store')->name('besoin_store');
Route::post('/besoin_update', 'AchatController@besoin_update')->name('besoin_update');
Route::get('/besoin_edit/{id}', 'AchatController@besoin_edit')->name('besoin_edit');
Route::post('/besoin_archive', 'AchatController@besoin_archive')->name('besoin_archive');
Route::get('/besoin_show/{id}', 'AchatController@besoin_show')->name('besoin_show');

//ajout de plusieurs besoin
Route::get('/ajout_besoin', 'AchatController@besoin_add')->name('ajout_besoin');

    //-------------------- gestion des besoins
Route::get('/budget', 'AchatController@budget_index')->name('budget');
Route::get('/budget_create', 'AchatController@budget_create')->name('budget_create');
Route::post('/budget_store', 'AchatController@budget_store')->name('budget_store');
Route::post('/budget_update', 'AchatController@budget_update')->name('budget_update');
Route::get('/budget_edit/{id}', 'AchatController@budget_edit')->name('budget_edit');
Route::post('/budget_archive', 'AchatController@budget_archive')->name('budget_archive');

  //**********************gestion des vente*********************************//

 Route::get('/proprietaire_vente', 'VenteController@proprietaire_vente')->name('proprietaire_vente');
 Route::get('/proprietaire_v_create', 'VenteController@proprietaire_v_create')->name('proprietaire_v_create');
 Route::post('/proprietaire_v_store', 'VenteController@proprietaire_v_store')->name('proprietaire_v_store');
 Route::post('/proprietaire_v_update', 'VenteController@proprietaire_v_update')->name('proprietaire_v_update');
 Route::get('/proprietaire_v_edit/{id}', 'VenteController@proprietaire_v_edit')->name('proprietaire_v_edit');
 Route::get('/proprietaire_v_show/{id}', 'VenteController@proprietaire_v_show')->name('proprietaire_v_show');

                             //***mandat vente***//
Route::get('/mandat_vente', 'VenteController@mandat_vente')->name('mandat_vente');
Route::get('/mandat_vente_create', 'VenteController@mandat_vente_create')->name('mandat_vente_create');
Route::post('/mandat_vente_store', 'VenteController@mandat_vente_store')->name('mandat_vente_store');
Route::get('/mandat_vente_edit/{id}/edit', 'VenteController@mandat_vente_edit')->name('mandat_vente_edit');
Route::get('/mandat_vente_show/{id}', 'VenteController@mandat_vente_show')->name('mandat_vente_show');
Route::post('/mandat_vente_update', 'VenteController@mandat_vente_update')->name('mandat_vente_update');

 //Route::post('/rech_mandat', 'MandatController@search')->name('search_mandat');

                                //***biens  vente***//
 Route::get('/bien_vente', 'VenteController@bien_vente')->name('bien_vente');
 Route::get('/bien_maison_vente', 'VenteController@bien_maison_vente')->name('bien_maison_vente');
 Route::get('/bien_appart_vente', 'VenteController@bien_appart_vente')->name('bien_appart_vente');
 Route::get('/bien_immeuble_vente', 'VenteController@bien_immeuble_vente')->name('bien_immeuble_vente');
 Route::get('/bien_commerce_vente', 'VenteController@bien_commerce_vente')->name('bien_commerce_vente');
 Route::get('/bien_vente_detail/{id}', 'VenteController@bien_vente_detail')->name('bien_vente_detail');

 Route::get('/bien_vente_edit/{id}/edit', 'VenteController@bien_vente_edit')->name('bien_vente_edit');
 Route::post('/bien_vente_update', 'VenteController@bien_vente_update')->name('bien_vente_update');
 Route::post('/bien_vente_store', 'VenteController@bien_vente_store')->name('bien_vente_store');

 Route::get('/bien/{id}/catvente', 'VenteController@catvente')->name('biencatvente');

  Auth::routes();
