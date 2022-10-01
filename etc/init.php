<?php

// connect to database from configration file
include 'conf.php';

// company name
$companyName = "jsl network";

// Routes

// check if this login page
if (isset($pageTitle) && $pageTitle == "LOGIN") {
    $upLevel = "";
} else {
    $upLevel = "../";
}


$classes    = $upLevel . "classes/";                    // Classes Directory
$tpl        = $upLevel . "includes/templates/";         // Template Directory
$lan        = $upLevel . "includes/languages/";         // Languages Directory
$func       = $upLevel . "includes/functions/";         // Functions Directory
$lib        = $upLevel . "includes/libraries/";         // Libraries Directory
$css        = $upLevel . "layout/css/";                 // CSS Directory
$js         = $upLevel . "layout/js/";                  // JS Directory
$node       = $upLevel . "layout/node_modules/";        // JS Directory
$assets     = $upLevel . "assets/";                     // Assets Directory
$data       = $upLevel . "data/";                       // Data Directory
$uploads    = $data . "uploads/";                       // Uploads Directory
$backups    = $data . "backups/";                       // Backups Directory


// Include the important files
include $func   . "functions.php";
include $lan    . "language.php";
include $tpl    . "header.php";


// Include navbar in all pages expect pages include noNavBar
if (!isset($noNavBar)) {
    include $tpl . "navbar.php";
}
