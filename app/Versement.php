<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{    
    protected $table = 'versements';
	protected $fillable = [ 'quittance_id', 'reversement_id', 'montant'];
	public $timestamps = true;	
	
	public function quittance() 
    {
        return $this->belongsTo('App\Quittance');
    }

    public function reversement() 
	{
    	return $this->hasMany('App\Reversement');
    }
    

}
