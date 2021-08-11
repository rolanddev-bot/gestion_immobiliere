<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appartenir extends Model
{
    protected $table = 'appartenirs';
	protected $fillable = [ 'bien_id', 'proprietaire_id'];
	public $timestamps = false;	
	
	public function bien() 
    {
        return $this->belongsTo('App\Bien');
    }

    public function proprietaire() 
    {
        return $this->belongsTo('App\Proprietaire');
    }
}
