<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annee extends Model
{
    protected $table = 'annees';
    protected $fillable = ['libelle' ];
    public $timestamps = true;

  
    public function quittances()
    {
        return $this->hasMany('App\Quittance');
    }

}
