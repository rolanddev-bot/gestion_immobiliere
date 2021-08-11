<?php

namespace App\Repositories;

use App\Typebien;

class TypebienRepository extends ResourceRepository
{

    public function __construct(Type $typebien)
    {
        $this->model = $typebien;
    }
	
}
