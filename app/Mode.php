<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    public $timestamps = false;
    protected $table = 'modes';
    protected $fillable = ['libelle', 'masquer'];

    public function proprietaires()
    {
        return $this->hasMany('App\Proprietaire');
    }
	
	public function locations()
    {
        return $this->hasMany('App\Location');
    }

    public function locataire()
    {
        return $this->belongsTo('App\Locataire');
    }
}
