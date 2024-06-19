<?php

use SleekDB\Store;

class SleekDbController 
{
    public function getVariables() : array
    {
        $animalStore = $this->getSleekDbInstance();
        $animalStore->insert(['animal' => 'Patate']);
        $animals = $animalStore->findAll();
        var_dump($animals);
        return ['animals' => $animals];
    }

    private function getSleekDbInstance() : Store
    {
        return new Store("animal_views", '../database', ['timeout' => false]);
    }
}