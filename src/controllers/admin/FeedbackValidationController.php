<?php

use App\Entity\Feedback;
use App\Objects\Request;

class FeedBackValidationController
{
    private static int $maxPerPage = 1;
    private static array $formData;
    private static array $requestParams;

    public function getVariables() : array
    {
        $feedbacks = FeedbacksDB->findAll();

        $feedbacks = array_map(function($feedback) {return new Feedback($feedback); }, $feedbacks);
        $feedbacks['maxPerPage'] = self::$maxPerPage; 
        return [
            'feedbacks' => $feedbacks,
        ];
    }

    public function getJson() 
    {
        self::$requestParams = [
            'page' => $_GET['page'],
        ];

        $feedbacks = FeedbacksDB->findAll(['date' => 'desc'], 15, self::$maxPerPage * (self::$requestParams['page'] - 1));
        if(count($feedbacks) === 0) return;
        echo json_encode($feedbacks);
    }

    public function processFormData() : void
    {
        self::$formData = [
            'feedbackId' => $_POST['feedbackId'] ?? null,
            'isValidated' => $_POST['isValidated'] ?? null,
        ];

        if(empty(self::$formData['feedbackId'])) throw new Exception('Submitted value feedbackId is empty. Expected integer.');
        if(!is_numeric(self::$formData['feedbackId'])) throw new Exception('Submitted value feedbackId is not an integer.');

        if(empty(self::$formData['isValidated'])) throw new Exception('Submitted value isValidated is empty. Expected boolean.');
        if(self::$formData['isValidated'] !== 'true' && self::$formData['isValidated'] !== 'false') throw new Exception('Submitted value isValidated is not a boolean.');

        FeedbacksDB->updateById(self::$formData['feedbackId'], ['is_validated' => self::$formData['isValidated']]);
    }
}