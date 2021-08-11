<?php

namespace App\Repositories;

use App\Immeuble;

class ImmeubleRepository extends ResourceRepository
{

    public function __construct(Immeuble $immeuble)
    {
        $this->model = $immeuble;
    }
	
}
