    <?php

require_once('init.php');
require_once (dirname(dirname(__FILE__)) . '/classes/poll.php');
require_once (dirname(dirname(__FILE__)) . '/classes/answer.php');
require_once (dirname(dirname(__FILE__)) . '/classes/question.php');

function db_poll_insert($poll) {
    global $dbh;

    $stmt = $dbh->prepare("INSERT INTO poll (owner_id,title,description,privacy)  VALUES (?,?,?,?)");
    $stmt->execute(array(
        $poll->getOwnerId(),
        $poll->getTitle(),
        $poll->getDescription(),
        $poll->getPrivacy()));
    $poll->setPollId($dbh->lastInsertId());
}

function db_question_insert($question) {
    global $dbh;

    $stmt = $dbh->prepare("INSERT INTO question (poll_id,title,description)  VALUES (?,?,?)");
    $stmt->execute(array(
        $question->getPollId(),
        $question->getTitle(),
        $question->getDescription()));
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

    if($order == 'DESC') {
        $stmt = $dbh->prepare("SELECT * FROM poll
                            WHERE (description LIKE :search OR title LIKE :search )
                            AND (poll.privacy = 0 OR poll.owner_id = :owner_id)
                            ORDER BY :orderByMember DESC LIMIT :ini,:fin");
    }
    elseif($order == 'ASC') {
        $stmt = $dbh->prepare("SELECT * FROM poll
                            WHERE (description LIKE :search OR title LIKE :search )
                            AND (poll.privacy = 0 OR poll.owner_id = :owner_id)
                            ORDER BY :orderByMember ASC LIMIT :ini,:fin");
    }

    $stmt->bindParam(':search', $poll_search);
    $stmt->bindParam(':owner_id', $user_id);
    $stmt->bindParam(':orderByMember', $orderMember);

    $stmt->bindParam(':ini', $num_results_begin);
    $stmt->bindParam(':fin', $num_results_end);
    $stmt->execute();
    //var_dump($stmt->fetchAll());
    $polls = array();
    while ($row = $stmt->fetch()) {
        $poll = Poll::PollInit($row['poll_id'], $row['owner_id'], $row['title'], $row['description'], $row['privacy'], $row['created_time'], $row['updated_time']);
        array_push($polls, $poll);

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
