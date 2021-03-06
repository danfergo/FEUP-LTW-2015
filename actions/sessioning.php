<?php

session_start();

function session_begin($user) {
    $_SESSION['qnaltw2015_userid'] = $user->getUserid();
}

function session_exists() {
    return isset($_SESSION['qnaltw2015_userid']);
}

function session_userid() {
    return session_exists() ? $_SESSION['qnaltw2015_userid'] : false;
}

function session_setTempData($name, $data) {
    $_SESSION["qnaltw2015_data"][$name] = $data;
}

function session_getTempData($name) {
    $data = $_SESSION["qnaltw2015_data"][$name];

    return $data;
}

function session_tempDataIsset($name) {
    return isset($_SESSION["qnaltw2015_data"][$name]);
}

function session_eraseTempData($name) {
    unset($_SESSION["qnaltw2015_data"][$name]);
}
