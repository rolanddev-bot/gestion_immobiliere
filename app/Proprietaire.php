<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proprietaire extends Model
{
    protected $table = 'proprietaires';
    protected $fillable = [
        'nom', 'prenom', 'date_naissance', 'emailto', 'mobile1', 'adresse', 'sexe', 'type_piece', 'numero_piece', 'photo_piece',
         'type_proprietaire',
        'document', 'photo', 'activ', 'mobile2', 'telephone', 'nom_societe', 'nom_representant',
        'contact1_representant', 'contact2_representant', 'adresse_representant',
        'numero_registre', '	compte_contribuable', 'telephone_societe', 'adresse_societe', 'actif',
        'archiver', 'banque_id', 'compte_bancaire', 'en_vente', 'etablie_le', 'domicile_a', 'profession', ];

    public function mandat()
    {
        return $this->hasMany('App\Mandat');
    }

    public function banque()
    {
        return $this->belongsTo('App\Banque');
    }
}
