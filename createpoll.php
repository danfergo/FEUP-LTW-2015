<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');


$page = new ZenPage(__FILE__, user_who());

class CreatePoll extends PrivateView {

    public function initializeForMember() {
        $this->getPage()->setPageTitle("Criar votação");
        $this->getPage()->addJavaScriptSrc("js/poll-create.js");
    }

    public function initializeForPublic() {
        $this->getPage()->redirectTo("index.php");
    }

}

$page->setMainView(new CreatePoll());
$page->echoView();

