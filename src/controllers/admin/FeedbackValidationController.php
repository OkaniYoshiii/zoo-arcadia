<?php

use App\Entity\Feedback;
use App\Exception\FormInputException;
use App\Objects\Request;

class FeedBackValidationController
{
    private static array $formData;

    public function getVariables() : array
    {
        $feedbacks = FeedbacksDB->findAll();

        $feedbacks = array_map(function($feedback) {return new Feedback($feedback); }, $feedbacks);
        return [
            'feedbacks' => $feedbacks,
        ];
    }

    public function processFormData() : void
    {
        self::$formData = [
            'feedbackId' => $_POST['feedbackId'] ?? null,
            'isValidated' => $_POST['isValidated'] ?? null,
        ];

        if(empty(self::$formData['feedbackId'])) throw new FormInputException('feedbackId', 'value is undefined');
        if(!is_numeric(self::$formData['feedbackId'])) throw new FormInputException('feedbackId', 'value is not numeric');

        if(empty(self::$formData['isValidated'])) throw new FormInputException('isValidated', 'value is empty');
        if(self::$formData['isValidated'] !== 'true' && self::$formData['isValidated'] !== 'false') throw new FormInputException('isValidated', 'value is not a boolean');

        FeedbacksDB->updateById(self::$formData['feedbackId'], ['is_validated' => self::$formData['isValidated']]);
    }
}