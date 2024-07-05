<?php

namespace App\Models\Table;

use App\Entity\VeterinarianReport;
use App\Interfaces\Tables\VeterinarianReportsTableInterface;
use Database;
use Exception;
use PDO;

class VeterinarianReportsTable extends Database implements VeterinarianReportsTableInterface
{
    static public function getAll(array $joins = []) : array|false
    {
        self::$statement = self::$pdo->query('SELECT vr.date, vr.detail, vr.food_quantity FROM veterinarian_reports as vr');
        
        return self::$statement->fetchAll(PDO::FETCH_CLASS, VeterinarianReport::class);
    }

    static public function create(VeterinarianReport $report) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO veterinarian_reports (`date`, `detail`, `food_quantity`, `user_id`, `food_type_id`, `animal_id`) VALUES (:date, :detail, :food_quantity, :user_id, :food_type_id, :animal_id)');

        $date = $report->getDate();
        $detail = $report->getDetail();
        $food_quantity = $report->getFoodQuantity();
        $user_id = $report->getUserId();
        $food_type_id = $report->getFoodTypeId();
        $animal_id = $report->getAnimalId();

        self::$statement->bindParam(':date', $date);
        self::$statement->bindParam(':detail', $detail);
        self::$statement->bindParam(':food_quantity', $food_quantity);
        self::$statement->bindParam(':user_id', $user_id);
        self::$statement->bindParam(':food_type_id', $food_type_id);
        self::$statement->bindParam(':animal_id', $animal_id);

        self::$statement->execute();
    }

    static public function update(VeterinarianReport $report) : void
    {

    }

    static public function delete(int $veterinarianReportid) : void
    {
        self::$statement = self::$pdo->prepare('DELETE FROM veterinarian_reports as vr WHERE vr.veterinarian_report_id = :veterinarian_report_id');

        self::$statement->bindParam(':veterinarian_report_id', $veterinarianReportid);

        self::$statement->execute();
    }

    static function isAlreadyRegistered(VeterinarianReport $report) : bool
    {
        self::$statement = self::$pdo->prepare('SELECT id FROM veterinarianReports as vr WHERE vr.date = :date AND vr.food_quantity = :food_quantity AND vr.user_id = :user_id AND vr.animal_id = :animal_id');

        self::$statement->bindParam(':date', $report->getDate());
        self::$statement->bindParam(':food_quantity', $report->getFoodQuantity());
        self::$statement->bindParam(':user_id', $report->getUserId());
        self::$statement->bindParam(':animal_id', $report->getAnimalId());

        self::$statement->execute();
        $result = self::$statement->fetch();
        return !empty($result);
    }

    static public function getOneBy(string $property, $value): VeterinarianReport|false
    {
        if(!property_exists(VeterinarianReport::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity Animal.');
        self::$statement = self::$pdo->prepare('SELECT * FROM veterinarian_reports WHERE ' . $property . ' = :val');
        
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        self::$statement->setFetchMode(PDO::FETCH_CLASS, VeterinarianReport::class);
        return self::$statement->fetch();
    }
}