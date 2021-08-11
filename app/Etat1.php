<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etat1 extends Model
{    
    protected $table = 'etat1s';
    protected $fillable = [ 'user_id', 'ref', 'entree_sortie', 'mandat_id',  'date_etat', 'avis_locataire', 'avis_bailleur', 'detail', 'etat', 'cloture', 'archiver'];

	public $timestamps = true;	
	
	

    
    public function mandat() 
    {
        return $this->belongsTo('App\Mandat');
    }

}
