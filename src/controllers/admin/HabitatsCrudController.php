<?php

use App\Entity\Habitat;
use App\Models\Table\HabitatsTable;

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
        ];

        match($_POST['crudAction']) {
            'CREATE' => $this->createHabitat($formData),
            'UPDATE' => $this->updateHabitat($formData),
            'DELETE' => $this->deleteHabitat($formData['habitat_id']),
            default => throw new Exception('Form need to implement an hidden field named crudAction. Possible values are : CREATE, UPDATE, DELETE.')
        };
    }

    private function createHabitat(array $formData) : void
    {
        if(!isset($formData['name'])) throw new Exception('form need to have an input sending data about Habitat name');
        if(!isset($formData['description'])) throw new Exception('form need to have an input sending data about Habitat description');
        
        if(empty($formData['name'])) throw new Exception('Cannot add entity Habitat to database : field name is empty.');
        if(empty($formData['description'])) throw new Exception('Cannot add entity Habitat to database : field description is empty.');
        
        if(!is_string($formData['name'])) throw new Exception('Cannot add entity Habitat to database : field name is not a string.');
        if(!is_string($formData['description'])) throw new Exception('Cannot add entity Habitat to database : field description is not a string.');
        
        $habitat = new Habitat($formData);
        $formData['habitat_id'] = HabitatsTable::create($habitat);

        $this->habitatImagesCrudController->createHabitatImage($formData);        
    }

    private function updateHabitat(array $formData) : void
    {

    }

    private function deleteHabitat(int $id) : void
    {
        if(!isset($formData['habitat_id'])) throw new Exception('form need to have an input sending data about Habitat habitat_id');

        HabitatsTable::delete($id);
    }
}