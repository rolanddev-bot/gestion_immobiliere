<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $table = 'factures';
    protected $fillable = ['user_id', 'user_nom', 'location_id',  'date_facture', 'nature', 'montant',
    'autre', 'ref', 'annee', 'mois', 'etat', 'datelega', 'montant_lettre', 'date_echeance', 'user_nom', 'date_debut',
     'date_fin', 'archiver', 'periodicite_loyer' ];

    public $timestamps = true;

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function reglements()
    {
        return $this->hasMany('App\Reglement');
    }

    public function quittance()
    {
        return $this->hasOne('App\Quittance');
    }
}
