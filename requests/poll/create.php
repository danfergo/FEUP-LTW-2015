<?php
 header('Content-type:application/json');

require_once('../../actions/poll.php');

if (empty($_POST) || !isset($_POST['data'])) {
    die();
}

// log in user 
try {
    echo poll_create($_POST['data'])->toJSON();
} catch (Exception $e) {
    echo $e->getMessage();
}
