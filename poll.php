<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');


$page = new ZenPage(__FILE__, user_who());

class Poll extends View {

    public function initialize() {
        $this->setTemplate("poll-vote");
    }

}

$page->setMainView(new Poll());
$page->echoView();