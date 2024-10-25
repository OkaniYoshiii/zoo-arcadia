<?php

namespace App\Utilities;

use App\Exception\FormInputException;
use UserAlertsContainer;

class FormValidator 
{
    public function checkDuplicatedFormSubmission()
    {
        $timestamp = strtotime($_POST['sent_at']);
        if($timestamp === false) throw new FormInputException('sent_at', FormInputException::NOT_DATE);

        $hasFormAlreadyBeenSubmited = (!empty(FormSubmissionCollection->findOne(['timestamp' => $timestamp])));

        if($hasFormAlreadyBeenSubmited) UserAlertsContainer::add('Le formulaire a déjà été envoyé avec les même données auparvant.');
        
        if(UserAlertsContainer::hasAlerts()) return;
        
        FormSubmissionCollection->insertOne(['timestamp' => $timestamp]);

        /* Supprime les timestamps si ils datent de plus de X minutes */
        $deleteTimestampThreshold = $timestamp - 60 * 30;
        FormSubmissionCollection->deleteMany(['timestamp' => ['$lt' => $deleteTimestampThreshold]]);
    }

    public function checkCsrfToken() 
    {
        if(!isset($_POST['csrf_token'])) throw new FormInputException('csrf_token', FormInputException::UNDEFINED_VALUE);

        if($_SESSION['csrf_token'] !== $_POST['csrf_token']) throw new FormInputException('csrf_token', FormInputException::WRONG_CSRF_TOKEN);
    }

    public function checkRequestOrigin()
    {
        header("Access-Control-Allow-Origin: " . $_ENV['SITE_URL']);
    }
}