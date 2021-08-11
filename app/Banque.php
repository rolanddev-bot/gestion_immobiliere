<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banque extends Model
{
    public $timestamps = false;
    protected $table = 'banques';
    protected $fillable = ['libelle', 'detail'];

    public function proprietaires()
    {
        return $this->hasMany('App\Proprietaire');
    }

    public function locataires()
    {
        return $this->hasMany('App\Locataire');
    }

}
