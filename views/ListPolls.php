<?php

require_once('classes/page.php');

class ListPollOrder extends View {

    private $type = '';
    private $parameter = '';
    private $order = 0;
    private $numPage = 0;

    function __construct($type,$parameter,$order,$numPage) {
        $this->type = $type;
        $this->parameter = $parameter;
        $this->order = $order;
        $this->numPage = $numPage;
    }

    public function initialize() {
        $this->setTemplate('poll-list-order');
    }

    public function getType() {
        return $this->type;
    }

    public function getParameter() {
        return $this->parameter;
    }

    public function getOrder() {
        return $this->order;
    }

    public function getNumPage() {
        return $this->numPage;
    }
}

class ListPollContent extends View {

    private $polls;

    function __construct($pollsArray) {

        $this->polls = $pollsArray;
    }

    public function initialize() {
        $this->setTemplate('poll-list-content');
    }
    public function getPolls() {
        return $this->polls;
    }

}

class ListPollPages extends View {

    private $pollSize = 0;
    private $type = '';
    private $parameter = '';
    private $order = 0;
    private $numPage = 0;

    function __construct($type,$parameter,$order,$numPage,$pollSize) {
        $this->type = $type;
        $this->parameter = $parameter;
        $this->order = $order;
        $this->numPage = $numPage;
        $this->pollSize = $pollSize;
    }

    public function initialize() {
        $this->setTemplate('poll-list-pages');
    }
    public function getType() {
        return $this->type;
    }

    public function getParameter() {
        return $this->parameter;
    }

    public function getOrder() {
        return $this->order;
    }

    public function getNumPage() {
        return $this->numPage;
    }
    public function getPollSize() {
        return $this->pollSize;
    }

    public function initializeForPublic() {
        $this->getPage()->redirectTo("index.php");
    }
}

class ListPollView extends View {

    private $polls = array();

    private $type = '';
    private $parameter = '';
    private $order = 0;
    private $numPage = 0;

    function __construct($type,$pollsArray,$parameter,$order,$numPage) {
        $this->type = $type;
        $this->polls = $pollsArray;
        $this->parameter = $parameter;
        $this->order = $order;
        $this->numPage = $numPage;
    }

    public function initialize() {
        $this->addChildView('order',new ListPollOrder($this->type,$this->parameter,$this->order,$this->numPage));
        $this->addChildView('content',new ListPollContent($this->polls));
        $this->addChildView('pages',new ListPollPages($this->type,$this->parameter,$this->order,$this->numPage,count($this->polls)));
        $this->setTemplate('poll-list');
    }

    public function getPolls() {
        return $this->polls;
    }
}