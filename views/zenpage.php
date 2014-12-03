<?php

require_once('classes/page.php');

class Footer extends View {

    public function initialize() {
        $this->setTemplate('page-footer');
    }

}

class Sidebar extends PrivateView {

    public function initializeForMember() {
        $this->setTemplate('page-sidebar-logged');
    }

    public function initializeForPublic() {
        $this->setTemplate('page-sidebar-nonlogged');
        $this->getPage()->addJavaScriptSrc('js/user-register.js');
    }

}

class Header extends View {

    public function initialize() {
        $this->setTemplate('page-header');
    }

}

class PageWrapper extends View {

    public function initialize() {
        $this->setTemplate('page-wrapper');
        $this->addChildView('sidebar', new Sidebar());
        $this->addChildView('footer', new Footer());
        $this->addChildView('header', new Header());
    }

}

class ZenPage extends Page {

    private $body;
    private $pageTitle;
    private $websiteTitle = "QnA";
    
    public function __construct($path, $user) {
        parent::__construct($path, $user);
        $this->body = new PageWrapper();
    }

    public function initialize() {
        $this->addMetaTag(array('name'=> 'viewport', 'content' => 'width=device-width, initial-scale=1'));
        $this->addMetaTag(array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'));

        
        $this->addStyleSheetSrc('css/bootstrap.min.css');
        $this->addStyleSheetSrc('css/basic.css'); 
        $this->addJavaScriptSrc('js/jquery.js');

        $this->setTitle($this->websiteTitle);
        $this->addChildView('body', $this->body);

        parent::initialize();
    }

    public function setPageTitle($title){
        $this->pageTitle = $title;
        $this->title = $this->websiteTitle . " | " . $title;
    }
    
    public function getPageTitle($title){
        return $title;
    }
    
    
    public function setMainView($view) {
        $this->body->addChildView('main-view', $view);
    }

}
