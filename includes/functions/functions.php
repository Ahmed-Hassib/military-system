<?php

/**
 * getTitle function v1.0.1
 * This function not accept parameters
 * Contain global variable can be access from anywhere
 * get title page from the page and display it
 */
function getTitle() {
    global $pageTitle; // page title
    // check if set or not
    if (isset($pageTitle)) {
        echo language("AUTOMATED 830 CENTER") . " | " . language($pageTitle);
    } else {
        echo 'Default';
    }
}

/**
 * redirectHome function v2
 * This function accepts parameters
 * $msg => echo the error message
 * $seconds => seconds before redirect
 */
function redirectHome($msg, $url = null, $seconds = 3) {
    // check the url
    if ($url == null) {
        $url = 'dashboard.php';
    } else {
        $url = isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'soldiers.php';
    }
    // redirect page
    header("refresh:$seconds;url=$url");
    // check if empty message
    if (!empty($msg)) {
        echo $msg;
    }
    // show redirect messgae
    echo "<div class='alert alert-info text-capitalize'>you will be redirect after $seconds seconds</div>";
    // exit
    exit();
}

/**
 * userInfo function v1
 * this function accepts 1 parameter
 * $info => the $_POST variable
 */
function userInfo($info) {
    $_SESSION['UserID']         = $info['id'];                  // assign userid to session
    $_SESSION['UserName']       = $info['username'];            // assign username to session
    $_SESSION['preivilidge']    = $info['privilidge'];          // assign privilidge to session 
    $_SESSION['lastLoginDate']  = $info['last_login_date'];     // assign last login date and time to session 
    $_SESSION['lastLoginTime']  = $info['last_login_time'];     // assign last login date and time to session 
    $_SESSION['isWelcomed']     = isset($_SESSION['isWelcomed']) && $_SESSION['isWelcomed'] == 1 ? 1 : 0;
    $_SESSION['systemLang']     = "ar"; 
}



/**
 * checkItems function v1
 * This function accept 3 parameter
 * $select => the item to select [Ex: User, Client, Piece]
 * $table => the table to select from [EX: users, Piece, Direction]
 * $value => the value of select [Ex: ahmed, DEV]
 */
function checkItem($select, $table, $value) {
    global $con;
    $statement = $con->prepare("SELECT $select FROM $table WHERE $select = ?");
    $statement->execute(array($value));
    $count = $statement->rowCount();

    // echo $count;
    return $count;
}

/**
 * countRecords function v2
 * This function used to count number of records in the specific table in database
 * This function accept parameters
 * $column => the column need to count
 * $table => table to count from
 */
function countRecords($column, $table, $condition = null) {
    global $con; // connection to database

    $stmt = $con->prepare("SELECT COUNT($column) FROM $table $condition");
    $stmt->execute();

    return $stmt->fetchColumn();
}

/**
 * getLatestRecord function v2
 * This function used to get latest record
 * $column => column to select
 * $table => table to choose from
 * $limit => number of record to select by default 5
 * $order => order the record debepds on the latest records
 */
function getLatestRecord($column, $table, $condition, $order, $limit = 5) {
    global $con; // connection to database
    // prepare query
    $stmt = $con->prepare("SELECT $column FROM $table $condition ORDER BY $order DESC LIMIT $limit");
    $stmt->execute(); // execute query
    $rows = $stmt->fetchAll(); // fetch all result
    return $rows; // return result
}

/**
 * getNextID function v1
 * This function is used to get next piece id
 */
function getNextID($table) {
    global $con; // connection to database
    // prepare query
    $stmt = $con->prepare("SELECT `AUTO_INCREMENT` AS 'AI' FROM `information_schema`.`TABLES` WHERE `TABLE_SCHEMA` = 'csoc' AND `TABLE_NAME` = '?';");
    $stmt->execute(array($table));
    $rows = $stmt->fetchColumn();
    return $rows;
}




/**
 * selectSpecificColumn function v1
 * This function is used to select specific column from specific table
 */
function selectSpecificColumn($column, $table, $condition) {
    global $con; // connection to database
    // prepare query
    $stmt = $con->prepare("SELECT $column FROM $table $condition");
    $stmt->execute(); // execute query
    $rows = $stmt->fetchAll(); // fetch all result
    return $rows; // return result
}

/**
 * backup function v1
 *
 */
function backup() {
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
    $mysqldump = $DOCUMENT_ROOT . "/csoc/includes/libraries/mysqldump/Mysqldump.php";
    $filename = $DOCUMENT_ROOT . "/csoc/data/backups/Database Backups/database_backup_".date("d_m_Y").".sql";
    // database name
    $dbname = 'jsl_db';
    $host   = "localhost";
    $user   = "root";
    $pass   = "@hmedH@ssib";
    $dns    = "mysql:host=$host;dbname=$dbname";

    include_once($mysqldump);
    
    try {
        // get the dump
        $dump = new Ifsnop\Mysqldump\Mysqldump($dns, $user, $pass);
        $dump->start($filename);
        // success flag
        echo true;
    } catch (\Exception $e) {
        echo 'mysqldump-php error: ' . $e->getMessage();
        echo false;
    }
}

/**
 * restoreBackup function v1
 * used to restore the backup
 * 
 */
function restoreBackup($file) {
    // set limit for execution process
    set_time_limit(5000);
    global $con; // connection to database
    // check if the file is exist or not 
    if (file_exists($file)) {
        // empty query
        $query = "";
        // try .. catch
        try {
            // open the file with read mode
            $handle = fopen($file, "r");
            // append the content to the query
            $query = fread($handle, filesize($file));
            // prepare the query
            $stmt = $con->prepare($query);
            // execute the query
            $stmt->execute();
            // echo true
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

/**
 * // createLogs function v1
 * accepts 2 param
 * $username => username of owner of the log
 * $msg      => log message
 * $type     => [1] info -> default case
 *              [2] warning
 *              [3] danger
 */
function createLogs($username, $msg, $type = 1) {
    // get type of log
    switch ($type) {
        case 1:
            $typeName = "info";
            break;
        case 2:
            $typeName = "warning";
            break;
        case 3:
            $typeName = "danger";
            break;
    }
    // log
    $log = "[" . $username . "@" . Date('d/m/Y h:ia') . " ~ " . $typeName . " msg]:" . $msg . ".\n";
    // location
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
    $fileLocation = $DOCUMENT_ROOT . "/jsl-network/data/log/";
    // check the fileLocation
    if (!file_exists($fileLocation) && !is_dir($fileLocation)) {
        mkdir($fileLocation);
    }
    $filename = "log-" . Date('Ymd') . "-" . Date('Ymd') . ".txt";
    $file = $fileLocation . $filename;
    // open file with append mode
    $handle = fopen($file, "aw+");
    // increase logs counter
    $_SESSION['logsCounter']++;
    // write in file
    fwrite($handle, $log);
    // close the file
    fclose($handle);
}


/**
 * updateSession function
 */
function updateSession() {
    if (!isset($_SESSION['UserID']) && empty($_SESSION['UserID'])):
        // start SESSION
        session_start();
    endif;
    global $con;
    $query = "SELECT *FROM `users` WHERE `users`.`UserID` = ? LIMIT 1";
            
    // check if user exist in database
    $stmt = $con->prepare($query);
    $stmt->execute(array($_SESSION['UserID']));
    $userInfo = $stmt->fetch();
    $count = $stmt->rowCount();

    // if count > 0 this mean that user exist
    if ($count > 0) {
        // send the result to the function to store it into SESSION variables....
        userInfo($userInfo);
    }
}


