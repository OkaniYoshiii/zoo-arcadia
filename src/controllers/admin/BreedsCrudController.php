<?php

namespace App\Controllers\Admin;

use App\Entities\Breed;
use App\Exceptions\FormInputException;
use App\Tables\BreedsTable;
use Exception;

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