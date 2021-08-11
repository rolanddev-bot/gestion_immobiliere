<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $fillable = ['user_id', 'locataire_id',  'bien_id', 'frais_enregistrement', 'loyer',
    'revision_annuelle_loyer', 'frais_agence', 'periodicite_loyer', 'duree', 'caution', 'detail',
    'date_location', 'ref', 'charge', 'etat', 'date_echeance', 'mode_paiement', 'jour_paiement',
    'frais_timbre', 'taux_penalite', 'archiver', 'nbre_depot', 'ref_depot_garantie','type','date_resiliation',
     'mode_id'];
    public $timestamps = true;

    public function bien()
    {
        return $this->belongsTo('App\Bien');
    }

    public function locataire()
    {
        return $this->belongsTo('App\Locataire');
    }

	public function mode()
    {
        return $this->belongsTo('App\Mode');
    }


    public function etats()
    {
        return $this->hasMany('App\Etat');
    }

    public function factures()
    {
        return $this->hasMany('App\Facture');
    }
}
