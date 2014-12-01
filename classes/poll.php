<?php

class Poll {

    private $pollId;
    private $ownerId;
    private $description;
    private $thumbnailURL;
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

    public function toJSON(){
        $data = array('poll_id' => $this->pollId, 'title' =>$this->title, 'description' => $this->description, 'privacy' => $this->privacy);
        
    }
    
}
