<?php

require_once ('views/zenpage.php');
require_once ('views/ListPolls.php');
require_once ('actions/poll.php');
require_once ('actions/user.php');


//$page = new ZenPage(__FILE__, user_who());

/*class Index extends View {

    public function initialize() {
        
    }

}*/

$user_id = user_who() === null ? 0 : user_who()->getUserid();

$polls_ids = db_most_popular_polls("", $user_id, "history");

$polls = array();
foreach($polls_ids as $index =>$poll_id){
    $poll = db_poll_select_byid($poll_id['poll.poll_id']);
    array_push($polls,$poll);
}
array_slice($polls,0,3);

$page = new zenpage(__FILE__, user_who());

$page->setMainView(new ListPollContent($polls));
$page->setPageTitle("Bem vindo a Perguntar");

$page->echoView();


