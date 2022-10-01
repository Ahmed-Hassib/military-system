<?php


// Users class
class Users extends Database {

    /** PROPERTIES */
    public $id;
    public $username;
    public $password;
    public $con;
    
    /** METHODS */
    public function __construct($user, $pass) {
        // check username && password
        if (!empty($user) && !empty($pass)) {
            // DATABASE OBJECT FOR USE CONNECTION VARIUABLE TO PREPARE AND EXECUTE THE QUERIES
            $user_obj = new Database();
            $this->con = $user_obj->con;
            // set values of username and password
            $this->username = $user;
            $this->password = sha1($pass);
        }
    }

    // get user
    public function user_login() {
        # select user with specific id 
        $select_user = "SELECT *FROM `users` WHERE `username` = ? AND `password` = ? LIMIT 1";
        // check if user exist in database
        $stmt = $this->con->prepare($select_user);
        $stmt->execute(array($this->username, $this->password));
        $user_info = $stmt->fetch();
        $count = $stmt->rowCount();
        // check the count
        if ($count > 0) {
            return [true, $user_info];
        }
        return false;
    }


    
}