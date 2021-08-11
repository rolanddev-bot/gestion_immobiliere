<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Besoin extends Model
{
  protected $fillable = ['typebien_id','libelle','adresse','nbre_piece','superficie'
                         ,'delai_acquisition','detail','archiver','	locataire_id','etat_budget'];

    public function typebien(){

        return $this->belongsTo('App\Typebien');
    }

    public function locataire()
    {
        return $this->belongsTo('App\Locataire');
    }


    public function budgets()
    {
        return $this->hasMany('App\Budget');
    }

}
