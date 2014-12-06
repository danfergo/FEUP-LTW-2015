<?php

class Answer {

    private $answerId;
    private $questionId;
    private $title;
    private $nrOfVotes = 0;

    function __construct() {
        
    }

    static function AnswerInit($answerId, $questionId, $title) {
        $answer = new Answer();
        $answer->answerId = $answerId;
        $answer->questionId = $questionId;
        $answer->title = $title;
        return $answer;
    }

    public function getAnswerId() {
        return $this->answerId;
    }

    public function getQuestionId() {
        return $this->questionId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setAnswerId($answerId) {
        $this->answerId = $answerId;
    }

    public function setQuestionId($questionId) {
        $this->questionId = $questionId;
    }

    public function setTitle($title) {
        if (strlen($title) < 10 || strlen($title) > 100) {
            throw new Exception('INVALID_ANSWER_SIZE');
        } else if (!preg_match('/^[A-Za-z0-9\s,.]*$/', $title)) {
            throw new Exception('INVALID_ANSWER_CHARSET');
        }
        $this->title = $title;
    }

    function getNrOfVotes() {
        return $this->nrOfVotes;
    }

    function setNrOfVotes($nrOfVotes) {
        $this->nrOfVotes = $nrOfVotes;
    }

    public function data() {
        return array('answer_id' => $this->answerId, 'title' => $this->title);
    }
    
    public function results() {
        return array('answer_id' => $this->answerId, 'title' => $this->title, 'votes' => $this->nrOfVotes);
    }
    
}
