<?php

namespace App\Controllers;

use App\Entities\Service;
use App\Exceptions\FormInputException;
use App\Tables\HabitatsTable;
use App\Tables\SchedulesTable;
use App\Tables\WeekDaysTable;
use App\Utilities\UserAlertsContainer;
use DateTime;
use MongoDB\Model\BSONDocument;

class HomeController {
    private static array $formData;

    public function getVariables() : array  {
        $habitats = HabitatsTable::getFrontendHabitats();

        $schedulesOrderedByHours = SchedulesTable::getOrderedBy(['schedule_hour_id', 'week_day_id']);
        $weekDays = WeekDaysTable::getAll();

        $services = [];
        if(MONGODB_FLAG_ENABLED) {
            $services = array_map(fn(BSONDocument $service) => new Service($service->getArrayCopy()), ServicesCollection->find([], ['limit' => 3])->toArray());
        }

        $feedbacks = self::getAllValidatedFeedbacks();

        return [
            'habitats' => $habitats,
            'services' => $services,
            'feedbacks' => $feedbacks,
            'schedulesOrderedByHours' => $schedulesOrderedByHours,
            'weekDays' => $weekDays,
        ];
    }

    public function processFormData()
    {
        self::$formData = [
            'username' => $_POST['username'] ?? null,
            'content' => $_POST['content'] ?? null,
            'date' => $_POST['date'] ?? null
        ];

        $feedbacks = self::getAllValidatedFeedbacks();

        file_put_contents('../test.txt', $feedbacks);
        
        self::createFeedback();

        echo json_encode($feedbacks);
        die();
    }

    public static function createFeedback() : void
    {
        if(!MONGODB_FLAG_ENABLED) return;

        match(null) {
            self::$formData['username'] => UserAlertsContainer::add('Veuillez spécifier un nom d\'utilisateur.'),
            self::$formData['content'] => UserAlertsContainer::add('Veuillez spécifier la description de votre avis.'),
            self::$formData['date'] => throw new FormInputException('date', FormInputException::UNDEFINED_VALUE),
            default => '',
        };

        if(UserAlertsContainer::hasAlerts()) return;

        file_put_contents('../test.txt', self::$formData['date']);

        self::$formData['date'] = DateTime::createFromFormat('d/m/Y', self::$formData['date']);

        FeedbacksCollection->insertOne([
            'username' => self::$formData['username'],
            'content' => self::$formData['content'],
            'date' => self::$formData['date']->getTimestamp(),
            'is_validated' => false
        ]);
    }

    public static function getAllValidatedFeedbacks() : array
    {
        return (MONGODB_FLAG_ENABLED) ? FeedbacksCollection->find(['is_validated' => true], ['sort' => ['date' => -1]])->toArray() : [];
    }
}