<?php

namespace App\Repositories;

use App\Appartement;

class AppartementRepository extends ResourceRepository
{

    public function __construct(Appartement $appartement)
    {
        $this->model = $appartement;
    }
	
}
