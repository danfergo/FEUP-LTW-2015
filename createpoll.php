<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');
require_once ('actions/sessioning.php');


$page = new ZenPage(__FILE__, user_who());

class CreatePoll extends PrivateView {

    private $oldPoll = null;
    private $errorMsg = false;

    public function initializeForMember() {
        $this->getPage()->setPageTitle("Criar votação");
        $this->getPage()->addJavaScriptSrc("js/poll-create.js");
        $this->setTemplate('poll-create');

        if (session_tempDataIsset('POLL_CREATE_ERROR')) {
            $this->oldPoll = session_getTempData('POLL_DATA');
            $this->errorMsg = session_getTempData('POLL_CREATE_ERROR');
            session_eraseTempData('POLL_CREATE_ERROR');
        }
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

$page->setMainView(new CreatePoll());
$page->echoView();

