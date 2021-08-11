<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    public $timestamps = false;
    //public $email = false;
    protected $table = 'comptes';
    protected $fillable = ['location_id', 'avoir', 'reste', 'etat' ];

    public function location()
	{
    	return $this->belongTo('App\Location');
    }
}
