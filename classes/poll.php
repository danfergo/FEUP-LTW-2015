<?php

class Poll {

    private $pollId = 0;
    private $ownerId;
    private $description;
    private $privacy;
    private $createdTime;
    private $updatedTime;
    private $questions = array();
    private $title;
    private $state = 0;

    function __construct() {
        
    }

    static function PollInit($pollId, $ownerId, $title, $description, $privacy, $createdTime, $updatedTime, $state) {
        $poll = new Poll();
        $poll->pollId = $pollId;
        $poll->ownerId = $ownerId;
        $poll->title = $title;
        $poll->description = $description;
        $poll->privacy = $privacy;
        $poll->createdTime = $createdTime;
        $poll->updatedTime = $updatedTime;
        $poll->state = $state;
        return $poll;
    }

    public function getQuestions() {
        return $this->questions;
    }

    public function addQuestion($question) {
        $this->questions[] = $question;
    }

    public function getState() {
        return $this->state;
    }

    public function removeQuestion($q) {
        $i = 0;
        foreach ($this->questions as $question) {
            if ($question->getQuestionId() == $q->getQuestionId()) {
                array_splice($this->questions, $i, 1);
            }
            $i++;
        }
    }

    public function getPollId() {
        return $this->pollId;
    }

    public function setPollId($pollId) {
        $this->pollId = $pollId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        if (strlen($title) < 10 || strlen($title) > 150) {
            throw new Exception('INVALID_POLL_TITLE_SIZE');
        } else if (!preg_match('/^[A-Za-z\s,0-9]*$/', $title)) {
            throw new Exception('INVALID_POLL_TITLE_CHARSET');
        }
        $this->title = $title;
    }

    public function getOwnerId() {
        return $this->ownerId;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getThumbnailURL() {
        return $this->thumbnailURL;
    }

    public function getPrivacy() {
        return $this->privacy;
    }

    public function getCreatedTime() {
        return $this->createdTime;
    }

    public function getUpdatedTime() {
        return $this->updatedTime;
    }

    public function setOwnerId($ownerId) {
        $this->ownerId = $ownerId;
    }

    public function setDescription($description) {
        if (strlen($description) < 10 || strlen($description) > 300) {
            throw new Exception('INVALID_POLL_DESCRIPTION_SIZE');
        } else if (!preg_match('/^[A-Za-z\s,.0-9]*$/', $description)) {
            throw new Exception('INVALID_POLL_DESCRIPTION_CHARSET');
        }
        $this->description = $description;
        
    }

    public function setThumbnailURL($thumbnailURL) {
        $this->thumbnailURL = $thumbnailURL;
    }

    public function setPrivacy($privacy) {
            if ($privacy !== 0 && $privacy !== 1) {
            throw new Exception('INVALID_PRIVACY_VALUE');
        }
        $this->privacy = $privacy;
    }

    public function setCreatedTime($createdTime) {
        $this->createdTime = $createdTime;
    }

    public function setUpdatedTime($updatedTime) {
        $this->updatedTime = $updatedTime;
    }

    public function data() {
        return array('poll_id' => $this->pollId, 'title' => $this->title, 'description' => $this->description);
    }

    public function dataAndQuestionsAnsAnswers() {
        $data = $this->data();
        foreach ($this->questions as $question) {
            $data['questions'][] = $question->dataAndAnswers();
        }
        return $data;
    }

    public function getQuestion($questionid) {
        foreach ($this->questions as $question) {
            if ($question->getQuestionId() === $questionid) {
                return $question;
            }
        }
        throw new Exception('QUESTION_NOT_FOUND');
    }

}
