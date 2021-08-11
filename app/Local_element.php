<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local_element extends Model
{
    protected $table = 'local_elements';
	protected $fillable = [ 'equipement_id', 'element_id', 'detail', 'equiper_id', 'note'];
	//public $timestamps = false;	
	
	public function equipement() 
    {
        return $this->belongsTo('App\Equipement');
    }

    public function element() 
    {
        return $this->belongsTo('App\Element');
    }
}
