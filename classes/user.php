<?php

class User{
    private $userid;
    private $name;
    private $email;
    private $birthday;
    private $password;
    
    public function __construct(){
    }
    
    public static function UserCreate($name,$email,$password,$birthday){
        $user = new User();
        $user->setPassword($password);
        if($user->setName($name) === false){
            return 'INVALID_NAME';
        }else if($user->setEmail($email) === false){
            return 'INVALID_EMAIL';
        } else if($user->setBirthday($birthday) === false){
            return 'INVALID_BIRTHDAY';
        }
        return $user;
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

    public function setName($name) {
        $name = trim($name);
        if(strlen($name) >= 6 && strlen($name) <= 30  && count(explode(' ',$name)) === 2){
            $this->name = $name;
        }else{
            return false;
        }
    }
    
    

    public function setEmail($email) {
        $email = trim($email);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->email = $email;
        }else {
            return false;    
        }
    }

    public function setBirthday($birthday) { // yy - mm - dd 
        $birthday = trim($birthday);
        $timeBirthday = strtotime($birthday);
        if($timeBirthday > strtotime("-120 year", time()) &&  $timeBirthday < strtotime("-6 year", time()) ) {
            $this->birthday = $birthday;
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