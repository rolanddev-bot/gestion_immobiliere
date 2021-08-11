<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mandat extends Model
{
    protected $table = 'mandats';
    protected $fillable = ['bien_id', 'ref', 'duree',  'commission', 'honnoraire', 'frequence_compte_rendu',
    'nbre_renouvellement', 'date_prise_effet', 'ref_reversement_loyer', 'date_enregistrement', 'autres_mandats',
     'type_mandat', 'archiver', 'etat_mandat', 'frais_cloture','mandat_vente','valeur_bien' ];

    public $timestamps = true;

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function reversement()
    {
        return $this->hasMany('App\Reversement');
    }

	public function etat1s()
    {
        return $this->hasMany('App\Etat1');
    }

    public function bien()
    {
        return $this->belongsTo('App\Bien');
    }

    public function proprietaire()
    {
        return $this->belongsTo('App\Proprietaire');
    }
}
