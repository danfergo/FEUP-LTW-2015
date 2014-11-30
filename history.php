<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');


$page = new ZenPage(__FILE__, user_who());

class History extends View {

    public function initialize() {
        
    }

}

$page->setMainView(new History());
$page->echoView();


