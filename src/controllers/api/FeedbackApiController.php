<?php

class FeedbackApiController
{
    private static int $maxPerPage = 1;

    public function getJsonData()
    {
        if(!isset($_GET['page'])) return;

        $feedbacksCount = FeedbacksDB->count();
        $offset = ($_GET['page'] - 1) *  self::$maxPerPage;
        $feedbacks['content'] = FeedbacksDB->findAll(['date' => 'desc'],  self::$maxPerPage, $offset);
        $feedbacks['maxPerPage'] = self::$maxPerPage;
        $feedbacks['isLastPage'] = ($feedbacksCount > $offset + count($feedbacks['content'])) ? false : true;
        echo json_encode($feedbacks);
    }
}