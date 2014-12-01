<?php

header('Content-type:application/json');

require_once('../../actions/poll.php');

$poll = array('title' => $_POST['title'], 'description' => $_POST['description'], 'privacy' => $_POST['privacy'], 'questions' => array());

$i = 0;
while(isset($_POST["question_title_$i"])){
    $question = array("title" => $_POST["question_title_$i"],"description" => $_POST["question_description_$i"], 'answers' => array());
    $j = 0;

    while(isset($_POST["answer_{$i}_$j"])){
        $question[]  = $_POST["answer_{$i}_$j"];
        $j++;
    }
    $poll[] = $question;
    $i++;
}
var_dump($poll);

poll_create($poll);


