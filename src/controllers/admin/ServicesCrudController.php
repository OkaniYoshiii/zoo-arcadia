<?php

use App\Entity\Service;
use App\Exception\FormInputException;
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

        if(!isset($_POST['crudAction'])) throw new FormInputException('crudAction', FormInputException::INVALID_CRUD_ACTION);
        match($_POST['crudAction']) {
            'CREATE' => $this->createService(),
            'UPDATE' => $this->updateService(),
            'DELETE' => $this->deleteService(),
        };
    }
    
    private function createService() : void
    {
        if(!is_string($_POST['serviceName'])) throw new FormInputException('serviceName', FormInputException::NOT_STRING);
        if(!is_string($_POST['serviceDescription'])) throw new FormInputException('service_description', FormInputException::NOT_STRING);
        if(!isset($_FILES['serviceImg'])) throw new FormInputException('serviceImg', FormInputException::UNDEFINED_VALUE);

        if($this->isServiceAlreadyRegistered()) UserAlertsContainer::add('Le service que vous venez de renseigner existe déjà.');

        if(UserAlertsContainer::hasAlerts()) return;
        
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
        if(!isset($_POST['serviceId'])) throw new FormInputException('serviceId', FormInputException::UNDEFINED_VALUE);

        if(!is_string($_POST['serviceName'])) throw new FormInputException('service_name', FormInputException::NOT_STRING);
        if(!is_string($_POST['serviceDescription'])) throw new FormInputException('service_description', FormInputException::NOT_STRING);
        if(is_numeric($_POST['serviceId']) === 0) throw new FormInputException('service_id', FormInputException::NOT_NUMERIC);
        
        $updateValues = ['name' =>  $_POST['serviceName'], 'description' => $_POST['serviceDescription']];
        
        if(isset($_FILES['serviceImg']) && $_FILES['serviceImg']['error'] === 0) {
            $this->imgUploader->upload($_FILES['serviceImg']);
            $updateValues['img'] = $this->imgUploader->getUploadedFileName();
        }

        ServicesDB->updateById($_POST['serviceId'], $updateValues);        
    }

    private function deleteService() : void
    {
        if(!isset($_POST['serviceId'])) throw new FormInputException('serviceId', FormInputException::UNDEFINED_VALUE);
        
        if(intval($_POST['serviceId']) === 0) throw new FormInputException('serviceId', FormInputException::NOT_NUMERIC);

        ServicesDB->deleteById((int) $_POST['serviceId']);        
    }
}