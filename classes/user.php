<?php

class User {

    private $userid = 0;
    private $name;
    private $email;
    private $birthday;
    private $password;

    public function __construct() {
        
    }

    public static function UserInit($userid, $name, $email, $password, $birthday) {
        $user = new User();
        $user->userid = $userid;
        $user->name = $name;
        $user->email = $email;
        $user->birthday = $birthday;
        $user->password = $password;
        return $user;
    }

    public function getUserid() {
        return $this->userid;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getBirthday() {
        return $this->birthday;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $encOptions = array('cost' => 12);
        $this->password = password_hash($password, PASSWORD_DEFAULT, $encOptions);
    }

    public function hasPassword($password) {
        return password_verify($password, $this->password);
    }

    public function setName($name) {
        $name = trim($name);
        $nrpalavras = count(explode(' ', $name));
        if (strlen($name) >= 6 && strlen($name) <= 30 && $nrpalavras == 1 && $nrpalavras > 6) {
            throw new Exception('INVALID_NAME_FORMAT');
        } else if (!preg_match('/^[A-Za-z\s]*$/', $name)) {
            throw new Exception('INVALID_CHARSET');
        }
        $this->name = $name;
    }

    public function setEmail($email) {
        $email = trim($email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new Exception('INVALID_EMAIL');
        }
    }

    public function setBirthday($birthday) { // yy - mm - dd 
        $birthday = trim($birthday);
        $timeBirthday = strtotime($birthday);
        if ($timeBirthday > strtotime("-120 year", time()) && $timeBirthday < strtotime("-6 year", time())) {
            $this->birthday = $birthday;
        } else {
            throw new Exception('INVALID_BIRTHDAY');
        }
    }

    public function toJSON() {
        $data = array(
            'userid' => $this->userid,
            'name' => $this->name,
            'email' => $this->email,
            'birthay' => $this->birthday
        );
        return json_encode($data);
    }

}
