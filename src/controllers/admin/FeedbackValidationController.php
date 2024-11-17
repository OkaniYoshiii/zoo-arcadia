<?php

namespace App\Controllers\Admin;

use App\Entities\Feedback;
use App\Exceptions\FormInputException;
use App\Objects\Request;
use MongoDB\Model\BSONDocument;

class FeedBackValidationController
{
    private static array $formData;

    public function getVariables() : array
    {
        $feedbacks = [];
        if(MONGODB_FLAG_ENABLED) {
            $feedbacks = FeedbacksCollection->find();
            $feedbacks = array_map(fn(BSONDocument $feedback) => new Feedback($feedback->getArrayCopy()), $feedbacks->toArray());
        }       

        return [
            'feedbacks' => $feedbacks,
        ];
    }

    public function processFormData() : void
    {
        if(MONGODB_FLAG_ENABLED) return;
        
        self::$formData = [
            'feedbackId' => $_POST['feedbackId'] ?? null,
            'isValidated' => $_POST['isValidated'] ?? null,
        ];

        if(empty(self::$formData['feedbackId'])) throw new FormInputException('feedbackId', 'value is undefined');

        if(empty(self::$formData['isValidated'])) throw new FormInputException('isValidated', 'value is empty');
        if(self::$formData['isValidated'] !== 'true' && self::$formData['isValidated'] !== 'false') throw new FormInputException('isValidated', 'value is not a boolean string');

        self::$formData['isValidated'] = (self::$formData['isValidated'] === 'true') ? true : false;

        FeedbacksCollection->updateOne(['_id' => new MongoDB\BSON\ObjectID(self::$formData['feedbackId'])], ['$set' => ['is_validated' => self::$formData['isValidated']]]);
    }
}