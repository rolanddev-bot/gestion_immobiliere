<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relance extends Model
{
    protected $table = 'relances';
	protected $fillable = [ 'facture_id', 'etat', 'date_relance', 'detail', 'ref', 'archiver'];
	public $timestamps = true;



    public function facture()
    {
        return $this->belongsTo('App\Facture');
    }
    
    public function annee()
    {
        return $this->belongsTo('App\Annee');
    }
}
