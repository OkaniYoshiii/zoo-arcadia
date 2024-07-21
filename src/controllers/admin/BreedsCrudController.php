<?php

use App\Entity\Breed;
use App\Exception\FormInputException;
use App\Models\Table\BreedsTable;

class BreedsCrudController 
{
    public function createBreed(array $formData) : int
    {
        if(!isset($formData['name'])) throw new FormInputException('name', 'value is undefined');
        if(empty($formData['name'])) throw new Exception('empty value $formData[\'name\']');
        if(!is_string($formData['name'])) throw new Exception('$formData[\'name\'] is not a string');
        
        $breed = new Breed($formData);
        $breedId = BreedsTable::create($breed);
        return $breedId;
    }
}