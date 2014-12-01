<?php
require_once (dirname(dirname(__FILE__)).'/db/polls.php');
require_once (dirname(dirname(__FILE__)).'/classes/poll.php');
require_once (dirname(dirname(__FILE__)).'/classes/user.php');
require_once ('user.php');  

function arr_at($arr, $pos) {
    if (!isset($arr[$pos])) {
        throw new Exception('DATA_MISSING');
    }
    return $arr[$pos];
}

/**
 * 
 * question is a array with [descriptio,
 */
function poll_create($poll) {
    // verifies if there is a user logged in 
    if (user_who() === null) {
        throw new Exception('USER_NOT_LOGGED_IN');
    }
    // creates poll   
    $p = new Poll();
    $p->setTitle(arr_at($poll, 'title'));
    $p->setDescription(arr_at($poll, 'description'));
    $p->setPrivacy(arr_at($poll, 'privacy'));


    if (count(arr_at($poll, 'questions')) < 1) {
        throw new Exception('MUST_EXIST_A_QUESTION');
    }

    foreach (arr_at($poll, 'questions') as $question) {
        $q = new Question();
        $q->setDescription(arr_at($question, 'description'));
        $q->setTitle(arr_at($question, 'title'));

        if (count(arr_at($question, 'answers')) < 2) {
            throw Exception('MUST_EXIST_TWO_ANSWERS');
        }

        foreach (arr_at($question, 'answers') as $answer) {
            $a = new Answer();
            $a->setTitle(arr_at($answer, 'title'));
            $q->addAnswer($a);
        }

        $p->addQuestion($q);
    }

    // we have now all the poll structure created and validated. lets insert it into db.
    db_poll_insert($p);
    foreach ($p->getQuestions() as $q) {
        $q->setPollId($p->getPollId());
        db_question_insert($q);
        foreach ($q->getAnswers() as $a) {
            $a->setQuestionId($q->getQuestionId());
            db_answer_insert($a);
        }
    }

    return $p;
}

function poll_delete($pollId) {
    // verifies if poll exists
    // if current user is it's owner
    // calls db delete poll.
}

/**
 * 
 * @param integer $pollId 
 * @param array $answers Array of answers. answer is an array of questionId and answerId
 */
function poll_vote($pollId, $answers) {
    // verifies if user is logged in
    // verifies if poll exists
    // verifies if user already voted on that poll
    // foreach question, for each answer
    // verfies if question belongs to poll
    // verifies if answer belongs to question
    // votes on the poll.
}

/**
 * 
 */
function poll_update() {
    
}

function poll_search($poll_search,$num_results_begin,$num_results_end){
    $user_id = user_who();
    if($user_id === null) $user_id = 0; // para mudar

    $polls = db_search_polls($poll_search, $user_id,$num_results_begin,$num_results_end);


    return $polls;
}