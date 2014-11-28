<?php

class Answer {
    private $answerId;
    private $questionId;
    private $title;
    
    function __construct() {
        
    }
    
    static function AnswerInit($answerId,$questionId,$title){
        $this->answerId = $answerId;
        $this->questionId = $questionId;
        $this->title = $title;
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


}