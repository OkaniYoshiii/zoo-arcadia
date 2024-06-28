<?php 

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
        $animals = AnimalsTable::getAll();

        return ['animalsViews' => $animals];
    }

    public function processFormData() : void
    {
        $analytics = file_get_contents("php://input") ?? null;

        if(!is_null($analytics)) {
            file_put_contents('../log.txt',$analytics);
            $analytics = json_decode($analytics, true);
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

    }
}