<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Effectuer extends Model
{
    public $timestamps = false;
    //public $email = false;
    protected $table = 'effectuers';
    protected $fillable = ['vente_id', 'locataire_id', 'nbre_client', 'date_effectuer'];

    public function effectuers()
    {
        return $this->hasMany('App\Effectuer');
    }

    public function vente()
    {
        return $this->belongsTo('App\Vente');
    }

    public function locataire()
    {
        return $this->belongsTo('App\Locataire');
    }
}
