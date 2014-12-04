<?php

require_once('init.php');
require_once (dirname(dirname(__FILE__)) . '/classes/poll.php');
require_once (dirname(dirname(__FILE__)) . '/classes/answer.php');
require_once (dirname(dirname(__FILE__)) . '/classes/question.php');

function db_poll_insert($poll) {
    global $dbh;
    $t = date('Y-m-d H:i:s');

    $stmt = $dbh->prepare("INSERT INTO poll (owner_id,title,description,privacy,created_time,updated_time)  VALUES (?,?,?,?,?,?)");
    $stmt->execute(array(
        $poll->getOwnerId(),
        $poll->getTitle(),
        $poll->getDescription(),
        $poll->getPrivacy(), $t, $t));
    $poll->setPollId($dbh->lastInsertId());
}

function db_question_insert($question) {
    global $dbh;

    $stmt = $dbh->prepare("INSERT INTO question (poll_id,title,description,min_possible_choices,max_possible_choices)  VALUES (?,?,?,?,?)");
    $stmt->execute(array(
        $question->getPollId(),
        $question->getTitle(),
        $question->getDescription(),
        $question->getNumMinPossibleChoices(),
        $question->getNumMaxPossibleChoices()));
    $question->setQuestionId($dbh->lastInsertId());
}

function db_answer_insert($answer) {
    global $dbh;

    $stmt = $dbh->prepare("INSERT INTO answer (question_id,title)  VALUES (?,?)");
    $stmt->execute(array(
        $answer->getQuestionId(),
        $answer->getTitle()));
    $answer->setAnswerId($dbh->lastInsertId());
}

function db_search_polls($poll_search, $user_id, $orderMember, $order, $num_results_begin, $num_results_end) {
    global $dbh;

    $poll_search = "%$poll_search%";

    if($order == "DESC") {
        $stmt = $dbh->prepare("SELECT * FROM poll
                            WHERE (description LIKE :search OR title LIKE :search )
                                  AND (poll.privacy = 0 OR poll.owner_id = :owner_id)
                            ORDER BY ". $orderMember ." DESC");
    }
    elseif($order == "ASC") {
        $stmt = $dbh->prepare("SELECT * FROM poll
                            WHERE (description LIKE :search OR title LIKE :search )
                                  AND (poll.privacy = 0 OR poll.owner_id = :owner_id)
                            ORDER BY ". $orderMember ." ASC");
    }
    $stmt->bindParam(':search', $poll_search);
    $stmt->bindParam(':owner_id', $user_id);
    $stmt->execute();

    $polls = array();
    while ($row = $stmt->fetch()) {
        $poll = Poll::PollInit($row['poll_id'], $row['owner_id'], $row['title'], $row['description'], $row['privacy'], $row['created_time'], $row['updated_time']);
        array_push($polls, $poll);
    }

    return array_slice($polls,$num_results_begin,$num_results_end);
}

function db_most_popular_polls($poll_search, $user_id, $type){
    global $dbh;

    $poll_search = "%$poll_search%";
    $notFromHistory = $type == "history" ? "" : "poll.privacy = 0 OR poll.owner_id = :user_id OR ";

    $stmt = $dbh->prepare("SELECT DISTINCT poll.title,poll.created_time,poll.description,poll.privacy,poll.created_time,poll.updated_time,poll.owner_id ,num_answer.poll_id,num_answer.counter
                            FROM num_answer, poll, choose_answer
                            WHERE num_answer.poll_id = poll.poll_id AND num_answer.answer_id = choose_answer.answer_id
                                  AND (poll.description LIKE :search OR poll.title LIKE :search)
                                  AND (" . $notFromHistory . "choose_answer.user_id = :user_id)
                            ORDER BY counter DESC");                //,num_answer.question_id,num_answer.answer_id,
    $stmt->bindParam(':search', $poll_search);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $polls = array();
    while ($row = $stmt->fetch()) {
        $poll = Poll::PollInit($row['poll_id'], $row['owner_id'], $row['title'], $row['description'], $row['privacy'], $row['created_time'], $row['updated_time']);
        array_push($polls, $poll);
    }
    return $polls;
}

function db_get_polls_answered_by_user($user_id, $orderMember){
    global $dbh;


    $stmt = $dbh->prepare("SELECT DISTINCT poll_id,user_id FROM answer_chosen
                            WHERE user_id = :user_id
                            ORDER BY :order_member DESC");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':order_member', $orderMember);
    $stmt->execute();

    $polls = array();
    while ($row = $stmt->fetch()) {
        array_push($polls, $row);
    }
    return $polls;
}

function db_poll_select_byid($id) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM poll WHERE poll_id = ?");
    $stmt->execute(array($id));
    $p = $stmt->fetch();
    return $p === false ? null : Poll::PollInit($p['poll_id'], $p['owner_id'], $p['title'], $p['description'], $p['privacy'], $p['created_time'], $p['updated_time']);
}

function db_question_select_byid($id) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM question WHERE question_id = ?");
    $stmt->execute(array($id));
    $q = $stmt->fetch();
    return $q === false ? null : Question::QuestionInit($q['question_id'], $q['poll_id'], $q['title'], $q['description'], $q['min_possible_choices'], $q['max_possible_choices']);
}

function db_answer_select_byid($id) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM answer WHERE answer_id = ?");
    $stmt->execute(array($id));
    $a = $stmt->fetch();
    return $a === false ? null : Answer::AnswerInit($a['answer_id'], $a['question_id'], $a['title']);
}

function db_poll_select_questions($poll) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM question WHERE poll_id = ?");
    $stmt->execute(array($poll->getPollId()));
    while ($q = $stmt->fetch()) {
        $poll->addQuestion(Question::QuestionInit($q['question_id'], $q['poll_id'], $q['title'], $q['description'], $q['min_possible_choices'], $q['max_possible_choices']));
    }
}

function db_question_select_answers($question) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM answer WHERE question_id = ?");
    $stmt->execute(array($question->getQuestionId()));
    while ($a = $stmt->fetch()) {
        $question->addAnswer(Answer::AnswerInit($a['answer_id'], $a['question_id'], $a['title']));
    }
}

function db_select_voted_question_answersid($question, $owner) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM answer_chosen WHERE question_id = ? AND user_id = ?");
    $stmt->execute(array($question->getQuestionId(), $owner->getUserId()));
    $result = array();
    while ($a = $stmt->fetch()) {
        $result[] = $a['answer_id'];
    }
    return $result;
}

function db_question_select_results($question) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM num_answer WHERE question_id = ?");
    $stmt->execute(array($question->getQuestionId()));
    while ($a = $stmt->fetch()) {
        $question->getAnswer($a['answer_id'])->setNrOfVotes($a['counter']);
    }
}

function db_votes_insert($user, $answersId) {
    global $dbh;

    $stmt = $dbh->prepare("INSERT INTO choose_answer (user_id,answer_id)  VALUES (?,?)");

    foreach ($answersId as $aid) {
        $stmt->execute(array($user->getUserId(), $aid));
    }
}
