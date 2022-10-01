<?php

// include all outer files
include_once 'includes.php';

// database info
$dbname     = "csoc";
$user       = "root";
$pass       = "@hmedH@ssib";

// initiate database object
$db_obj = new Database($dbname, $user, $pass);

// connect to database
$db_obj->db_connection();

// connection to database variable which will be use in the application
$con = $db_obj->con;



