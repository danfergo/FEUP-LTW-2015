<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');


$page = new ZenPage(__FILE__, user_who());

class ListPoll extends View {

    public function initialize() {
        $this->getPage()->setPageTitle("Listar Votações");
        $this->setTemplate('poll-list');
    }

}

$page->setMainView(new ListPoll());
$page->echoView();

