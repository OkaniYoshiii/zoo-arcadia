<?php

use App\Entity\AnimalImage;
use App\Entity\Schedule;
use App\Entity\ScheduleDay;
use App\Entity\ScheduleHour;
use App\Models\Table\AnimalImagesTable;
use App\Models\Table\AnimalsTable;
use App\Models\Table\SchedulesTable;
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

        // SchedulesStore;

        $schedules = SchedulesTable::getAll();

        // $schedulesHours = array_map(function($data) {
        //     return new ScheduleHour($data);
        // }, $schedulesHours);


        return [
            'schedules' => $schedules,
            // 'schedulesHours' => $schedulesHours,
            'weekDays' => SchedulesDaysStore->findAll(),
            'animals' => $animals
        ];
    }

    public function processFormData() : void
    {
        $schedules = SchedulesTable::getAll();
        foreach($schedules as $schedule)
        {
            $schedule['isOpen'] = (in_array($schedule['_id'], $_POST['schedulesIds']));
            SchedulesTable::update($schedule);
        }
    }
}