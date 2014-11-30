<?php
 header('Content-type:application/json');

require_once('../../actions/user.php');



// verify post data
if (empty($_POST) || !isset($_POST['email']) || !isset($_POST['password'])) {
    die();
}

// log in user 
try {
    echo user_login($_POST['email'], $_POST['password'])->toJSON();
} catch (Exception $e) {
    echo $e->getMessage();
}
