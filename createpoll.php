<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');


$page = new ZenPage(__FILE__, user_who());

class CreatePoll extends View {

    public function initialize() {
        $this->getPage()->setPageTitle("Criar votação");
        $this->getPage()->addJavaScriptSrc("js/poll-create.js");
       // $this->setTemplate('poll-create');
    }

}

$page->setMainView(new CreatePoll());
$page->echoView();

