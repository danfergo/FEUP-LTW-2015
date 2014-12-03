    <?php
    require_once (dirname(dirname(__FILE__)).'/db/users.php');
    require_once (dirname(dirname(__FILE__)).'/classes/user.php');
    require_once ('sessioning.php');

    /** manage session **/ 

    function user_login($email, $password) {
        if(session_exists()){
            throw new Exception('USER_ALREADY_LOGGED_IN');
        }

        $user = db_user_select_byemail($email);

        if ($user === false) {
            throw new Exception('EMAIL_IS_NOT_REGESTERED');
        } else if ($user->hasPassword($password)) {
            session_begin($user);
            return $user;
        } else {
            throw new Exception('INVALID_PASSWORD');
        }
    }


    function user_logout(){
        if(session_exists()){
            session_destroy();
        } else {
            throw new Exception('USER_NOT_LOGGED_IN');
        }
    }


    function user_who(){
        return session_exists() ? db_user_select_byid(session_userid()) : null;
    }

    /** manage account **/

    function user_register($name,$email,$password,$birthday){
       $user = new User();

       if (db_user_select_byemail($user->getEmail()) !== false) {
            throw new Exception('INVALID_EMAIL_ALREADY_EXISTS');
       }

       $user->setPassword($password);
       $user->setName($name);
       $user->setEmail($email);
       $user->setBirthday($birthday);

        return db_user_insert($user);
    }





    // update
    // delete

