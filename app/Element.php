<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $table = 'elements';
    protected $fillable = [ 'libelle',  'detail', 'archiver'];


    public $timestamps = false;

    public function local_elements()
    {
        return $this->hasMany('App\Local_element');
    }

    
}
