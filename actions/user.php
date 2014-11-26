<?php
require_once (dirname(dirname(__FILE__)).'/db/users.php');
require_once (dirname(dirname(__FILE__)).'/classes/user.php');
require_once ('sessioning.php');

/** manage session **/ 

function user_login($email, $password) {
    if(session_exists()){
        return 'USER_ALREADY_LOGGED_IN';
    }
    
    $user = db_user_select_byemail($email);
    
    if ($user === false) {
        return 'INVALID_EMAIL';
    } else if ($user->hasPassword($password)) {
        session_begin($user);
        return $user->toJSON();
    } else {
        return 'INVALID_PASSWORD';
    }
}


function user_logout(){
    if(session_exists()){
        session_destroy();
        return true;
    } else {
        return 'USER_NOT_LOGGED_IN';
    }
}


function user_who(){
    return session_exists() ? db_user_select_byid(session_userid()) : null;
}

/** manage account **/

function user_register($name,$email,$password,$birthday){
   $user = new User();
   
   if (db_user_select_byemail($user->getEmail()) !== false) {
        return 'INVALID_EMAIL_ALREADY_EXISTS';
   }
   
   $user->setPassword($password);
    if($user->setName($name) === false){
        return 'INVALID_NAME';
    }else if($user->setEmail($email) === false){
        return 'INVALID_EMAIL';
    } else if($user->setBirthday($birthday) === false){
        return 'INVALID_BIRTHDAY';
    }
   
    return db_user_insert($user)->toJSON();
}





// update
// delete

