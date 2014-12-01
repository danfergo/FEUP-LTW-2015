<?php

require_once ('views/ListPolls.php');
require_once ('actions/poll.php');
require_once ('actions/user.php');

$pollsearch = poll_search($_GET['search'],0,10);
$page = new ListPolls(__FILE__, user_who(),$pollsearch);

class ListPoll extends View {

    public function initialize() {
        $this->getPage()->setPageTitle("Pesquisa de Votações");
        $this->setTemplate('poll-list');
    }



}


$page->setMainView(new ListPoll());
$page->echoView();

