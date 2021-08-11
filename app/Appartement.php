<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appartement extends Model
{
    protected $table = 'appartements';
	protected $fillable = ['bien_id', 'libre', 'libelle', 'nbre_piece', 'surface', 'surface_habitable', 'piscine', 'cuisine', 'meuble', 'balcon', 'detail'];
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
