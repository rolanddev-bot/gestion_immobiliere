<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    public $timestamps = false;
    //public $email = false;
    protected $table = 'equipements';
    protected $fillable = ['libelle', 'detail', 'archiver'];

    public function equipers()
    {
        return $this->hasMany('App\Equiper');
    }

    public function local_elements()
    {
        return $this->hasMany('App\Local_element');
    }
}
