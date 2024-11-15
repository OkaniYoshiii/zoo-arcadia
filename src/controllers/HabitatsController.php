<?php

namespace App\Controllers;

use App\Tables\HabitatsTable;

class HabitatsController 
{
    public function getVariables(): array
    {
        $habitats = HabitatsTable::getFrontendHabitats();

        return [
            'habitats' => $habitats
        ];
    }
}