<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');
require_once ('actions/poll.php');

try {
    if (!isset($_GET['id']) || preg_match('/^[1-9][0-9]*$/', $_GET['id']) !== 1) {
        throw new Exception('BAD_POLL_ID_VALUE');
    }
    $poll = poll_get($_GET['id']);
} catch (Exception $e) {
    echo "that poll does not exist";
    die();
}



$page = new ZenPage(__FILE__, user_who());

class PollView extends View {
    
    private $poll;
    
    public function __construct($poll){
        $this->poll = $poll;
    }
    
    public function initialize() {
        $this->getPage()->setPageTitle($this->poll->getTitle());
        $this->setTemplate("poll");
    }

    function getPoll() {
        return $this->poll;
    }

}
$page->setMainView(new PollView($poll));
$page->echoView();
