<?php
// start output buffering
ob_start();
// start session
session_start();

// system configuration
include "../etc/init.php";

// logout msg in log file
// log message
$msg = "logout from system";
createLogs($_SESSION['UserName'], $msg);

// unset all data session
session_unset();

// destroy all data session
session_destroy();

// redirect to the login page
header('Location: ../index.php');

// output flush
ob_end_flush();

// exit
exit();
