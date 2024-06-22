<?php

use App\Entity\VeterinarianReport;
use App\Interface\TableInterface;

class VeterinarianReportsTable extends Database implements TableInterface
{
    static public function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT vr.date, vr.detail, vr.food_quantity FROM veterinarian_reports as vr');
        
        return self::$statement->fetchAll(PDO::FETCH_CLASS, VeterinarianReport::class);
    }

    static public function create(array $properties) : void
    {

    }

    static public function update(array $properties) : void
    {

    }

    static public function delete(int $veterinarianReportid) : void
    {
        self::$statement = self::$pdo->prepare('DELETE FROM veterinarian_reports as vr WHERE vr.veterinarian_report_id = :veterinarian_report_id');

        self::$statement->bindParam(':veterinarian_report_id', $veterinarianReportid);

        self::$statement->execute();
    }

    static function isAlreadyRegistered(array $properties) : bool
    {
        self::$statement = self::$pdo->prepare('SELECT id FROM veterinarianReports as vr WHERE vr.date = :date AND vr.food_quantity = :food_quantity AND vr.user_id = :user_id AND vr.animal_id = :animal_id');

        self::$statement->bindParam(':date', $properties['date']);
        self::$statement->bindParam(':food_quantity', $properties['foodQuantity']);
        self::$statement->bindParam(':user_id', $properties['userId']);
        self::$statement->bindParam(':animal_id', $properties['animalId']);

        self::$statement->execute();
        $result = self::$statement->fetch();
        return !empty($result);
    }
}