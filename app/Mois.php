<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mois extends Model
{
    protected $table = 'moiss';
    protected $fillable = ['libelle' ];
   // public $timestamps = true;

  
    public function annee()
    {
        return $this->belongsTo('App\Annee');
    }

    public function quittance()
    {
        return $this->hasOne('App\Quittance');
    }

}
