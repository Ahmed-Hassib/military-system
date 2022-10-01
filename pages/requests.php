<?php
// include system configuration
include '../etc/conf.php';
// include functions file
include '../includes/functions/functions.php';
// check if Get request do is set or not
$query = isset($_GET['do']) ? $_GET['do'] : '';

// check if the $_GET is set
if ($query == 'backup') {
    if (isset($_GET['id'])) {
        // admin id => admin who is take the backup
        $id = intval($_GET['id']);
        // call backup function to take a backup
        backup($id);
    }
}