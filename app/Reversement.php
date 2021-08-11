<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reversement extends Model
{
    protected $table = 'reversements';
    protected $fillable = ['mandat_id', 'remise', 'date_revers',  'ref', 'detail', 'archiver', 'tva', 'impot'];

    public $timestamps = true;

    public function mandat()
    {
        return $this->belongsTo('App\Mandat');
    }

    public function versements()
    {
        return $this->hasMany('App\Versement');
    }
	
	public function honoraires()
    {
        return $this->hasMany('App\Honoraire');
    }

}
