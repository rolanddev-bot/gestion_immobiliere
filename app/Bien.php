<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    protected $table = 'biens';
    protected $fillable = [
    'typebien_id', 'ref',  'loyer', 'immeuble', 'archiver', 'etat_mandat',

        'libelle', 'surface', 'type_commerce', 'type_maison',  'type_immeuble', 'nbre_piece', 'surface_habitable',

        'lot', 'ilot', 'section',  'parcelle', 'adresse', 'immeuble_id','etat_location',

        'meuble', 'a_vendre', 'garage', 'parking', 'balcon', 'terrasse', 'piscine', 'cuisine', 'viabilise', 'libre', 'parking_externe', 'ascenseur',
    'detail', 'mandat','occupe','non_viabilise','non_meuble' ];

    public $timestamps = true;

    public function typebien()
    {
        return $this->belongsTo('App\Typebien');
    }

    public function commune()
    {
        return $this->belongsTo('App\Commune');
    }

    public function immeuble()
    {
        return $this->belongsTo('App\Immeuble');
    }

    public function appartements()
    {
        return $this->hasMany('App\Appartement');
    }

    public function appartenirs()
    {
        return $this->hasMany('App\Appartenir');
    }

    public function ventes()
    {
        return $this->hasMany('App\Vente');
    }

    public function equipers()
    {
        return $this->hasMany('App\Equiper');
    }

    public function equiper_descripts()
    {
        return $this->hasMany('App\Equiper_descript');
    }

    public function mandats()
    {
        return $this->hasMany('App\Mandat');
    }
}
