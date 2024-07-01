<?php

namespace App\Utilities;

use Exception;
use finfo;

class ImgUploader 
{
    private array $file;
    private array $allowedExtensions = ['jpg', 'webp', 'png'];
    private array $allowedMimeTypes = ['image/jpeg', 'image/webp', 'image/png'];
    private int $maxFilesizeInMo = 5;
    private string $uploadedFilePath;

    public function upload(array $file) : void
    {
        /* Voir https://cheatsheetseries.owasp.org/cheatsheets/File_Upload_Cheat_Sheet.html
         * et https://dev.to/einlinuus/how-to-upload-files-with-php-correctly-and-securely-1kng
         */
        $this->file['size'] = filesize($file['tmp_name']);
        $this->file['mime_type'] = finfo_file(new finfo(FILEINFO_MIME_TYPE), $file['tmp_name']);
        $this->file['extension'] = pathinfo($file['name'], PATHINFO_EXTENSION);

        if(!in_array($this->file['extension'], $this->allowedExtensions)) throw new Exception('Invalid file extension. Allowed values are : ' . implode(', ',$this->allowedExtensions) . '. Received : ' . $this->file['extension']);
        if(!in_array($this->file['mime_type'], $this->allowedMimeTypes)) throw new Exception('Invalid MIME type. Allowed values are : ' . implode(', ',$this->allowedMimeTypes) . '. Received : ' . $this->file['mime_type']);
        if($this->file['size'] <= 0) throw new Exception('Filesize must be greater than 0.');
        if(strlen($file['tmp_name']) > 35) throw new Exception('Filename must not exceed 35 characters. Received : ' . strlen($file['tmp_name']));
        if($this->file['size'] > $this->maxFilesizeInMo * 1048576) throw new Exception('Filesize exceeds maximum value of ' . $this->maxFilesizeInMo . 'Mo (' . $this->maxFilesizeInMo * 1048576 . 'octets). Received : ' . $this->file['size'] . 'octets');
        
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