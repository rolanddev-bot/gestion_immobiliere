<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equiper_descript extends Model
{
    protected $table = 'equiper_descripts';
    protected $fillable = ['bien_id', 'description_id', 'detail'];
    public $timestamps = true;

    public function bien()
    {
        return $this->belongsTo('App\Bien');
    }

    public function description()
    {
        return $this->belongsTo('App\Description');
    }

    public function des_elements()
    {
        return $this->hasMany('App\Des_element');
    }
}
