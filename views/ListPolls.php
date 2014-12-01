<?php

require_once('classes/page.php');

class ListPollView extends View {

    private $polls;

    function __construct($pollsArray) {
        $this->polls = $pollsArray;
    }

    public function initialize() {
        $this->setTemplate('poll-list');
    }

    public function getPolls() {
        return $this->polls;
    }

}

/*
class ListPolls extends Page {

    private $body;
    private $pageTitle;
    private $websiteTitle = "QnA";
    private $polls;

    public function __construct($path, $user, $pollsArray) {
        parent::__construct($path, $user);
        $this->body = new PageWrapper();
        $this->polls = $pollsArray;
    }

    public function initialize() {
        $this->addMetaTag(array('viewport' => 'width=device-width, initial-scale=1'));
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

    public function getPolls(){
        return $this->polls;
    }


    public function setMainView($view) {
        $this->body->addChildView('main-view', $view);
    }

}
*/