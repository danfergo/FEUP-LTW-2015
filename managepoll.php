<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');
require_once ('actions/sessioning.php');
require_once ('actions/poll.php');

class ManagePoll extends PrivateView {

    private $oldPoll;
    private $errorMsg;

    public function __construct($oldPoll = null, $errorMsg = false) {
        $this->oldPoll = $oldPoll;
        $this->errorMsg = $errorMsg;
    }

    public function initializeForMember() {
        $this->getPage()->setPageTitle("Criar votação");
        $this->getPage()->addJavaScriptSrc("js/poll-create.js");
        $this->setTemplate('poll-create');
    }

    public function getOldPoll() {
        return $this->oldPoll;
    }

    public function getErrorMsg() {
        return $this->errorMsg;
    }

    public function initializeForPublic() {
        $this->getPage()->redirectTo("index.php");
    }

}

$page = new ZenPage(__FILE__, user_who());

if (isset($_GET['id'])) {
    try {
        $ppp = poll_get($_GET['id']);
        if ($ppp->getState() == 0) {
            $page->setMainView(new ManagePoll($ppp->dataAndQuestionsAnsAnswers(), 'EDIT_POLL'));
        }else{
            echo "Ooops, esta poll nao pode ser editada";
            die();
        }
    } catch (Exception $err) {
        
    }
} else if (session_tempDataIsset('POLL_CREATE_ERROR')) {
    $page->setMainView(new ManagePoll(session_getTempData('POLL_DATA'), session_getTempData('POLL_CREATE_ERROR')->getMessage()));
    session_eraseTempData('POLL_CREATE_ERROR');
} else {
    $page->setMainView(new ManagePoll());
}

$page->echoView();

