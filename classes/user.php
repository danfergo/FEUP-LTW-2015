<?php

class User{
    private $userid;
    private $name;
    private $email;
    private $birthday;
    private $password;
    
    public function __construct(){
    }
    
    public static function UserInit($userid,$name,$email,$password,$birthday) {
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
        $encOptions = ['cost' => 12];
        $this->password =  password_hash($password, PASSWORD_DEFAULT, $encOptions);
    }

    public function hasPassword($password){
        return password_verify($password, $this->password);
    }
    
    public function setName($name) {
        $name = trim($name);
        if(strlen($name) >= 6 && strlen($name) <= 30  && count(explode(' ',$name)) === 2){
            $this->name = $name;
            return true;
        }else{
            return false;
        }
    }
    
    public function setEmail($email) {
        $email = trim($email);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->email = $email;
            return true;
        }else {
            return false;    
        }
    }

    public function setBirthday($birthday) { // yy - mm - dd 
        $birthday = trim($birthday);
        $timeBirthday = strtotime($birthday);
        if($timeBirthday > strtotime("-120 year", time()) &&  $timeBirthday < strtotime("-6 year", time()) ) {
            $this->birthday = $birthday;
            return true;
        }else{
            return false;
        }
    }

        
    public function toJSON(){
        $data = array(
            'userid' => $this->userid,
            'name' => $this->name,
            'email' => $this->email,
            'birthay' => $this->birthday
            );
        return json_encode($data);
    }
    
    
    
    
    
    
    
}