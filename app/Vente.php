<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $table = 'ventes';
    public $timestamps = true;
    protected $fillable = [
         'libelle', 'date_vente', 'remise', 'quantité', 'condition_vente', 'prix_unitaire', 'bien_id',
          'montant_total', 'tva', 'commentaire', 'locataire_id', 'reference', 'reste_payer', 'payer', 'statut', ];

    public function bien()
    {
        return $this->belongsTo('App\Bien');
    }

    public function acheters()
    {
        return $this->hasMany('App\Acheter');
    }

    public function reglementventes()
    {
        return $this->hasMany('App\Reglementvente');
    }
}
