<?php

namespace App\Repositories;

use App\Bien;

class BienRepository extends ResourceRepository
{

    public function __construct(Bien $bien)
    {
        $this->model = $bien;
    }
	
}
