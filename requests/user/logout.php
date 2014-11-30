<?php
 header('Content-type:application/json');

require_once('../../actions/user.php');

// user logout
try {
    user_logout();
    echo json_encode('LOGGED_OUT_WITH_SUCCESS');
} catch (Exception $e) {
    echo $e->getMessage();
}