<?php

use App\Entity\AnimalImage;
use App\Exception\FormInputException;
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
        if(!isset($formData['animal_image'])) throw new FormInputException('animal_image', 'value is undefined');
        if(!isset($formData['animal_id'])) throw new FormInputException('animal_id', 'value is undefined');
        if(!isset($formData['animal_image']['tmp_name']) || !file_exists($formData['animal_image']['tmp_name']) && is_uploaded_file($formData['animal_image']['tmp_name'])) throw new FormInputException('animal_image', 'value is undefined');
        if(empty($formData['animal_image'])) throw new FormInputException('animal_image', 'value is empty');
        if(!is_numeric($formData['animal_id'])) throw new FormInputException('animal_id', 'value is not numeric');
        if(empty($formData['animal_id'])) throw new FormInputException('animal_id', 'value is empty');

        if($formData['animal_image']['error'] === 4) throw new Exception('No image has been uploaded');
        if($formData['animal_image']['error'] !== 0) throw new Exception('File has an error');

        $this->imgUploader->upload($formData['animal_image']);

        $animalImageData['animal_id'] = $formData['animal_id'];
        $animalImageData['name'] = $this->imgUploader->getUploadedFileName();
        $animalImage = new AnimalImage($animalImageData);
        AnimalImagesTable::create($animalImage);
    }

    public function updateAnimalImage(array $formData) : void
    {
        if(!isset($formData['animal_image'])) throw new FormInputException('animal_image', 'value is undefined');
        if(!isset($formData['animal_image_id'])) throw new FormInputException('animal_image_id', 'value is undefined');
        if(!isset($formData['animal_id'])) throw new FormInputException('animal_id', 'value is undefined');
        if(!isset($formData['animal_image']['tmp_name']) || !file_exists($formData['animal_image']['tmp_name'])) throw new FormInputException('animal_image', 'value is undefined');
        if(empty($formData['animal_image_id'])) throw new FormInputException('animal_image_id', 'value is empty');
        if(empty($formData['animal_id'])) throw new FormInputException('animal_id', 'value is empty');
        if(!is_numeric($formData['animal_image_id'])) throw new FormInputException('animal_image_id', 'value is not numeric');
        if(!is_numeric($formData['animal_id'])) throw new FormInputException('animal_id', 'value is not numeric');
        if(empty($formData['animal_image'])) throw new FormInputException('animal_image', 'value is empty');

        if($formData['animal_image']['error'] === 4) throw new Exception('No image has been uploaded');
        if($formData['animal_image']['error'] !== 0) throw new Exception('File has an error');

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