<?php

namespace App\Controllers\Admin;

use App\Entities\Habitat;
use App\Exceptions\FormInputException;
use App\Tables\HabitatImagesTable;
use App\Tables\HabitatsTable;
use App\Utilities\UserAlertsContainer;

class HabitatsCrudController 
{
    private HabitatImagesCrudController $habitatImagesCrudController;

    public function __construct()
    {
        $this->habitatImagesCrudController = new HabitatImagesCrudController();
    }
    public function getVariables() : array
    {
        $habitats = HabitatsTable::getAllWithJoins();
        return [
            'habitats' => $habitats,
        ];
    }

    public function processFormData() : void
    {
        $formData = [
            'habitat_id' => $_POST['habitat_id'] ?? null,
            'name' => $_POST['name'] ?? null,
            'description' => $_POST['description'] ?? null,
            'veterinarian_comments' => $_POST['veterinarian_comments'] ?? null,
            'habitat_image' => $_FILES['habitat_image'] ?? null,
            'habitat_image_id' => $_POST['habitat_image_id'] ?? null,
        ];

        match($_POST['crudAction']) {
            'CREATE' => $this->createHabitat($formData),
            'UPDATE' => $this->updateHabitat($formData),
            'DELETE' => $this->deleteHabitat($formData),
            default => throw new FormInputException('crudAction', FormInputException::INVALID_CRUD_ACTION)
        };
    }

    private function createHabitat(array $formData) : void
    {
        if(!isset($formData['name'])) throw new FormInputException('name', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['description'])) throw new FormInputException('description', FormInputException::UNDEFINED_VALUE);
        
        if(empty($formData['name'])) throw new FormInputException('name', FormInputException::EMPTY_VALUE);
        if(empty($formData['description'])) throw new FormInputException('description', FormInputException::EMPTY_VALUE);
        
        if(!is_string($formData['name'])) throw new FormInputException('name', FormInputException::NOT_STRING);
        if(!is_string($formData['description'])) throw new FormInputException('description', FormInputException::NOT_STRING);
        
        $habitatImage = $formData['habitat_image'];
        unset($formData['habitat_image']);

        $habitat = new Habitat($formData);

        $formData['habitat_image'] = $habitatImage;
        if(HabitatsTable::isAlreadyRegistered($habitat) && $formData['habitat_image']['error'] === 4) UserAlertsContainer::add('L\'habitat que vous essayez de créer existe déjà.');

        if(UserAlertsContainer::hasAlerts()) return;

        $formData['habitat_id'] = HabitatsTable::create($habitat);
        if($formData['habitat_image']['error'] === 0) {
            $this->habitatImagesCrudController->createHabitatImage($formData);        
        }
    }

    private function updateHabitat(array $formData) : void
    {
        if(!isset($formData['habitat_id'])) throw new FormInputException('habitat_id', FormInputException::EMPTY_VALUE);
        if(!isset($formData['name'])) throw new FormInputException('name', FormInputException::EMPTY_VALUE);
        if(!isset($formData['description'])) throw new FormInputException('description', FormInputException::EMPTY_VALUE);
        
        if(empty($formData['habitat_id'])) throw new FormInputException('habitat_id', FormInputException::EMPTY_VALUE);
        if(empty($formData['name'])) throw new FormInputException('name', FormInputException::EMPTY_VALUE);
        if(empty($formData['description'])) throw new FormInputException('description', FormInputException::EMPTY_VALUE);
        
        if(!is_numeric($formData['habitat_id'])) throw new FormInputException('habitat_id', FormInputException::NOT_NUMERIC);
        if(!is_string($formData['name'])) throw new FormInputException('name', FormInputException::NOT_STRING);
        if(!is_string($formData['description'])) throw new FormInputException('description', FormInputException::NOT_STRING);

        $habitatImage = $formData['habitat_image'];
        unset($formData['habitat_image']);

        $habitat = new Habitat($formData);

        $formData['habitat_image'] = $habitatImage;
        if(HabitatsTable::isAlreadyRegistered($habitat) && $formData['habitat_image']['error'] === 4) UserAlertsContainer::add('L\'habitat que vous essayez de créer existe déjà.');
        
        if(UserAlertsContainer::hasAlerts()) return;
        
        HabitatsTable::update($habitat);
        if($formData['habitat_image']['error'] === 0) {
            $this->habitatImagesCrudController->updateHabitatImage($formData);
        }
    }

    private function deleteHabitat(array $formData) : void
    {
        if(!isset($formData['habitat_id'])) throw new FormInputException('habitat_id', FormInputException::UNDEFINED_VALUE);
        if(empty($formData['habitat_id'])) throw new FormInputException('habitat_id', FormInputException::EMPTY_VALUE);
        if(!is_numeric($formData['habitat_id'])) throw new FormInputException('habitat_id', FormInputException::NOT_NUMERIC);

        HabitatsTable::delete($formData['habitat_id']);
        HabitatImagesTable::delete($formData['habitat_id']);
    }
}