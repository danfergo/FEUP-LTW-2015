<?php

require_once(dirname(dirname(__FILE__)) . '/classes/page.php');

class Sidebar extends PrivateView {

    public function initializeForMember() {
        $this->setTemplate('sidebar-logged');
    }

    public function initializeForPublic() {
        $this->setTemplate('sidebar-nonlogged');
        $this->getPage()->addJavasScriptSrc('js/user.register.js');
    }

}

class Header extends View {

    public function initialize() {
        $this->setTemplate('header');
    }

}

class PageWrapper extends PrivateView {

    public function initialize() {
        $this->setTemplate('page-wrapper');
        $this->addChildView('sidebar', new Sidebar());
        $this->addChildView('header', new Header());
    }

}

class ZenPage extends Page {

    private $body;

    public function __construct($path, $user) {
        parent::__construct($path, $user);
        $this->body = new PageWrapper();
    }

    public function initialize() {
        $this->addMetaTag(array('viewport' => 'width=device-width, initial-scale=1'));
        $this->addMetaTag(array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'));

        $this->addStyleSheetSrc('css/bootstrap.min.css');
        $this->addStyleSheetSrc('css/basic.css');
        $this->addJavasScriptSrc('js/jquery.js');

        $this->addChildView('body', $this->body);

        parent::initialize();
    }

    public function setMainView($view) {
        $this->body->addChildView('main-view', $view);
    }

}
