<?php

require_once('init.php');
require_once (dirname(dirname(__FILE__)) . '/classes/poll.php');
require_once (dirname(dirname(__FILE__)) . '/classes/answer.php');
require_once (dirname(dirname(__FILE__)) . '/classes/question.php');


function db_poll_insert($poll){
    global $dbh;
    
    $stmt = $dbh->prepare("INSERT INTO poll (owner_id,title,description,privacy)  VALUES (?,?,?,?)");
    $stmt->execute(array(
        $poll->getOwnerId(),
        $poll->getTitle(),
        $poll->getDescription(),
        $poll->getPrivacy()));
    $poll->setPollId($dbh->lastInsertId());
}

function db_question_insert($question){
    global $dbh;
    
    $stmt = $dbh->prepare("INSERT INTO question (poll_id,title,description)  VALUES (?,?,?)");
    $stmt->execute(array(
        $question->getPollId(),
        $question->getTitle(),
        $question->getDescription()));
    $question->setPollId($dbh->lastInsertId());  
}

function db_answer_insert($answer){
    global $dbh;
    
    $stmt = $dbh->prepare("INSERT INTO answer (question_id,title)  VALUES (?,?)");
    $stmt->execute(array(
        $answer->getQuestionId(),
        $answer->getTitle()));
    $answer->setPollId($dbh->lastInsertId()); 
}


function db_search_polls($poll_search, $user_id, $num_results_begin, $num_results_end){
    global $dbh;

    $poll_search = "%$poll_search%";

    $stmt = $dbh->prepare("SELECT * FROM poll
                            WHERE (description LIKE :search OR title LIKE :search )
                            AND (poll.privacy = 0 OR poll.owner_id = :owner_id)
                            ORDER BY created_time DESC LIMIT :ini,:fin");
    //$stmt = $dbh->prepare("SELECT * FROM poll ORDER BY created_time DESC LIMIT :ini,:fin");
    $stmt->bindParam(':search', $poll_search);
    $stmt->bindParam(':owner_id', $user_id);
    $stmt->bindParam(':ini', $num_results_begin);
    $stmt->bindParam(':fin', $num_results_end);
    $stmt->execute();
    //var_dump($stmt->fetchAll());
    $polls = array();
    while ($row = $stmt->fetch()) {
        array_push($polls,$row);
    }

    return $polls;
}