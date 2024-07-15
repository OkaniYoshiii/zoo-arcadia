<?php

use App\Entity\HabitatImage;
use App\Models\Table\HabitatImagesTable;
use App\Models\Table\HabitatsTable;
use App\Utilities\ImgUploader;

class HabitatImagesCrudController 
{
    private ImgUploader $imgUploader;

    public function __construct()
    {
        $this->imgUploader = new ImgUploader();
    }

    public function createHabitatImage(array $formData) : int
    {
        if(!isset($formData['habitat_id'])) throw new Exception('form need to have an input sending data about Habitat habitat_id');
        if(!isset($formData['habitat_image'])) throw new Exception('form need to have an input sending data about Habitat habitat_image');
        
        if(empty($formData['habitat_id'])) throw new Exception('Cannot add entity Habitat to database : field habitat_id is empty.');
        if(empty($formData['habitat_image'])) throw new Exception('Cannot add entity Habitat to database : field habitat_image is empty.');
        
        if(!is_numeric($formData['habitat_id'])) throw new Exception('Cannot add entity Habitat to database : field habitat_id is not numeric.');
        if(!isset($formData['habitat_image']['tmp_name']) || !file_exists($formData['habitat_image']['tmp_name']) || !is_uploaded_file($formData['habitat_image']['tmp_name'])) throw new Exception('form need to send image files to update HabitatImage');       

        $this->imgUploader->upload(($formData['habitat_image']));
        $formData['name'] = $this->imgUploader->getUploadedFileName();

        $habitatImage = new HabitatImage($formData);
        $habitatImageId = HabitatImagesTable::create($habitatImage);
        return $habitatImageId;
    }

    public function updateHabitatImage(array $formData) : void
    {
        if(!isset($formData['habitat_image_id'])) throw new Exception('form need to have an input sending data about Habitat habitat_image_id');
        if(!isset($formData['habitat_image'])) throw new Exception('form need to have an input sending data about Habitat habitat_image');
        if(!isset($formData['habitat_id'])) throw new Exception('form need to have an input sending data about Habitat habitat_id');

        if(empty($formData['habitat_image_id'])) throw new Exception('Cannot add entity Habitat to database : field habitat_image_id is empty.');
        if(empty($formData['habitat_image'])) throw new Exception('Cannot add entity Habitat to database : field habitat_image is empty.');
        if(empty($formData['habitat_id'])) throw new Exception('Cannot add entity Habitat to database : field habitat_id is empty.');
        
        if(!is_numeric($formData['habitat_image_id'])) throw new Exception('Cannot add entity Habitat to database : field habitat_image_id is not numeric.');
        if(!isset($formData['habitat_image']['tmp_name']) || !file_exists($formData['habitat_image']['tmp_name']) || !is_uploaded_file($formData['habitat_image']['tmp_name'])) throw new Exception('form need to send image files to update HabitatImage');       
        if(!is_numeric($formData['habitat_id'])) throw new Exception('Cannot add entity Habitat to database : field habitat_id is not numeric.');

        $this->imgUploader->upload(($formData['habitat_image']));
        $formData['name'] = $this->imgUploader->getUploadedFileName();

        $habitatImage = new HabitatImage($formData);
        HabitatImagesTable::update($habitatImage);
    }

    public function deleteHabitatImage(int $id) : void
    {
        if(!isset($formData['habitat_id'])) throw new Exception('form need to have an input sending data about Habitat habitat_id');

        HabitatsTable::delete($id);
    }
}