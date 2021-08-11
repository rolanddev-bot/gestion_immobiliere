<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appliquer extends Model
{    
    protected $table = 'appliquers';
	protected $fillable = [ 'location_id', 'charge_id','date_charge','montant_charge'];
	public $timestamps = false;	
	
	public function location() 
    {
        return $this->belongsTo('App\Location');
    }

    public function charge() 
    {
        return $this->belongsTo('App\Charge');
    }
    

}
