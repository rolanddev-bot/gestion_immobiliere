<?php

namespace App\Repositories;

use App\Appartenir;

class AppartenirRepository extends ResourceRepository
{

    public function __construct(Appartenir $appartenir)
    {
        $this->model = $appartenir;
    }
	
}
