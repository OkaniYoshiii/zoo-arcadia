<?php

namespace App\Utilities;

use Exception;

class FormValidator 
{
    public function checkDuplicatedFormSubmission() {
        $timestamp = strtotime($_POST['sent_at']);
        if($timestamp === false) throw new Exception('sent_at field is not a date.');

        $hasFormAlreadyBeenSubmited = (!empty(FormSubmissionsStore->findBy(['timestamp', '=' , $timestamp])));
        
        if($hasFormAlreadyBeenSubmited) throw new Exception('Form has already been submitted with the same data');
        
        FormSubmissionsStore->insert(['timestamp' => $timestamp]);

        /* Supprime les timestamps si ils datent de plus de X minutes */
        $deleteTimestampThreshold = $timestamp - 60 * 30;
        FormSubmissionsStore->deleteBy(['timestamp', '<', $deleteTimestampThreshold]);
    }
}