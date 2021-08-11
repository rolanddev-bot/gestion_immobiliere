<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{

    public $timestamps = true;
    //public $email = false;
    protected $table = 'descriptions';
    protected $fillable = ['libelle','detail' ];


    public function equiper_descripts()
    {
        return $this->hasMany('App\Equiper_descript');
    }
}
