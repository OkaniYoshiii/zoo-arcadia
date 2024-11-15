<?php

namespace App\Controllers\Admin;

use App\Entities\HabitatImage;
use App\Exceptions\FormInputException;
use App\Tables\HabitatImagesTable;
use App\Tables\HabitatsTable;
use App\Utilities\ImgUploader;
use Exception;

class HabitatImagesCrudController 
{
    private ImgUploader $imgUploader;

    public function __construct()
    {
        $this->imgUploader = new ImgUploader();
    }

    public function createHabitatImage(array $formData) : int
    {
        if(!isset($formData['habitat_id'])) throw new FormInputException('habitat_id', 'value is undefined');
        if(!isset($formData['habitat_image'])) throw new FormInputException('habitat_image', 'value is undefined');
        
        if(empty($formData['habitat_id'])) throw new FormInputException('habitat_id', 'value is empty');
        if(empty($formData['habitat_image'])) throw new FormInputException('habitat_image', 'value is empty');
        
        if(!is_numeric($formData['habitat_id'])) throw new FormInputException('habitat_id', 'value is not an integer');
        if(!isset($formData['habitat_image']['tmp_name']) || !file_exists($formData['habitat_image']['tmp_name']) || !is_uploaded_file($formData['habitat_image']['tmp_name'])) throw new FormInputException('habitat_image', 'value is not a file');       

        $this->imgUploader->upload(($formData['habitat_image']));
        $formData['name'] = $this->imgUploader->getUploadedFileName();

        $habitatImage = new HabitatImage($formData);
        $habitatImageId = HabitatImagesTable::create($habitatImage);
        return $habitatImageId;
    }

    public function updateHabitatImage(array $formData) : void
    {
        if(!isset($formData['habitat_image_id'])) throw new FormInputException('habitat_image_id', 'value is undefined');
        if(!isset($formData['habitat_image'])) throw new FormInputException('habitat_image', 'value is undefined');
        if(!isset($formData['habitat_id'])) throw new FormInputException('habitat_id', 'value is undefined');

        if(empty($formData['habitat_image_id'])) throw new Exception('habitat_image_id', 'value is empty');
        if(empty($formData['habitat_image'])) throw new Exception('habitat_image', 'value is empty');
        if(empty($formData['habitat_id'])) throw new Exception('habitat_id', 'value is empty');
        
        if(!is_numeric($formData['habitat_image_id'])) throw new FormInputException('habitat_image_id', 'value is not numeric');
        if(!isset($formData['habitat_image']['tmp_name']) || !file_exists($formData['habitat_image']['tmp_name']) || !is_uploaded_file($formData['habitat_image']['tmp_name'])) throw new FormInputException('habitat_image', 'value is not a file');       
        if(!is_numeric($formData['habitat_id'])) throw new FormInputException('habitat_id', 'value is not numeric');

        $this->imgUploader->upload(($formData['habitat_image']));
        $formData['name'] = $this->imgUploader->getUploadedFileName();

        $habitatImage = new HabitatImage($formData);
        HabitatImagesTable::update($habitatImage);
    }

    public function deleteHabitatImage(int $id) : void
    {
        if(!isset($formData['habitat_id'])) throw new FormInputException('habitat_id', 'value is undefined');

        HabitatsTable::delete($id);
    }
}