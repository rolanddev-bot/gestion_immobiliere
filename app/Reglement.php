<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    protected $table = 'reglements';
    protected $fillable = ['user_id', 'user_nom', 'facture_id',  'montant', 'date_reglement', 'ref', 'archiver'];

    public $timestamps = true;

    public function facture()
    {
        return $this->belongsTo('App\Facture');
    }
}
