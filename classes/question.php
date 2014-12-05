<?php

class Question {

    private $questionId = 0;
    private $pollId;
    private $title;
    private $description;
    private $numMaxPossibleChoices;
    private $numMinPossibleChoices;
    private $answers = array();

    function __construct() {
        
    }

    public static function QuestionInit($questionId, $pollId, $title, $description, $numMinPossibleChoices, $numMaxPossibleChoices) {
        $question = new Question();
        $question->questionId = $questionId;
        $question->pollId = $pollId;
        $question->title = $title;
        $question->description = $description;
        $question->numMaxPossibleChoices = $numMaxPossibleChoices;
        $question->numMinPossibleChoices = $numMinPossibleChoices;
        return $question;
    }

    public function getAnswers() {
        return $this->answers;
    }

    public function addAnswer($answer) {
        $this->answers[] = $answer;
    }

    public function getQuestionId() {
        return $this->questionId;
    }

    public function getPollId() {
        return $this->pollId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getNumMaxPossibleChoices() {
        return $this->numMaxPossibleChoices;
    }

    public function getNumMinPossibleChoices() {
        return $this->numMinPossibleChoices;
    }

    public function setQuestionId($questionId) {
        $this->questionId = $questionId;
    }

    public function setPollId($pollId) {
        $this->pollId = $pollId;
    }

    public function setTitle($title) {
        if (strlen($title) < 10 || strlen($title) > 150) {
            throw new Exception('INVALID_QUESTION_TITLE_SIZE');
        } else if (!preg_match('/^[A-Za-z\s,]*$/', $title)) {
            throw new Exception('INVALID_QUESTION_TITLE_CHARSET');
        }
        $this->title = $title;
    }

    public function setDescription($description) {
        if (strlen($description) < 10 || strlen($description) > 150) {
            throw new Exception('INVALID_QUESTION_DESCRIPTION_SIZE');
        } else if (!preg_match('/^[A-Za-z\s,.]*$/', $description)) {
            throw new Exception('INVALID_QUESTION_DESCRIPTION_CHARSET');
        }
        $this->description = $description;
    }

    public function setNumMaxPossibleChoices($numMaxPossibleChoices) {
        $this->numMaxPossibleChoices = $numMaxPossibleChoices;
    }

    public function setNumMinPossibleChoices($numMinPossibleChoices) {
        $this->numMinPossibleChoices = $numMinPossibleChoices;
    }

    public function data() {
        return array('question_id' => $this->questionId, 'title' => $this->title, 'description' => $this->description);
    }

    public function results() {
        $results = array('question_id' => $this->questionId, 'title' => $this->title, 'answers' => array());
        foreach ($this->answers as $answer) {
            $results['answers'][] = $answer->results();
        }
        return $results;
    }

    public function dataAndAnswers() {
        $ret = $this->data();
        foreach ($this->answers as $answer) {
            $ret['answers'][] = $answer->data();
        }
        return $ret;
    }

    public function getAnswer($answerid) {
        foreach ($this->answers as $answer) {
            if ($answer->getAnswerId() === $answerid) {
                return $answer;
            }
        }
        throw new Exception('ANSWER_NOT_FOUND');
    }

}
