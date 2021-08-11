<?php

namespace App\Repositories;

use App\Reglement;

class ReglementRepository extends ResourceRepository
{

    public function __construct(Reglement $reglement)
    {
        $this->model = $reglement;
    }
	
}
