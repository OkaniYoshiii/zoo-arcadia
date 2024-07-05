<?php

use App\Entity\Service;
use App\Utilities\ImgUploader;

class ServicesCrudController 
{
    private ImgUploader $imgUploader;

    public function getVariables() : array
    {
        $services = ServicesDB->findAll();

        $services = array_map(function($service) {return new Service($service); }, $services);
        return [
            'services' => $services,
        ];
    }

    public function processFormData() : void
    {
        $this->imgUploader = new ImgUploader();

        if(!isset($_POST['crudAction'])) throw new Exception('CrudAction need to be defined in the form. Possible values are : CREATE, UPDATE, DELETE');
        match($_POST['crudAction']) {
            'CREATE' => $this->createService(),
            'UPDATE' => $this->updateService(),
            'DELETE' => $this->deleteService(),
        };
    }
    
    private function createService() : void
    {
        if(is_numeric($_POST['serviceName'])) throw new Exception('Service name must not be an integer or a numeric string. Received : ' . $_POST['service_name']);
        if(is_numeric($_POST['serviceDescription'])) throw new Exception('Service description must not be an integer or a numeric string. Received : ' .  $_POST['service_description']);
        if(!isset($_FILES['serviceImg'])) throw new Exception('serviceImg must be sent by the form to process it correctly');
        if($this->isServiceAlreadyRegistered()) throw new Exception('Service is already registered.');
        $this->imgUploader->upload($_FILES['serviceImg']);
        $filename = $this->imgUploader->getUploadedFileName();

        ServicesDB->insert(['name' => $_POST['serviceName'], 'description' => $_POST['serviceDescription'], 'img' => $filename]);        
    }

    private function isServiceAlreadyRegistered() : bool 
    {
        return !empty(ServicesDB->findBy(['name', '=', $_POST['serviceName']]));
    }

    private function updateService() : void
    {
        if(is_numeric($_POST['serviceName'])) throw new Exception('Service name must not be an integer or a numeric string. Received : ' . $_POST['service_name']);
        if(is_numeric($_POST['serviceDescription'])) throw new Exception('Service description must not be an integer or a numeric string. Received : ' .  $_POST['service_description']);
        if(!isset($_POST['serviceId'])) throw new Exception('serviceId must be send by the form to process it correctly.');
        if(intval($_POST['serviceId']) === 0) throw new Exception('Service ID must be an integer or a numeric string. Received : ' . $_POST['service_id']);
        if(isset($_FILES['serviceImg'])) {

        }

        ServicesDB->updateOrInsert(['_id', (int) $_POST['serviceId'], 'name' =>  $_POST['serviceName'], 'description' => $_POST['serviceDescription']]);        
    }

    private function deleteService() : void
    {
        if(!isset($_POST['serviceId'])) throw new Exception('serviceId must be send by the form to process it correctly.');
        if(intval($_POST['serviceId']) === 0) throw new Exception('Service ID must be an integer or a numeric string. Received : ' . $_POST['service_id']);

        ServicesDB->deleteById((int) $_POST['serviceId']);        
    }
}