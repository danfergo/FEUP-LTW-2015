<?php

require_once('classes/page.php');

class ListPollView extends View {

    private $polls;

    function __construct($pollsArray) {
        $this->polls = $pollsArray;
    }

    public function initialize() {
        $this->setTemplate('poll-list');
    }

    public function getPolls() {
        return $this->polls;
    }
}
