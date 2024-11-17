<?php

namespace App\Controllers;

class RegisterViewsController
{
    public function processFormData() 
    {
        if(MONGODB_FLAG_ENABLED) {
            $analytics = file_get_contents("php://input") ?? null;
            $analytics = json_decode($analytics, true);
    
            if(!is_null($analytics)) {
                foreach($analytics['animals'] as $animalId => $views) {
                    $animal = AnimalViewsCollection->findOne(['animal_id' => $animalId]);
                    if(is_null($animal)) {
                        $animalViews = ['animal_id' => $animalId, 'views' => $views];
                        AnimalViewsCollection->insertOne($animalViews);
                    } else {
                        $animal['views'] += $views;
                        AnimalViewsCollection->updateOne(['_id' => $animal['_id']], ['$set' => $animal]);
                    }
                }
            }
        }
        
        die();
    }
}