<?php
require_once('../../actions/user.php');



// verify post data
if(empty($_POST) || !isset($_POST['email']) || !isset($_POST['password'])){
  die();  
} 

// log in user 
echo json_encode(user_login($_POST['email'],$_POST['password'])); 
