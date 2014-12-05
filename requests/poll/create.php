<?php

header('Content-type:application/json');

require_once('../../actions/poll.php');
require_once('../../actions/upload.php');
require_once('../../actions/sessioning.php');

$pollData = array(
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'privacy' => $_POST['privacy'] == 1 ? 1 : 0,
    'questions' => array());

if (isset($_POST['poll_id'])) {
    $pollData['poll_id'] = $_POST['poll_id'];
}

$i = 0;
while (isset($_POST["question_title_$i"])) {
    $question = array(
        'title' => $_POST["question_title_$i"],
        'description' => $_POST["question_description_$i"],
        'min' => $_POST["question_min_$i"],
        'max' => $_POST["question_max_$i"],
        'answers' => array());
        if (isset($_POST["question_id_$i"])) {
            $question['question_id'] = $_POST["question_id_$i"];
        }

    $j = 0;
    while (isset($_POST["answer_{$i}_$j"])) {
        if (isset($_POST["answer_id_{$i}_$j"])) {
            $question['answers'][] = array('title' => $_POST["answer_{$i}_$j"], 'answer_id' => $_POST["answer_id_{$i}_$j"]);
        } else {
            $question['answers'][] = array('title' => $_POST["answer_{$i}_$j"]);
        }
        $j++;
    }

    $pollData['questions'][] = $question;
    $i++;
}

try {
    valid_img($_FILES['image']['tmp_name']);
    $poll = poll_create($pollData);
    save_img($poll->getPollId(), $_FILES['image']['tmp_name']);


    session_setTempData('POLL_CREATE_SUCCESS', $poll->getPollId());
    header("Location: ../../poll.php?id={$poll->getPollId()}");
} catch (Exception $e) {

    session_setTempData('POLL_CREATE_ERROR', $e);
    session_setTempData('POLL_DATA', $pollData);

    header("Location: ../../managepoll.php");
}




