<?php

namespace App\Repositories;

use App\Location;

class LocationRepository extends ResourceRepository
{

    public function __construct(Location $location)
    {
        $this->model = $location;
    }
	
}
