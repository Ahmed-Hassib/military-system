<?php

// Database class
class Database extends PDO {

    /** PROPERTIES */
    protected $db_name;
    protected $dsn;
    protected $username;
    protected $password;
    public $con;


    /** CONSTANT */
    const OPTIONS = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);


    /** METHODS */
    // constructor
    public function __construct ($name = "csoc", $user =  "root", $pass = "@hmedH@ssib") {
        if (!$this->check_param($name) && !$this->check_param($user) && !$this->check_param($pass)) {
            $this->db_name  = $name;
            $this->dsn      = "mysql:host=localhost;dbname=$this->db_name";
            $this->username = $user;
            $this->password = $pass;
            $this->con = new PDO($this->dsn, $this->username, $this->password, self::OPTIONS);
        }
    }

    // check_prop function
    // -- used to check if the param is empty or not
    // -- return true if prop is empty
    // -- return false if prop is not empty
    public function check_param($param) {
        if (empty($param)) {
            return true;
        }
        return false;
    }

    // db_connect function
    // -- used to connect to the specific database
    public function db_connection() {
        if ($this->check_param($this->db_name) && $this->check_param($this->dsn) && $this->check_param($this->username) && $this->check_param($this->password)) {
            try {
                $this->con = new PDO($this->dsn, $this->username, $this->password, self::OPTIONS);
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // success message
                // echo "YOU ARE CONNECTED, WELCOME TO DATABASE";
            } catch (PDOException $e) {
                echo "Failed To Connect " . $e->getMessage();
            }
        }
    }



}