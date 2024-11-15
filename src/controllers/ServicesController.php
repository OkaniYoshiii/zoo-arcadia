<?php

namespace App\Controllers;

use App\Entities\Service;
use MongoDB\Model\BSONDocument;

class ServicesController 
{
    public function getVariables(): array
    {
        $services = array_map(function(BSONDocument $service) { return new Service($service->getArrayCopy()); }, ServicesCollection->find()->toArray());

        return ["services" => $services];
    }
}