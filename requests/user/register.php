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

// create user to register & check data
$user = User::UserCreate($_POST['name'],$_POST['email'],$_POST['password'],$_POST['birthday']);
if($user === 'INVALID_NAME' || $user === 'INVALID_EMAIL' || $user === 'INVALID_BIRTHDAY'){
        echo json_encode($user); die();
}

// register user 
if(user_register($user) === 'INVALID_EMAIL_ALREADY_EXISTS'){
    echo json_encode('INVALID_EMAIL_ALREADY_EXISTS'); die();
}

echo json_encode('REGISTERED_WITH_SUCCESS'); 



