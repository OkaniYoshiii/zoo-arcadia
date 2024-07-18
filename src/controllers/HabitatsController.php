<?php

use App\Models\Table\HabitatsTable;

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