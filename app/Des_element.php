<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Des_element extends Model
{
    protected $table = 'des_elements';
    protected $fillable = ['libelle', 'detail', 'description_id', 'equiper_descript_id'];
    public $timestamps = true;

    public function bien()
    {
        return $this->belongsTo('App\Bien');
    }

    public function description()
    {
        return $this->belongsTo('App\Description');
    }

    public function equiper_descript()
    {
        return $this->belongsTo('App\Equiper_descript');
    }
}
