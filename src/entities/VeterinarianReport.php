<?php

namespace App\Entity;

class VeterinarianReport
{
    private int $id;
    private \Datetime $date;
    private string $detail;
    private int $food_quantity;
    private int $user_id;
    private int $food_type_id;
    private int $animal_id;
}