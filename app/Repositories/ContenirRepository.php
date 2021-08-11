<?php

namespace App\Repositories;

use App\Contenir;

class ContenirRepository extends ResourceRepository
{

    public function __construct(Contenir $contenir)
    {
        $this->model = $contenir;
    }
	
}
