<?php

use App\Entity\Breed;
use App\Exception\UserInputException;
use App\Models\Table\BreedsTable;

class BreedsCrudController 
{
    public function createBreed(array $formData) : int
    {
        if(!isset($formData['name'])) throw new FormInputException('name', 'value is undefined');
        if(empty($formData['name'])) throw new UserInputException('name', 'value is empty');
        if(!is_string($formData['name'])) throw new UserInputException('name', 'value is not a string');
        
        $breed = new Breed($formData);
        $breedId = BreedsTable::create($breed);
        return $breedId;
    }
}