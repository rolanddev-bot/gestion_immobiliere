<?php

namespace App\Repositories;

use App\Proprietaire;

class ProprietaireRepository extends ResourceRepository
{

    public function __construct(Proprietaire $proprietaire)
    {
        $this->model = $proprietaire;
    }
	
}
