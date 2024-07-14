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
        if(is_null(self::$formData['animal_images'])) throw new Exception('form need to have an input sending data about animal_images');
        if(is_null(self::$formData['breed_id'])) throw new Exception('form need to have an input sending data about breed_id');
        if(is_null(self::$formData['habitat_id'])) throw new Exception('form need to have an input sending data about habitat_id');

        if(empty(self::$formData['firstname'])) throw new Exception('Cannot add entity Animal to database : field firstname is empty.');
        if(empty(self::$formData['animal_images'])) throw new Exception('Cannot add entity Animal to database : field animal_images is empty.');
        if(empty(self::$formData['breed_id'])) throw new Exception('Cannot add entity Animal to database : field breed_id is empty.');
        if(empty(self::$formData['habitat_id'])) throw new Exception('Cannot add entity Animal to database : field habitat_id is empty.');

        if(!is_string(self::$formData['firstname'])) throw new Exception('Cannot add entity Animal to database : field firstname is not a string.');
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
        if(is_null(self::$formData['animal_id'])) throw new Exception('form need to have an input sending data about animal_id');
        if(is_null(self::$formData['firstname'])) throw new Exception('form need to have an input sending data about firstname');
        if(is_null(self::$formData['animal_images'])) throw new Exception('form need to have an input sending data about animal_images');
        if(is_null(self::$formData['animal_images_id'])) throw new Exception('form need to have an input sending data about animal_images_id');
        if(is_null(self::$formData['breed_id'])) throw new Exception('form need to have an input sending data about breed_id');
        if(is_null(self::$formData['habitat_id'])) throw new Exception('form need to have an input sending data about habitat_id');

        if(empty(self::$formData['animal_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is empty.');
        if(empty(self::$formData['firstname'])) throw new Exception('Cannot add entity Animal to database : field firstname is empty.');
        if(empty(self::$formData['animal_images'])) throw new Exception('Cannot add entity Animal to database : field animal_images is empty.');
        if(empty(self::$formData['animal_images_id'])) throw new Exception('Cannot add entity Animal to database : field animal_images_id is empty.');
        if(empty(self::$formData['breed_id'])) throw new Exception('Cannot add entity Animal to database : field breed_id is empty.');
        if(empty(self::$formData['habitat_id'])) throw new Exception('Cannot add entity Animal to database : field habitat_id is empty.');

        if(!is_numeric(self::$formData['animal_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is not numeric.');
        if(!is_array(self::$formData['animal_images_id'])) throw new Exception('Cannot add entity Animal to database : field animal_images_id is not an array.');
        if(!is_string(self::$formData['firstname'])) throw new Exception('Cannot add entity Animal to database : field firstname is not a string.');
        if(!is_numeric(self::$formData['breed_id'])) throw new Exception('Cannot add entity Animal to database : field breed_id is not numeric.');
        if(!is_numeric(self::$formData['habitat_id'])) throw new Exception('Cannot add entity Animal to database : field habitat_id is not numeric.');

        $formDataCopy = self::$formData;
        unset($formDataCopy['animal_images']);

        $animal = new Animal($formDataCopy);

        $hasUpdatedFiles = !(in_array(4, self::$formData['animal_images']['error']));

        if(AnimalsTable::isAlreadyRegistered($animal) && !$hasUpdatedFiles) throw new Exception('L\'animal existe déjà dans la base de données');
        $animal_id = AnimalsTable::update($animal);

        foreach(self::$formData['animal_images']['tmp_name'] as $imgIndex => $imgTmpName)
        {
            $errorCode = self::$formData['animal_images']['error'][$imgIndex];

            // No file uploaded
            if($errorCode === 4) return;
            // Other errors
            if($errorCode !== 0) throw new Exception('An error occured when uploading the files. Error code : ' . $errorCode);

            $imgName = self::$formData['animal_images']['name'][$imgIndex];
            $animalImageData = ['animal_id' => $animal_id];
            $animalImageData['animal_image_id'] = self::$formData['animal_images_id'][$imgIndex];

            $imgUploader = new ImgUploader();
            $imgUploader->upload(['name' => $imgName, 'tmp_name' => $imgTmpName]);
            $animalImageData['name'] = $imgUploader->getUploadedFileName();
            $animalImage = new AnimalImage($animalImageData);

            if(AnimalImagesTable::isAlreadyRegistered($animalImage)) throw new Exception('L\'image d\'animal existe déjà dans la base de données');

            AnimalImagesTable::update($animalImage);
        }
    }

    private function deleteAnimal() : void
    {

    }
}