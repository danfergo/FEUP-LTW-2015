<?php

require_once('../../actions/poll.php');

$output = array();


try {
    $poll = poll_get($_GET['pollid']);
} catch (Exception $e) {
    die();
}



// check if there is an intention to vote.
if (isset($_POST['data'])) {
    $data['errors_voting'] = array();
    $data = json_decode($_POST['data'],true);
    foreach ($data as $question) {
        echo "kkk";
        if ($question['question_id'] && $question['answers'] && is_array($question['answers'])) {
            try {
                poll_vote_question($question['question_id'], $question['answers']);
            } catch (Exception $e) {
                // ok, something might wrong may have happened
                $output['errors_voting'][] = array('question_id' => $question['question_id'], 'reason' => $e->getMessage());
            }
        } // else: it's his problem. do not try to hack this thing.
    }
}


if (count($output)) {
    echo json_encode($output);
    die();
}

if (!isset($_GET['pollid'])) {
    die();
}

try {
    $poll = poll_get($_GET['pollid']);
    echo json_encode(poll_gen_results($poll));
} catch (Exception $ex) {
    echo json_encode($ex->getMessage());
}