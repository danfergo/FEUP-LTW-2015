<?php

require_once('init.php');
require_once (dirname(dirname(__FILE__)) . '/classes/poll.php');
require_once (dirname(dirname(__FILE__)) . '/classes/answer.php');
require_once (dirname(dirname(__FILE__)) . '/classes/question.php');


function db_poll_insert($poll){
    global $dbh;
    
    $stmt = $dbh->prepare("INSERT INTO poll (client_id,description,privacy)  VALUES (?,?,?)");
    $stmt->execute(array(
        $poll->getOwnerId(),
        $poll->getDescription(),
        $poll->getPrivacy()));
    $poll->setPollId($dbh->lastInsertId());
    
    foreach ($poll->getQuestions() as $question){
        foreach($question->getAnswers() as $answer){
            
        }
    }
    
}