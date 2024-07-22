<?php

use App\Entity\AnimalImage;
use App\Entity\Schedule;
use App\Entity\ScheduleDay;
use App\Entity\ScheduleHour;
use App\Models\Table\AnimalImagesTable;
use App\Models\Table\AnimalsTable;
use SleekDB\QueryBuilder;

class AdminDashboardController 
{
    public function getVariables(): array
    {
        /**
         * Le beacon envoyé par le navigateur en POST est recu
         * APRES la requête GET pour obtenuir le résultat de 
         * la page.
         * 
         * Le résultat est que si l'on va sur /habitats, que l'on
         * clique sur un animal puis que l'on va directement sur 
         * /admin, alors il faudra rafraichir la page une fois sur
         * /admin pour avoir les données fraiches.
         * 
         * La solution la plus simple est de rajouter un bouton 
         * "Mettre à jour les données" sur la page afin de 
         * récupérer les dernières données en temps réel.
         */
        $animals = AnimalsTable::getAllWithJoins();

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


        return [
            'schedulesHours' => $schedulesHours,
            'weekDays' => SchedulesDaysStore->findAll(),
            'animals' => $animals
        ];
    }

    public function processFormData() : void
    {
        $analytics = file_get_contents("php://input") ?? null;
        $analytics = json_decode($analytics, true);

        $analytics = file_get_contents("php://input") ?? null;
        $analytics = json_decode($analytics, true);

        if(!is_null($analytics)) {
            foreach($analytics['animals'] as $id => $views) {
                $animal = AnimalsViewsDB->findById($id);
                if(is_null($animal)) {
                    $animalViews = ['_id' => $id, 'views' => $views];
                    AnimalsViewsDB->updateOrInsert($animalViews, false);
                } else {
                    $animal['views'] += $views;
                    AnimalsViewsDB->update($animal);
                    $animal = AnimalsViewsDB->findById($id);
                }
            }
            die();
        }

        $schedules = SchedulesStore->findAll();
        foreach($schedules as $schedule)
        {
            $schedule['isOpen'] = (in_array($schedule['_id'], $_POST['schedulesIds']));
            SchedulesStore->update($schedule);
        }
    }
}