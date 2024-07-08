<?php

use App\Entity\ScheduleHour;
use App\Entity\Service;

class HomeController {
    private static array $formData;

    public function getVariables() : array  {
        $domains = [
            "Savane" => [
                "animals" => [
                    "Goerge" => "https://picsum.photos/500",
                    "Julie" => "https://picsum.photos/500",
                    "Timothée" => "https://picsum.photos/500",
                    "Nounours" => "https://picsum.photos/500",
                ],
                "description" => "<p>Environement propre aux régions chaudes, la savane regroupe de nombreux animaux comme  zèbres, les gnous, les éléphants, les girafes, les autruches, les gazelles et les buffles.</p><p>A Arcadia, nous avons fait notre maximum afin de recréer un environnement réprésentant le plus fidèlement possible l'état naturel de la savane. </p>"
            ],
            "Jungle" => [
                "animals" => [
                    "Patate" => "https://picsum.photos/500",
                    "Abeille" => "https://picsum.photos/500",
                    "Pingouin" => "https://picsum.photos/500",
                ],
                "description" => "<p>Environement propre aux régions chaudes, la savane regroupe de nombreux animaux comme  zèbres, les gnous, les éléphants, les girafes, les autruches, les gazelles et les buffles.</p><p>A Arcadia, nous avons fait notre maximum afin de recréer un environnement réprésentant le plus fidèlement possible l'état naturel de la savane. </p>"
            ],
            "Toundra" => [
                "animals" => [
                    "Patate" => "https://picsum.photos/500",
                    "Abeille" => "https://picsum.photos/500",
                    "Pingouin" => "https://picsum.photos/500",
                    "Mante" => "https://picsum.photos/500",
                ],
                "description" => "<p>Environement propre aux régions chaudes, la savane regroupe de nombreux animaux comme  zèbres, les gnous, les éléphants, les girafes, les autruches, les gazelles et les buffles.</p><p>A Arcadia, nous avons fait notre maximum afin de recréer un environnement réprésentant le plus fidèlement possible l'état naturel de la savane. </p>"
            ]
        ];
        
        $pages = [
            "current" => 1,
            "total" => 1
        ];

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
            'domains' => $domains,
            'services' => $services,
            'feedbacks' => self::getAllValidatedFeedbacks(),
            'pages' => $pages,
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
            self::$formData['username'] => throw new Exception('Username is null'),
            self::$formData['content'] => throw new Exception('Content is null'),
            self::$formData['date'] => throw new Exception('Date is null'),
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