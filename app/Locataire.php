<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locataire extends Model
{
    public $timestamps = true;
    //public $email = false;
    protected $table = 'locataires';
    protected $fillable = [
        'nom', 'prenom', 'date_naissance', 'email', 'mob1', 'adresse', 'sexe', 'type_piece', 'numero_piece', 'type_locataire_acq',
    'autres', 'photo', 'mob2', 'registre_commerce', 'client', 'adresse_representant', 'locataire', 'nom_societe',
     'nom_representant','numero_registre','telephone_societe', 'contact1_representant','compte_contribuable',
     'adresse_societe' ,'contact2_representant', 'actif', 'banque_id', 'compte_bancaire', 'acquereur',
     'nationalite','etablie_le','domicile_a','capital_societe'];

    public function locataires()
    {
        return $this->hasMany('App\Locataire');
    }

    public function acheters()
    {
        return $this->hasMany('App\Acheter');
    }

    public function banque()
    {
        return $this->belongsTo('App\Banque');
    }
}
