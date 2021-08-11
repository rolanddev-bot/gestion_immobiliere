<?php

namespace App\Repositories;

use App\Acheter;

class AcheterRepository extends ResourceRepository
{

    public function __construct(Acheter $acheter)
    {
        $this->model = $acheter;
    }
	
}
