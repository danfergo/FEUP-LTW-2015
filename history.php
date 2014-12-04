<?php

require_once ('views/ZenPage.php');
require_once ('views/ListPolls.php');
require_once ('actions/poll.php');
require_once ('actions/user.php');

if(isset($_GET['page'])){
    is_numeric($_GET['page']) ? $numPage = abs($_GET['page']) : $numPage = 0;
}
else $numPage = 0;

if(isset($_GET['order'])){

    intval($_GET['order']) >= 0 && intval($_GET['order']) <= 4 ? $order = intval($_GET['order']) : $order = 0;
}
else $order = '0';

$pollsHistory = poll_user_history($order, $numPage*12, $numPage*12 + 12);

$page = new ZenPage(__FILE__, user_who());

class History extends ListPollView {

    private $type = 'history.php?';
    private $parameter = '';
    private $order = 0;
    private $numPage = 0;

    public function __construct($pollsArray,$order,$numPage) {
        parent::__construct($pollsArray);
        $this->order = $order;
        $this->numPage = $numPage;
    }

    public function initialize() {
        parent::initialize();
        $this->getPage()->setPageTitle("Historico de Votações");
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

$page->setMainView(new History($pollsHistory,$order,$numPage));
$page->echoView();


