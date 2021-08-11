<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typebien extends Model
{
    protected $table = 'typebiens';
    protected $fillable = ['libelle', 'details', 'archiver'];
    public $timestamps = false;

    public function biens()
    {
        return $this->hasMany('App\Bien');
    }
}
