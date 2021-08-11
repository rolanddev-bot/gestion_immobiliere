<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reglementvente extends Model
{
    protected $table = 'reglementventes';
    protected $fillable = ['user_id', 'user_nom', 'vente_id',  'montant_reglement', 'date_reglement'];

    public $timestamps = true;

    public function vente()
    {
        return $this->belongsTo('App\Vente');
    }
}
