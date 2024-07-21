<?php

use App\Entity\ScheduleHour;
use App\Entity\Service;
use App\Exception\UserInputException;
use App\Models\Table\HabitatsTable;

class HomeController {
    private static array $formData;

    public function getVariables() : array  {
        $habitats = HabitatsTable::getFrontendHabitats();

        $schedulesHours = SchedulesHoursStore
            ->createQueryBuilder()
            ->join(function ($hour) {
                return SchedulesStore
                    ->createQueryBuilder()
                    ->where(['schedules_hour_id', '=', $hour['_id']])
                    ->join(function($schedule) {
                        return SchedulesDaysStore->findBy(['_id', '=', $schedule['schedules_day_id']])[0];
                    }, 'schedules_day')
                    ->getQuery()
                    ->fetch();
            }, 'schedules')
            ->getQuery()
            ->fetch();

        $schedulesHours = array_map(function($data) {
            return new ScheduleHour($data);
        }, $schedulesHours);

        $services = array_map(function(array $service) { return new Service($service); }, ServicesDB->findAll(null, 3));

        return [
            'habitats' => $habitats,
            'services' => $services,
            'feedbacks' => self::getAllValidatedFeedbacks(),
            'schedulesHours' => $schedulesHours,
            'weekDays' => SchedulesDaysStore->findAll(),
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
        
        self::createFeedback();

        echo json_encode($feedbacks);
        die();
    }

    public static function createFeedback() : void
    {
        match(null) {
            self::$formData['username'] => throw new UserInputException('username', self::$formData['username'], 'string'),
            self::$formData['content'] => throw new UserInputException('content', self::$formData['username'], 'string'),
            self::$formData['date'] => throw new UserInputException('date', self::$formData['date'], 'date'),
            default => '',
        };

        FeedbacksDB->insert([
            'username' => self::$formData['username'],
            'content' => self::$formData['content'],
            'date' => self::$formData['date'],
            'is_validated' => false
        ]);
    }

    public static function getAllValidatedFeedbacks() : array
    {
        return FeedbacksDB->findBy(['is_validated', '===', 'true'],['date' => 'desc']);
    }
}