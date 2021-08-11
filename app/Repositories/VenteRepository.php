<?php

namespace App\Repositories;

use App\Vente;

class VenteRepository extends ResourceRepository
{

    public function __construct(Vente $vente)
    {
        $this->model = $vente;
    }
	
}
