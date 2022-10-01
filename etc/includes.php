<?php

// Include navbar in all pages expect pages include noNavBar
if (isset($pageTitle) && $pageTitle == "LOGIN") {

    
    include_once 'classes/database.php';
    include_once 'classes/soldiers.php';
    include_once 'classes/users.php';

} else {

    include_once '../classes/database.php';
    include_once '../classes/soldiers.php';
    include_once '../classes/users.php';

}