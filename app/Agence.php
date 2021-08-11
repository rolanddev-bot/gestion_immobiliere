<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    protected $table = 'agences';
    protected $fillable = [
        'id', 'denomination',  'numero_registre', 'siege', 'forme',  'capital', 'telephone', 'adresse',
        'email_agence', 'num_rccm', 'sexe_representant', 'numero_agrement', 'date_relance', 'poste_representant',
         'detail', ];
    public $timestamps = false;

    public function typebien()
    {
        return $this->belongsTo('App\Typebien');
    }

    public function commune()
    {
        return $this->belongsTo('App\Commune');
    }

    public function appartements()
    {
        return $this->hasMany('App\Appartement');
    }

    public function appartenirs()
    {
        return $this->hasMany('App\Appartenir');
    }

    public function ventes()
    {
        return $this->hasMany('App\Vente');
    }

    public function equipers()
    {
        return $this->hasMany('App\Equiper');
    }

    public function mandat()
    {
        return $this->hasMany('App\Mandat');
    }
}
