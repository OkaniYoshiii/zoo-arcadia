<?php

namespace App\Interfaces\Tables;

use App\Entity\VeterinarianReport;

interface VeterinarianReportsTableInterface extends TableInterface {
    static public function create(VeterinarianReport $report) : void;
    static public function update(VeterinarianReport $report) : void;
    static public function isAlreadyRegistered(VeterinarianReport $report) : bool;
    static public function getOneBy(string $property, $value) : VeterinarianReport;
}