<?php

require_once (dirname(dirname(__FILE__)) . '/db/polls.php');
require_once (dirname(dirname(__FILE__)) . '/classes/poll.php');
require_once (dirname(dirname(__FILE__)) . '/classes/user.php');
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
    $p->setOwnerId(user_who()->getUserId());

    if (count(arr_at($poll, 'questions')) < 1) {
        throw new Exception('MUST_EXIST_A_QUESTION');
    }

    foreach (arr_at($poll, 'questions') as $question) {
        $q = new Question();
        $q->setDescription(arr_at($question, 'description'));
        $q->setTitle(arr_at($question, 'title'));        
        $q->setNumMaxPossibleChoices(arr_at($question, 'max'));
        $q->setNumMinPossibleChoices(arr_at($question, 'min'));
        
        
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

function poll_search($poll_search, $order, $num_results_begin, $num_results_end) {
    $user_id = user_who() === null ? 0 : user_who()->getUserId();
// acho que podia ser passado a funcao db_search_polls o user mesmo e lá decidia-se.
    $orderMember = "";
    $orderBy = "";
    if ($order == 0) {
        $orderMember = "title";
        $orderBy = "DESC";
    } elseif ($order == 1) {
        $orderMember = "title";
        $orderBy = "ASC";
    } elseif ($order == 2) {
        $orderMember = "created_time";
        $orderBy = "DESC";
    } elseif ($order == 3) {
        $orderMember = "created_time";
        $orderBy = "ASC";
    }
    $polls = db_search_polls($poll_search, $user_id, $orderMember, $orderBy, $num_results_begin, $num_results_end);


    return $polls;
}

function poll_get($id) {
    $poll = db_poll_select_byid($id);
    if ($poll === null) {
        throw new Exception('POLL_DOES_NOT_EXIST');
    }

    db_poll_select_questions($poll);
    foreach ($poll->getQuestions() as $question) {
        db_question_select_answers($question);
    }
    return $poll;
}

function poll_vote_question($questionId, $answers) {
    $question = db_question_select_byid($questionId);
    if ($question == null) {
        throw new Exception('QUESTION_NOT_FOUND');
    }
    if (user_who() === null) {
        throw new Exception('USER_NOT_LOGGEDIN');
    }
    if (count(db_select_voted_question_answersid($question, user_who())) !== 0) {
        throw new Exception('ALERADY_VOTED');
    }
    if (count($answers) < $question->getNumMinxPossibleChoices() || count($answers) > $question->getNumMaxPossibleChoices()) {
        throw new Exception('NR_ANSWERS_OUT_OF_RANGE');
    }

    db_question_select_answers($question);

    foreach ($answers as $a) {
        $question->getAnswer($a);
    }

    db_votes_insert(user_who(), $answers);
}

function poll_gen_results($poll) {
    $output = array();
    foreach ($poll->getQuestions() as $question) {
        if (user_who() !== null && count(db_select_voted_question_answersid($question, user_who())) !== 0) {
            db_question_select_results($question);
            $output[] = $question->results();
        }
    }
    return $output;
}

function poll_filter_didntvote($poll) {
    foreach ($poll->getQuestions() as $question) {
        if (count(db_select_voted_question_answersid($question, user_who())) !== 0) {
            $poll->removeQuestion($question);
        }
    }
    return $poll;
}
