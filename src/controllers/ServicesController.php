<?php

use App\Entity\Service;

class ServicesController 
{
    public function getVariables(): array
    {
        $services = array_map(function(array $service) { return new Service($service); }, ServicesDB->findAll());

        return ["services" => $services];
    }
}