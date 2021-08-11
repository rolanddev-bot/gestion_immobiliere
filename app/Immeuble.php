<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Immeuble extends Model
{
    public $timestamps = false;
    //public $email = false;
    protected $table = 'immeubles';
    protected $fillable = ['libelle', 'detail', 'section', 'parcelle', 'lot', 'ilot', 'commune_id', 'adresse', 'archiver'];

    public function biens() 
	{
    	return $this->hasMany('App\Bien');
    }
	
	public function commune()
    {
        return $this->belongsTo('App\Commune');
    }
    
}
