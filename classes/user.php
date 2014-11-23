    <?php

class User{
    private $userid;
    private $username;
    private $email;
    private $birthday;
    private $fullName;
    
    
    public function __construct($userid,$username,$email,$birthday,$fullName) {
        $this->userid = $userid;
        $this->username = $username;
        $this->email = $email;
        $this->birthday = $birthday;
        $this->fullName = $fullName;
    }
    
    
    public function toJSON(){
        $data = array(
            'userid' => $this->userid,
            'username' => $this->username,
            'full_name' => $this->fullName,
            'email' => $this->email,
            'birthay' => $this->birthday
            );
        return json_encode($data);
    }
    
}