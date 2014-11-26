<?php
session_start();

function session_begin($user){    
    $_SESSION['qnaltw2015_userid'] = $user->getUserid();        
}


function session_exists(){
    return isset($_SESSION['qnaltw2015_userid']);
}

function session_userid(){
    return session_exists() ? $_SESSION['qnaltw2015_userid'] : false;
}
