<?php

require_once ('views/zenpage.php');
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
$page = new zenpage(__FILE__, user_who());

$page->setMainView(new ListPollView('?search=',$pollSearch,$search, $order, $numPage));
$page->setPageTitle("Pesquisa de Votações");
$page->echoView();

