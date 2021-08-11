<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenir extends Model
{    
    protected $table = 'contenirs';
	protected $fillable = [ 'bien_id', 'immeuble_id'];
	public $timestamps = false;	
	
	public function bien() 
    {
        return $this->belongsTo('App\Bien');
    }

    public function immeuble() 
	{
    	return $this->hasMany('App\Immeuble');
    }
    

}
