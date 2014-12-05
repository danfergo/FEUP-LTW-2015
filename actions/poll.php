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

function arr_at_id($arr, $pos) {
    return !isset($arr[$pos]) ? 0 : 0+$arr[$pos];
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
    $p->setOwnerId(user_who()->getUserid());

    $p->setPollId(arr_at_id($poll,'poll_id'));

    if (count(arr_at($poll, 'questions')) < 1) {
        throw new Exception('MUST_EXIST_A_QUESTION');
    }

    foreach (arr_at($poll, 'questions') as $question) {
        $q = new Question();
        $q->setDescription(arr_at($question, 'description'));
        $q->setTitle(arr_at($question, 'title'));
        $q->setNumMaxPossibleChoices(arr_at($question, 'max'));
        $q->setNumMinPossibleChoices(arr_at($question, 'min'));
        $q->setQuestionId(arr_at_id($question,'question_id'));
        
        if (count(arr_at($question, 'answers')) < 2) {
            throw Exception('MUST_EXIST_TWO_ANSWERS');
        }

        foreach (arr_at($question, 'answers') as $answer) {
            $a = new Answer();
            $a->setTitle(arr_at($answer, 'title'));
            $a->setAnswerId(arr_at_id($answer,'answer_id'));
            $q->addAnswer($a);
        }

        $p->addQuestion($q);
    }
    

    // we have now all the poll structure created and validated. lets insert/update it into db.
    if ($p->getPollId() === 0) {
        db_poll_insert($p);
    } else {
        db_poll_update($p);
    }
    foreach ($p->getQuestions() as $q) {
        $q->setPollId($p->getPollId());
        if ($q->getQuestionId() === 0) {
            db_question_insert($q);
        } else {
            db_question_update($q);
        }
        foreach ($q->getAnswers() as $a) {
            $a->setQuestionId($q->getQuestionId());
            if ($a->getAnswerId() === 0) {
                db_answer_insert($a);
            } else {
                db_answer_update($a);
            }
        }
    }

    return $p;
}

function poll_delete($pollId) {
// verifies if poll exists
// if current user is it's owner
// calls db delete poll.
}

function poll_search($poll_search, $order, $num_results_begin, $num_results_end) {
    $user_id = user_who() === null ? 0 : user_who()->getUserid();

    if($order == 4) {
        $polls_ids = db_most_popular_polls("", $user_id, "history");
        $polls = array();
        foreach($polls_ids as $index =>$poll_id){
            $poll = db_poll_select_byid($poll_id['poll.poll_id']);
            array_push($polls,$poll);
        }
        return array_slice($polls,$num_results_begin,$num_results_end);
    } elseif($order == 0){
        return db_search_polls($poll_search, $user_id, 'title', "DESC", $num_results_begin, $num_results_end);
    } elseif($order == 1) {
        return db_search_polls($poll_search, $user_id, 'title', "ASC", $num_results_begin, $num_results_end);
    } elseif($order == 2) {
        return db_search_polls($poll_search, $user_id, 'created_time', "DESC", $num_results_begin, $num_results_end);
    } elseif($order == 3) {
        return db_search_polls($poll_search, $user_id, 'created_time', "ASC", $num_results_begin, $num_results_end);
    }
}

function poll_user_history($order, $num_results_begin, $num_results_end) {
    $user_id = user_who() === null ? 0 : user_who()->getUserid();

    if($order == 4) {
        $polls_ids = db_most_popular_polls("", $user_id, "history");
        $polls = array();
        foreach($polls_ids as $index =>$poll_id){
            $poll = db_poll_select_byid($poll_id['poll.poll_id']);
            array_push($polls,$poll);
        }
        return array_slice($polls,$num_results_begin,$num_results_end);
    } elseif($order == 0){
        $ids = db_get_polls_answered_by_user($user_id,"title"); //DESC
        $polls = array();
        foreach ($ids as $index => $id) {
            $poll = db_poll_select_byid($id['poll_id']);
            array_push($polls, $poll);
        }
        return array_slice($polls, $num_results_begin, $num_results_end);
    } elseif ($order == 1) {
        $ids = db_get_polls_answered_by_user($user_id, "title"); //ASC
        $polls = array();
        foreach ($ids as $index => $id) {
            $poll = db_poll_select_byid($id['poll_id']);
            array_push($polls, $poll);
        }
        return array_slice(array_reverse($polls), $num_results_begin, $num_results_end);
    } elseif ($order == 2) {
        $ids = db_get_polls_answered_by_user($user_id, "created_time"); //DESC
        $polls = array();
        foreach ($ids as $index => $id) {
            $poll = db_poll_select_byid($id['poll_id']);
            array_push($polls, $poll);
        }
        return array_slice($polls, $num_results_begin, $num_results_end);
    } elseif ($order == 3) {
        $ids = db_get_polls_answered_by_user($user_id, "created_time"); //ASC
        $polls = array();
        foreach ($ids as $index => $id) {
            $poll = db_poll_select_byid($id['poll_id']);
            array_push($polls, $poll);
        }
        return array_slice(array_reverse($polls), $num_results_begin, $num_results_end);
    }
    return 0;
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
    if (count($answers) < $question->getNumMinPossibleChoices() || count($answers) > $question->getNumMaxPossibleChoices()) {
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
        if (user_who() != null && count(db_select_voted_question_answersid($question, user_who())) !== 0) {
            $poll->removeQuestion($question);
        }
    }
    return $poll;
}
