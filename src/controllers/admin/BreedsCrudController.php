<?php

use App\Entity\Breed;
use App\Models\Table\BreedsTable;

class BreedsCrudController 
{
    public function createBreed(array $formData) : int
    {
        if(!isset($formData['name'])) throw new Exception('form need to have an input sending data about breed name');
        if(empty($formData['name'])) throw new Exception('Cannot add entity Breed to database : field name is empty.');
        if(!is_string($formData['name'])) throw new Exception('Cannot add entity Breed to database : field name is not a string.');
        
        $breed = new Breed($formData);
        $breedId = BreedsTable::create($breed);
        return $breedId;
    }
}