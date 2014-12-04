<?php
require_once ('views/ZenPage.php');
require_once ('views/ListPolls.php');
require_once ('actions/poll.php');
require_once ('actions/user.php');

$search = urlencode($_GET['search']);

if(isset($_GET['page'])){
    is_numeric($_GET['page']) ? $numPage = abs($_GET['page']) : $numPage = 0;
}
else $numPage = 0;

if(isset($_GET['order'])){

    intval($_GET['order']) >= 0 && intval($_GET['order']) <= 4 ? $order = intval($_GET['order']) : $order = 0;
}
else $order = '0';

$pollSearch = poll_search($_GET['search'],$order, $numPage*12, $numPage*12 + 12);
$page = new ZenPage(__FILE__, user_who());

class SearchView extends ListPollView {

    private $type = 'search.php?search=';
    private $parameter = '';
    private $order = 0;
    private $numPage = 0;

    public function __construct($pollsArray,$parameter,$order,$numPage) {
        parent::__construct($pollsArray);
        $this->parameter = $parameter;
        $this->order = $order;
        $this->numPage = $numPage;
    }

    public function initialize() {
        parent::initialize();
        $this->getPage()->setPageTitle("Pesquisa de Votações");
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

$page->setMainView(new SearchView($pollSearch,$search,$order, $numPage));
$page->echoView();