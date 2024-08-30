<?php

use App\Entity\ScheduleHour;
use App\Entity\Service;
use App\Exception\FormInputException;
use App\Models\Table\HabitatsTable;
use MongoDB\Model\BSONDocument;

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

        $services = array_map(function(BSONDocument $service) { return new Service($service->getArrayCopy()); }, ServicesCollection->find([], ['limit' => 3])->toArray());

        $feedbacks = self::getAllValidatedFeedbacks();

        return [
            'habitats' => $habitats,
            'services' => $services,
            'feedbacks' => $feedbacks,
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

        file_put_contents('../test.txt', $feedbacks);
        
        self::createFeedback();

        echo json_encode($feedbacks);
        die();
    }

    public static function createFeedback() : void
    {
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
        return FeedbacksCollection->find(['is_validated' => true], ['sort' => ['date' => -1]])->toArray();
    }
}