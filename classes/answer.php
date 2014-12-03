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
