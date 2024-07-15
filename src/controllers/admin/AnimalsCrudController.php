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
    private static array $formData;
    private AnimalImagesCrudController $animalImageCrudController;

    public function __construct()
    {
        $this->animalImageCrudController = new AnimalImagesCrudController();
    }

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
            'animal_images_id' => $_POST['animal_images_id'] ?? null,
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
        if(is_null(self::$formData['breed_id'])) throw new Exception('form need to have an input sending data about breed_id');
        if(is_null(self::$formData['habitat_id'])) throw new Exception('form need to have an input sending data about habitat_id');

        if(empty(self::$formData['firstname'])) throw new Exception('Cannot add entity Animal to database : field firstname is empty.');
        if(empty(self::$formData['breed_id'])) throw new Exception('Cannot add entity Animal to database : field breed_id is empty.');
        if(empty(self::$formData['habitat_id'])) throw new Exception('Cannot add entity Animal to database : field habitat_id is empty.');

        if(!is_string(self::$formData['firstname'])) throw new Exception('Cannot add entity Animal to database : field firstname is not a string.');
        if(!is_numeric(self::$formData['breed_id'])) throw new Exception('Cannot add entity Animal to database : field breed_id is not numeric.');
        if(!is_numeric(self::$formData['habitat_id'])) throw new Exception('Cannot add entity Animal to database : field habitat_id is not numeric.');

        $formData = self::$formData;
        $animalsImages = $formData['animal_images'];
        unset($formData['animal_images']);

        $animal = new Animal($formData);
        $animalId = AnimalsTable::create($animal);

        $formData['animal_id'] = $animalId;
        $formData['animal_images'] = $animalsImages;

        $animalImagesCount = count($formData['animal_images']['tmp_name']);

        for($i = 0; $i < $animalImagesCount; $i++)
        {
            $data['animal_image']['tmp_name'] = $formData['animal_images']['tmp_name'][$i];
            $data['animal_image']['name'] = $formData['animal_images']['name'][$i];
            $data['animal_image']['error'] = $formData['animal_images']['error'][$i];
            $data['animal_id'] = $formData['animal_id'];
            $this->animalImageCrudController->createAnimalImage($data);
        }
    }

    private function updateAnimal() : void
    {
        if(is_null(self::$formData['animal_id'])) throw new Exception('form need to have an input sending data about animal_id');
        if(is_null(self::$formData['firstname'])) throw new Exception('form need to have an input sending data about firstname');
        if(is_null(self::$formData['breed_id'])) throw new Exception('form need to have an input sending data about breed_id');
        if(is_null(self::$formData['habitat_id'])) throw new Exception('form need to have an input sending data about habitat_id');

        if(empty(self::$formData['animal_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is empty.');
        if(empty(self::$formData['firstname'])) throw new Exception('Cannot add entity Animal to database : field firstname is empty.');
        if(empty(self::$formData['breed_id'])) throw new Exception('Cannot add entity Animal to database : field breed_id is empty.');
        if(empty(self::$formData['habitat_id'])) throw new Exception('Cannot add entity Animal to database : field habitat_id is empty.');

        if(!is_numeric(self::$formData['animal_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is not numeric.');
        if(!is_string(self::$formData['firstname'])) throw new Exception('Cannot add entity Animal to database : field firstname is not a string.');
        if(!is_numeric(self::$formData['breed_id'])) throw new Exception('Cannot add entity Animal to database : field breed_id is not numeric.');
        if(!is_numeric(self::$formData['habitat_id'])) throw new Exception('Cannot add entity Animal to database : field habitat_id is not numeric.');

        $formData = self::$formData;
        unset($formData['animal_images']);

        $animal = new Animal($formData);

        $hasUpdatedFiles = !(in_array(4, self::$formData['animal_images']['error']));

        if(AnimalsTable::isAlreadyRegistered($animal) && !$hasUpdatedFiles) throw new Exception('L\'animal existe déjà dans la base de données');
        AnimalsTable::update($animal);

        if($hasUpdatedFiles) $this->updateAnimalImages(self::$formData);
    }

    private function deleteAnimal() : void
    {
        if(!isset(self::$formData['animal_id'])) throw new Exception('form need to have an input sending data about animal_id');
        if(!isset(self::$formData['animal_images_id'])) throw new Exception('form need to have an input sending data about animal_images_id');

        if(empty(self::$formData['animal_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is empty.');
        if(empty(self::$formData['animal_images_id'])) throw new Exception('Cannot add entity Animal to database : field animal_images_id is empty.');

        if(!is_numeric(self::$formData['animal_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is not numeric.');
        if(!is_array(self::$formData['animal_images_id'])) throw new Exception('Cannot add entity Animal to database : field animal_images_id is not anarray.');

        AnimalsTable::delete(self::$formData['animal_id']);
        foreach(self::$formData['animal_images_id'] as $id)
        {
            AnimalImagesTable::delete($id);
        }
    }

    private function updateAnimalImages(array $formData) : void
    {
        $animalImagesCount = count($formData['animal_images_id']);
        $uploadedFilesCount = count($formData['animal_images']['tmp_name']);

        if($animalImagesCount > $uploadedFilesCount) {
            $filesToUpdateCount = $uploadedFilesCount;
            $filesToDeleteCount = $animalImagesCount - $uploadedFilesCount;
            $filesToCreateCount = 0;
        }

        if($animalImagesCount === $uploadedFilesCount) {
            $filesToUpdateCount = $uploadedFilesCount;
            $filesToDeleteCount = 0;
            $filesToCreateCount = 0;
        }

        if($animalImagesCount < $uploadedFilesCount) {
            $filesToUpdateCount = $animalImagesCount;
            $filesToDeleteCount = 0;
            $filesToCreateCount = $uploadedFilesCount - $animalImagesCount;
        }

        // UPDATE ANIMAL IMAGES
        for($i = 0; $i < $filesToUpdateCount; $i++)
        {
            $data['animal_image']['tmp_name'] = $formData['animal_images']['tmp_name'][$i];
            $data['animal_image']['name'] = $formData['animal_images']['name'][$i];
            $data['animal_image']['error'] = $formData['animal_images']['error'][$i];
            $data['animal_id'] = $formData['animal_id'];
            $data['animal_image_id'] = $formData['animal_images_id'][$i];
            $this->animalImageCrudController->updateAnimalImage($data);
        }

        // DELETE ANIMAL IMAGES
        if($filesToDeleteCount > 0) {
            $exceedingImagesIds = array_slice($formData['animal_images_id'], $filesToUpdateCount);
            foreach($exceedingImagesIds as $imageId) 
            {
                AnimalImagesTable::delete($imageId);
            }
        }

        // CREATE ANIMAL IMAGES
        for($i = $filesToUpdateCount; $i < $filesToUpdateCount +$filesToCreateCount; $i++)
        {
            $data['animal_image']['tmp_name'] = $formData['animal_images']['tmp_name'][$i];
            $data['animal_image']['name'] = $formData['animal_images']['name'][$i];
            $data['animal_image']['error'] = $formData['animal_images']['error'][$i];
            $data['animal_id'] = $formData['animal_id'];
            $this->animalImageCrudController->createAnimalImage($data);
        }
    }
}