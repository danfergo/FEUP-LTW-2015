<?php

require_once('configs.php');
require_once (dirname(dirname(__FILE__)) . '/classes/user.php');

function user_register($user) {
    global $dbh;

    if (user_select_byemail($user->getEmail()) !== false) {
        return 'INVALID_EMAIL_ALREADY_EXISTS';
    }

    $stmt = $dbh->prepare("INSERT INTO user (name,password,email,birthday)  VALUES (?,?,?,?)");
    $stmt->execute(array(
        $user->getName(),
        $user->getPassword(),
        $user->getEmail(),
        $user->getBirthday()));
}

function user_select_byid($userid) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->execute(array($userid));
    $user = $stmt->fetch();
    if ($user !== false) {
        return User::UserInit($user['user_id'], $user['name'], $user['email'], $user['password'], $user['birthday']);
    }
    return false;
}

function user_select_byemail($email) {
    global $dbh;

    $stmt = $dbh->prepare("SELECT * FROM user WHERE email = ?");

    $stmt->execute(array($email));
    $user = $stmt->fetch();
    if ($user !== false) {
        return User::UserInit($user['user_id'], $user['name'], $user['email'], $user['password'], $user['birthday']);
    }
    return false;
}

function user_update($user) {
    global $dbh;
    $stmt = $dbh->prepare("UPDATE user SET name=?,email=?,password=?,birthday=? WHERE user_id = ?");
    $stmt->execute(array($user->getName(), $user->getPassword(), $user->getBirthday(), $user->getUserid()));
}

function user_login($email, $password) {
    $user = user_select_byemail($email);

    if ($user === false) {
        return 'INVALID_EMAIL';
    } else if (password_verify($password, $user->getPassword())) {
        return $user;
    } else {
        return 'INVALID_PASSWORD';
    }
}
