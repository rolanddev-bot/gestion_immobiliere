<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equiper extends Model
{
    protected $table = 'equipers';
	protected $fillable = [ 'bien_id', 'equipement_id', 'detail',];
	public $timestamps = true;

	public function bien()
    {
        return $this->belongsTo('App\Bien');
    }

    public function equipement()
    {
        return $this->belongsTo('App\Equipement');
    }

    public function description()
    {
        return $this->belongsTo('App\Description');
    }




}
