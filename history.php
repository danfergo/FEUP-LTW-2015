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

$page = new zenpage(__FILE__, user_who());

if(user_who() == null){
    $page->redirectTo("index.php");
}

$page->setMainView(new ListPollView('?',$pollsHistory,'', $order, $numPage));
$page->setPageTitle("Pesquisa de Votações");
$page->echoView();


