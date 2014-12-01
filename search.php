<?php
require_once ('views/ZenPage.php');
require_once ('views/ListPolls.php');
require_once ('actions/poll.php');
require_once ('actions/user.php');

$pollsearch = poll_search($_GET['search'], 0, 10);
$page = new ZenPage(__FILE__, user_who());

class SearchView extends ListPollView {

    public function __construct($pollsArray) {
        parent::__construct($pollsArray);
    }

    public function initialize() {
        parent::initialize();
        $this->getPage()->setPageTitle("Pesquisa de Votações");
    }

}

$page->setMainView(new SearchView($pollsearch));
$page->echoView();

