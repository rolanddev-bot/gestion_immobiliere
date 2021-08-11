<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    public $timestamps = false;
    //public $email = false;
    protected $table = 'communes';
    protected $fillable = ['libelle' ];

    public function biens()
	{
    	return $this->hasMany('App\Bien');
    }
	
	public function communes()
	{
    	return $this->hasMany('App\Commune');
    }
}
