<?php

use App\Entity\AnimalImage;
use App\Models\Table\AnimalImagesTable;
use App\Utilities\ImgUploader;

class AnimalImagesCrudController 
{
    private ImgUploader $imgUploader;

    public function __construct()
    {
        $this->imgUploader = new ImgUploader();
    }

    public function createAnimalImage(array $formData) : void
    {
        if(!isset($formData['animal_image'])) throw new Exception('form need to have an input sending data about animal_image');
        if(!isset($formData['animal_id'])) throw new Exception('form need to have an input sending data about animal_id');
        if(!isset($formData['animal_image']['tmp_name']) || !file_exists($formData['animal_image']['tmp_name']) && is_uploaded_file($formData['animal_image']['tmp_name'])) throw new Exception('form need to send image files to update AnimalImage');

        if(empty($formData['animal_image'])) throw new Exception('Cannot add entity Animal to database : field animal_image is empty.');
        if(empty($formData['animal_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is empty.');
        if($formData['animal_image']['error'] === 4) throw new Exception('No files has been sent in the form');
        if($formData['animal_image']['error'] !== 0) throw new Exception('An error occured when uploading the files. Error code : ' . $formData['animal_image']['error']);

        if(!is_numeric($formData['animal_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is not numeric.');

        $this->imgUploader->upload($formData['animal_image']);

        $animalImageData['animal_id'] = $formData['animal_id'];
        $animalImageData['name'] = $this->imgUploader->getUploadedFileName();
        $animalImage = new AnimalImage($animalImageData);
        AnimalImagesTable::create($animalImage);
    }

    public function updateAnimalImage(array $formData) : void
    {
        if(!isset($formData['animal_image'])) throw new Exception('form need to have an input sending data about animal_image');
        if(!isset($formData['animal_image_id'])) throw new Exception('form need to have an input sending data about animal_image_id');
        if(!isset($formData['animal_id'])) throw new Exception('form need to have an input sending data about animal_id');
        if(!isset($formData['animal_image']['tmp_name']) || !file_exists($formData['animal_image']['tmp_name'])) throw new Exception('form need to send image files to update AnimalImage');

        if(empty($formData['animal_image'])) throw new Exception('Cannot add entity Animal to database : field animal_image is empty.');
        if(empty($formData['animal_image_id'])) throw new Exception('Cannot add entity Animal to database : field animal_image_id is empty.');
        if(empty($formData['animal_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is empty.');

        if(!is_numeric($formData['animal_image_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is not numeric.');
        if(!is_numeric($formData['animal_id'])) throw new Exception('Cannot add entity Animal to database : field animal_id is not numeric.');

        $imgTmpName = $formData['animal_image']['tmp_name'];
        $imgName = $formData['animal_image']['name'];

        $this->imgUploader->upload(['name' => $imgName, 'tmp_name' => $imgTmpName]);
        $fileName = $this->imgUploader->getUploadedFileName();

        $animalImageData['name'] = $fileName;
        $animalImageData['animal_id'] = $formData['animal_id'];
        $animalImageData['animal_image_id'] = $formData['animal_image_id'];

        $animalImage = new AnimalImage($animalImageData);
        AnimalImagesTable::update($animalImage);
    }

    public function deleteAnimalImage(int $animalImageId) : void
    {
        AnimalImagesTable::delete($animalImageId);
    }
}