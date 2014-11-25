<?php
require_once('../../actions/user.php');

// verify post data
if(empty($_POST) || !isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['birthday']) ){
  die();  
} 

// register user 
echo json_encode(user_register($_POST['name'],$_POST['email'],$_POST['password'],$_POST['birthday'])); 



