<?php

header('Content-type:application/json');

require_once('../../actions/poll.php');

if(!isset($_GET['id'])){
    die();
}

try {
    db_poll_update(poll_get($_GET['id']),1);
} catch (Exception $e) {
}

header("Location: ../../poll.php?id={$_GET['id']}");