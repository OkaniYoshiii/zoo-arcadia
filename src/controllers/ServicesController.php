<?php 

use Interfaces\Controller;

class ServicesController implements Controller
{
    public function getVariables(): array
    {
        $services = [
            "Restauration" => "https://picsum.photos/500",
            "Visite en petit train" => "https://picsum.photos/400",
            "Visite des habitats" => "https://picsum.photos/600"
        ];

        return ["services" => $services];
    }
}