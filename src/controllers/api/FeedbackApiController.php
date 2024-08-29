<?php

class FeedbackApiController
{
    private static int $maxPerPage = 3;

    public function getJsonData()
    {
        if(!isset($_GET['page'])) return;

        $feedbacksCount = FeedbacksCollection->countDocuments();

        $offset = ($_GET['page'] - 1) *  self::$maxPerPage;

        $options = [
            'sort' => ['date' => -1],
            'skip' => $offset,
            'limit' => self::$maxPerPage,
        ];
        $feedbacks['content'] = FeedbacksCollection->find([], $options)->toArray();
        $feedbacks['maxPerPage'] = self::$maxPerPage;
        $feedbacks['isLastPage'] = ($feedbacksCount > $offset + count($feedbacks['content'])) ? false : true;

        echo json_encode($feedbacks);
    }
}