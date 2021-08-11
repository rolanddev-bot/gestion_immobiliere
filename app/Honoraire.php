<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Honoraire extends Model
{    
    protected $table = 'honoraires';
	protected $fillable = [ 'ref', 'reversement_id', 'nom_agent', 'delai', 'detail', 'montant_lettre', 'archiver', 'mode'];
	public $timestamps = true;	
	
	public function reversement() 
    {
        return $this->belongsTo('App\Reversement');
    }

   
    

}
