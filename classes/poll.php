<?php

class Poll {

    private $pollId;
    private $ownerId;
    private $description;
    private $privacy;
    private $createdTime;
    private $updatedTime;
    private $questions = array();
    private $title;

    function __construct() {
        
    }

    static function PollInit($pollId, $ownerId, $title, $description, $privacy, $createdTime, $updatedTime) {
        $poll = new Poll();
        $poll->pollId = $pollId;
        $poll->ownerId = $ownerId;
        $poll->title = $title;
        $poll->description = $description;
        $poll->privacy = $privacy;
        $poll->createdTime = $createdTime;
        $poll->updatedTime = $updatedTime;
        return $poll;
    }

    public function getQuestions() {
        return $this->questions;
    }

    public function addQuestion($question) {
        $this->questions[] = $question;
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
        if (strlen($title) < 5) {
            throw new Exception('INVALID_POLL_TITLE');
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
        $this->description = $description;
    }

    public function setThumbnailURL($thumbnailURL) {
        $this->thumbnailURL = $thumbnailURL;
    }

    public function setPrivacy($privacy) {
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

}
