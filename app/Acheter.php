<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acheter extends Model
{
    protected $table = 'acheters';
    public $timestamps = true;
    protected $fillable = [
        'vente_id', 'locataire_id', ];

    public function vente()
    {
        return $this->belongsTo('App\Vente');
    }

    public function locataire()
    {
        return $this->belongsTo('App\Locataire');
    }
}
