<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    protected $table = 'charges';
    public $timestamps = true;
    protected $fillable = [
         'libelle', 'type_charge', ];
}
