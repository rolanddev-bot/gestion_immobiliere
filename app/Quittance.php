<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quittance extends Model
{
    protected $table = 'quittances';
	protected $fillable = [ 'facture_id', 'mois', 'date_quittance', 'annee', 'ref', 'bien_id', 'verser', 'archiver'];
	public $timestamps = false;



    public function facture()
    {
        return $this->belongsTo('App\Facture');
    }
    public function factures()
    {
        return $this->hasMany('App\Facture');
    }
    public function annee()
    {
        return $this->belongsTo('App\Annee');
    }
}
