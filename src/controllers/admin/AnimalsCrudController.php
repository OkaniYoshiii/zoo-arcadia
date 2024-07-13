<?php

use App\Entity\Animal;
use App\Entity\AnimalImage;
use App\Models\Table\AnimalImagesTable;
use App\Models\Table\AnimalsTable;
use App\Models\Table\BreedsTable;
use App\Models\Table\HabitatsTable;
use App\Utilities\ImgUploader;

class AnimalsCrudController 
{
    static array $formData;

    public function getVariables(): array
    {
        $breeds = BreedsTable::getAll();
        $habitats = HabitatsTable::getAll();
        $animals = AnimalsTable::getAllWithJoins();
        return [
            'animals' => $animals,
            'breeds' => $breeds,
            'habitats' => $habitats,
        ];
    }

    public function processFormData() : void
    {
        self::$formData = [
            'animal_id' => $_POST['animal_id'] ?? null,
            'firstname' => $_POST['firstname'] ?? null,
            'animal_images' => $_FILES['animal_images'] ?? null,
            'breed_id' => $_POST['breed_id'] ?? null,
            'habitat_id' => $_POST['habitat_id'] ?? null,
        ];

        match($_POST['crudAction']) {
            'CREATE' => $this->createAnimal(),
            'UPDATE' => $this->updateAnimal(),
            'DELETE' => $this->deleteAnimal(),
            default => throw new Exception('A crudAction need to be defined in the form to process it correctly')
        };
    }

    private function createAnimal() : void
    {
        if(is_null(self::$formData['firstname'])) throw new Exception('form need to have an input sending data about firstname');
        if(is_null(self::$formData['animal_images'])) throw new Exception('form need to have an input sending data about animal_images');
        if(is_null(self::$formData['breed_id'])) throw new Exception('form need to have an input sending data about breed_id');
        if(is_null(self::$formData['habitat_id'])) throw new Exception('form need to have an input sending data about habitat_id');

        if(empty(self::$formData['firstname'])) throw new Exception('Cannot add entity Animal to database : field firstname is empty.');
        if(empty(self::$formData['animal_images'])) throw new Exception('Cannot add entity Animal to database : field animal_images is empty.');
        if(empty(self::$formData['breed_id'])) throw new Exception('Cannot add entity Animal to database : field breed_id is empty.');
        if(empty(self::$formData['habitat_id'])) throw new Exception('Cannot add entity Animal to database : field habitat_id is empty.');

        if(!is_string(self::$formData['firstname'])) throw new Exception('Cannot add entity Animal to database : field firstname is not a string.');
        // if(is_numeric(self::$formData['animal_images'])) throw new Exception('Cannot add entity Animal to database : field animal_images is not an array of files.');
        if(!is_numeric(self::$formData['breed_id'])) throw new Exception('Cannot add entity Animal to database : field breed_id is not numeric.');
        if(!is_numeric(self::$formData['habitat_id'])) throw new Exception('Cannot add entity Animal to database : field habitat_id is not numeric.');

        $formDataCopy = self::$formData;
        unset($formDataCopy['animal_images']);

        $animal = new Animal($formDataCopy);
        $animal_id = AnimalsTable::create($animal);

        foreach(self::$formData['animal_images']['tmp_name'] as $imgIndex => $imgTmpName)
        {
            $imgName = self::$formData['animal_images']['name'][$imgIndex];
            $animalImageData = ['animal_id' => $animal_id];

            $imgUploader = new ImgUploader();
            $imgUploader->upload(['name' => $imgName, 'tmp_name' => $imgTmpName]);
            $animalImageData['name'] = $imgUploader->getUploadedFileName();
            $animalImage = new AnimalImage($animalImageData);
            AnimalImagesTable::create($animalImage);
        }
    }

    private function updateAnimal() : void
    {

    }

    private function deleteAnimal() : void
    {

    }
}