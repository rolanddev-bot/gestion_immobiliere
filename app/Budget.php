<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = ['besoin_id','mode_id','montant','modalite','detail'];

    public function besoin()
    {
        return $this->belongsTo('App\Besoin');
    }

    public function mode()
    {
        return $this->belongsTo('App\Mode');
    }
}
