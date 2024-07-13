<?php

use App\Models\Table\AnimalsTable;

class AnimalsCrudController 
{
    public function getVariables(): array
    {
        $animals = AnimalsTable::getAllWithJoins();
        return [
            'animals' => $animals,
        ];
    }

    public function processFormData() : void
    {
        
    }
}