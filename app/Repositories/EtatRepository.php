<?php

namespace App\Repositories;

use App\Etat;

class EtatRepository extends ResourceRepository
{

    public function __construct(Etat $etat)
    {
        $this->model = $etat;
    }
	
}
