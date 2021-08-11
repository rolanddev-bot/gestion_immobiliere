<?php

namespace App\Repositories;

use App\Facture;

class FactureRepository extends ResourceRepository
{

    public function __construct(Facture $facture)
    {
        $this->model = $facture;
    }
	
}
