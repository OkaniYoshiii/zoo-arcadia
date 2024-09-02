<?php

use App\Entity\AnimalImage;
use App\Entity\Schedule;
use App\Entity\ScheduleDay;
use App\Entity\ScheduleHour;
use App\Models\Table\AnimalImagesTable;
use App\Models\Table\AnimalsTable;
use App\Models\Table\SchedulesTable;
use App\Models\Table\WeekDaysTable;
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

        $schedulesOrderedByHours = SchedulesTable::getOrderedBy(['schedule_hour_id', 'week_day_id']);
        $weekDays = WeekDaysTable::getAll();


        return [
            'animals' => $animals,
            'schedulesOrderedByHours' => $schedulesOrderedByHours,
            'weekDays' => $weekDays,
        ];
    }

    public function processFormData() : void
    {
        $schedules = SchedulesTable::getAll();
        foreach($schedules as $schedule)
        {
            $isOpened = (in_array($schedule->getScheduleId(), $_POST['schedulesIds']));
            $schedule->setIsOpened($isOpened);
            SchedulesTable::update($schedule);
        }
    }
}