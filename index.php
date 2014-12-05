<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');


$page = new ZenPage(__FILE__, user_who());

class Index extends View {

    public function initialize() {
        
    }

}

$page->setMainView(new Index());
$page->echoView();

 
