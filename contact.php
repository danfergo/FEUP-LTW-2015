<?php

require_once ('views/zenpage.php');
require_once ('actions/user.php');


$page = new ZenPage(__FILE__, user_who());

class Contact extends View {
    
    public function initialize() {
        $this->getPage()->addJavascriptSrc('js/contact-mail.js');
        $this->setTemplate('contact');
    }
    
    public function formUsername() {
        return $this->getPage()->getUser() ? $this->getPage()->getUser()->getName() : "";
    }
    
    public function formEmail() {
        return $this->getPage()->getUser() ? $this->getPage()->getUser()->getEmail() : "";
    }
}
// GET -> ?report=POLLID
$page->setMainView(new Contact());
$page->echoView();


