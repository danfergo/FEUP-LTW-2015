<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');


$page = new ZenPage(__FILE__, user_who());

class Contact extends View {

    public function initialize() {
        $this->setTemplate('contact');
    }

}

$page->setMainView(new Contact());
$page->echoView();


