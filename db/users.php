<?php
require_once('init.php');
require_once (dirname(dirname(__FILE__)) . '/classes/user.php');

function db_user_select_byid($userid) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->execute(array($userid));
    $user = $stmt->fetch();
    if ($user !== false) {
        return User::UserInit($user['user_id'], $user['name'], $user['email'], $user['password'], $user['birthday']);
    }
    return false;
}

function db_user_select_byemail($email) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM user WHERE email = ?");

    $stmt->execute(array($email));
    $user = $stmt->fetch();
    if ($user !== false) {
        return User::UserInit($user['user_id'], $user['name'], $user['email'], $user['password'], $user['birthday']);
    }
    return false;
}

function db_user_update($user) {
    global $dbh;
    $stmt = $dbh->prepare("UPDATE user SET name=?,email=?,password=?,birthday=? WHERE user_id = ?");
    $stmt->execute(array($user->getName(), $user->getPassword(), $user->getBirthday(), $user->getUserid()));
}


function db_user_insert($user) {
    global $dbh;

    $stmt = $dbh->prepare("INSERT INTO user (name,password,email,birthday)  VALUES (?,?,?,?)");
    $stmt->execute(array(
        $user->getName(),
        $user->getPassword(),
        $user->getEmail(),
        $user->getBirthday()));
    
    return User::UserInit($dbh->lastInsertId(), $user->getName(), $user->getEmail(), $user->getPassword(), $user->getBirthday());
}