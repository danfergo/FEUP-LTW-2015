<?php
require_once (dirname(dirname(dirname(__FILE__))).'/db/users.php');
require_once (dirname(dirname(dirname(__FILE__))).'/classes/user.php');

if(empty($_POST)){
  die();  
} 

// verify if an user is already logged in 
session_start();    
if(isset($_SESSION['qnaltw2015_userid'])){
    echo json_encode('USER_ALREADY_LOGGED_IN'); die();
}

// verfy user/password
$user = user_login($_POST['email'],$_POST['password']);
if($user === 'INVALID_EMAIL' || $user === 'INVALID_PASSWORD'){
    echo json_encode($result); die();
}


// log in user 
$_SESSION['qnaltw2015_userid'] = $user->getUserid();
echo json_encode('LOGGEIN_WITH_SUCCESS'); 



