<?php

namespace App\Controllers\Api;

class FeedbackApiController
{
    private static int $maxPerPage = 3;

    public function getJsonData()
    {
        if(!isset($_GET['page'])) return;

        $offset = ($_GET['page'] - 1) *  self::$maxPerPage;

        $options = [
            'sort' => ['date' => -1],
            'skip' => $offset,
            'limit' => self::$maxPerPage,
        ];

        $feedbacksCount = 0;
        $feedbacks['content'] = [];
        if(MONGODB_FLAG_ENABLED) {
            $feedbacksCount = FeedbacksCollection->countDocuments();
            $feedbacks['content'] = FeedbacksCollection->find([], $options)->toArray();
        }

        $feedbacks['maxPerPage'] = self::$maxPerPage;
        $feedbacks['isLastPage'] = ($feedbacksCount > $offset + count($feedbacks['content'])) ? false : true;

        echo json_encode($feedbacks);
    }
}