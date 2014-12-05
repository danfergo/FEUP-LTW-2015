<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');


$page = new ZenPage(__FILE__, user_who());

class About extends View {

    public function initialize() {
        $this->setTemplate('about');
    }

}

$page->setMainView(new About());
$page->echoView();


