<?php

namespace App\Utilities;

use finfo;
use UserAlertsContainer;

class ImgUploader 
{
    private array $file;
    private array $allowedExtensions = ['jpg', 'webp', 'png', 'jpeg'];
    private array $allowedMimeTypes = ['image/jpeg', 'image/webp', 'image/png'];
    private int $maxFilesizeInMo = 5;

    public function upload(array $file) : void
    {
        /* Voir https://cheatsheetseries.owasp.org/cheatsheets/File_Upload_Cheat_Sheet.html
         * et https://dev.to/einlinuus/how-to-upload-files-with-php-correctly-and-securely-1kng
         */
        $this->file['size'] = filesize($file['tmp_name']);
        $this->file['mime_type'] = finfo_file(new finfo(FILEINFO_MIME_TYPE), $file['tmp_name']);
        $this->file['extension'] = pathinfo($file['name'], PATHINFO_EXTENSION);

        if(!in_array($this->file['extension'], $this->allowedExtensions)) UserAlertsContainer::add('Extension de fichier invalide. Les valeurs autorisées sont : ' . implode(', ',$this->allowedExtensions));
        if(!in_array($this->file['mime_type'], $this->allowedMimeTypes)) UserAlertsContainer::add('MIME type invalide. Les valeurs autorisées sont : ' . implode(', ',$this->allowedMimeTypes));
        if($this->file['size'] <= 0) UserAlertsContainer::add('La taille du fichier doit être supérieure à 0.');
        if(strlen($file['tmp_name']) > 35) UserAlertsContainer::add('Le nom du fichier ne doit pas dépasser les 35 caractères');
        if($this->file['size'] > $this->maxFilesizeInMo * 1048576) UserAlertsContainer::add('La taille du fichier dépasse les 5Mo.');

        if(UserAlertsContainer::hasAlerts()) return;

        $this->file['name'] = uniqid() . '.' . $this->file['extension'];
        $this->file['path'] = UPLOAD_DIR . '/' . $this->file['name'];
        if(file_exists($this->file['path'])) UPLOAD_DIR . '/' . $this->file['name'];
        move_uploaded_file($file['tmp_name'], $this->file['path']);
    }

    public function getUploadedFileName() : string
    {
        return $this->file['name'];
    }

    public function getAllowedMimeTypes() : array
    {
        return $this->allowedMimeTypes;
    }

    public function getAllowedExtensions() : array
    {
        return $this->allowedExtensions;
    }

    public function getMaxFileSizeInMo() : int
    {
        return $this->maxFilesizeInMo;
    }
}