<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{    
    protected $table = 'etats';
    protected $fillable = [ 'user_id', 'ref', 'entree_sortie', 'location_id',  'date_etat', 'avis_locataire', 'avis_bailleur', 'detail', 'etat', 'cloture', 'archiver'];

	public $timestamps = true;	
	
	

    
    public function location() 
    {
        return $this->belongsTo('App\Location');
    }

}
