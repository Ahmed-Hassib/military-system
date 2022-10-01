<?php
// start output buffering
ob_start();
// start session
session_start(); 
// page title
$pageTitle = "THE SOLDIERS";
// system configuration
include "../etc/init.php";
// check username in SESSION variable
if (isset($_SESSION['UserName'])) {
    // check if Get request do is set or not
    $query = isset($_GET['do']) ? $_GET['do'] : 'manage';
?>
    <?php if ($query == "manage") {                     // manage page ?>
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE SOLDIERS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- buttons to control soldiers -->
                <div class="mb-5">
                    <!-- add new unit button -->
                    <a href="?do=addNewSoldier" class="btn btn-outline-primary">
                        <?php echo language("ADD NEW SOLDIER", $_SESSION['systemLang']) ?>
                    </a>
                    <!-- show all soldiers button -->
                    <a href="?do=showAllSoldiers" class="btn btn-outline-primary">
                        <?php echo language("SHOW ALL SOLDIERS", $_SESSION['systemLang']) ?>
                    </a>
                </div>
                <!-- some statistics -->
                <div class="mb-5">
                    <?php 
                        # select all units
                        $unitsQ = "SELECT *FROM `units`";
                        $stmt = $con->prepare($unitsQ);     # prepare the query
                        $stmt->execute();                   # execute the query
                        $unitsRows = $stmt->fetchAll();     # fetch all units data
                        $unitsCount = $stmt->rowCount();    # get number of rows
                        # check number of rows
                        if ($unitsCount > 0) {
                    ?>
                    <header class="mb-2 header">
                        <h5 class="h5 text-capitalize"><?php echo language("SOME STATISTICS", $_SESSION['systemLang']) ?></h5>
                        <hr>
                    </header>
                    <div class="row row-cols-sm-2 row-cols-lg-6 g-3">
                        <?php foreach ($unitsRows as $unit) { ?>
                            <div class="col-sm-12">
                                <div class="card bg-gradient text-center">
                                    <div class="card-header">
                                        <h5 class="card-title"><?php echo $unit['unit_name_ar'] ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <?php 
                                                # number of soldiers in the current unit
                                                $soldiersCount = countRecords("`id`", "`soldier`", "WHERE `basic_unit` = ".$unit['unit_id']);
                                                # 
                                                echo $soldiersCount . " " . ($soldiersCount > 2 ? language("SOLDIERS", $_SESSION['systemLang']) : language("SOLDIER", $_SESSION['systemLang']) ) ?>
                                        </p>
                                        <a href="?do=showAllSoldiers&unitid=<?php echo $unit['unit_id'] ?>" class="stretched-link"></a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- end content -->
        </div>
    <?php } elseif ($query == "addNewSoldier") {           // add new Soldier page ?>
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE SOLDIERS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- start header -->
                <header class="header">
                    <h5 class="h5 text-capitalize"><?php echo language('ADD NEW SOLDIER', $_SESSION['systemLang']) ?></h5>
                    <hr>
                </header>
                <!-- end header -->
                <!-- start the form -->
                <div class="mb-5">
                    <form action="?do=insertNewSoldier" method="post" enctype="multipart/form-data" id="addNewSoldierForm">
                        <div class="row row-cols-sm-1 row-cols-lg-2 gx-5">
                            <!-- first column -->
                            <div class="mb-5 col-12">
                                <div class="section-header">
                                    <h5 class="h5"><?php echo language("PERSONAL INFO", $_SESSION['systemLang']) ?></h5>
                                    <hr>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="militiray-num"><?php echo language("MILITIRAY NUMBER", $_SESSION['systemLang']) ?></label>
                                    <input type="number" class="form-control" name="militiray-num" id="militiray-num" >
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="national-id"><?php echo language("NATIONAL ID", $_SESSION['systemLang']) ?></label>
                                    <input type="number" class="form-control" name="national-id" id="national-id" >
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="soldier-name"><?php echo language("NAME", $_SESSION['systemLang']) ?></label>
                                    <input type="text" class="form-control" name="soldier-name" id="soldier-name" >
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="soldier-address"><?php echo language("ADDRESS", $_SESSION['systemLang']) ?></label>
                                    <input type="text" class="form-control" name="soldier-address" id="soldier-address" >
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="qualification"><?php echo language("QUALIFICATION", $_SESSION['systemLang']) ?></label>
                                    <input type="text" class="form-control" name="qualification" id="qualification" >
                                </div>
                            </div>
                            <!-- second column -->
                            <div class="mb-5 col-12">
                                <div class="section-header">
                                    <h5 class="h5"><?php echo language("PERSONAL PHOTO", $_SESSION['systemLang']) ?></h5>
                                    <hr>
                                </div>
                                <div class="mb-5 mt-3 order-sm-5">
                                    <div class="position-relative text-center">
                                        <img src="../assets/user-icon.png" class="soldier-img" alt="">
                                        <div class="img-container bg-gradient">
                                            <input type="file" name="soldier-img" id="soldier-img" class="form-control" onchange="uploadSoldierImage(this)">
                                            <i class="bi bi-camera"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- forth column -->
                            <div class="mb-5 col-12">
                                <div class="section-header">
                                    <h5 class="h5"><?php echo language("FAMILY INFO", $_SESSION['systemLang']) ?></h5>
                                    <hr>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="soldier-religion"><?php echo language("RELIGION", $_SESSION['systemLang']) ?></label>
                                    <select class="form-select" name="soldier-religion" id="soldier-religion">
                                        <option value="" disabled selected><?php echo language("RELIGION", $_SESSION['systemLang']) ?></option>
                                        <option value="0"><?php echo language("MUSLIM", $_SESSION['systemLang']) ?></option>
                                        <option value="1"><?php echo language("CRISTEN", $_SESSION['systemLang']) ?></option>
                                    </select>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="soldier-status"><?php echo language("STATUS", $_SESSION['systemLang']) ?></label>
                                    <select class="form-select" name="soldier-status" id="soldier-status" onchange="showChild(this)">
                                        <option value="" disabled selected><?php echo language("STATUS", $_SESSION['systemLang']) ?></option>
                                        <option value="0"><?php echo language("SINGLE", $_SESSION['systemLang']) ?></option>
                                        <option value="1"><?php echo language("MARRIAGE", $_SESSION['systemLang']) ?></option>
                                    </select>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="number-child"><?php echo language("NUMBER OF CHILD", $_SESSION['systemLang']) ?></label>
                                    <input type="number" class="form-control" name="number-child" id="number-child" disabled>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="father-job"><?php echo language("FATHER JOB", $_SESSION['systemLang']) ?></label>
                                    <input type="text" class="form-control" name="father-job" id="father-job">
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="mother-job"><?php echo language("MOTHER JOB", $_SESSION['systemLang']) ?></label>
                                    <input type="text" class="form-control" name="mother-job" id="mother-job">
                                </div>
                            </div>
                            <!-- forth column -->
                            <div class="mb-5 col-12">
                                <div class="section-header">
                                    <h5 class="h5"><?php echo language("CONNECTION INFO", $_SESSION['systemLang']) ?></h5>
                                    <hr>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="soldier-phone1"><?php echo language("PHONE1", $_SESSION['systemLang']) ?></label>
                                    <input type="number" class="form-control" name="soldier-phone1" id="soldier-phone1" >
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="soldier-phone2"><?php echo language("PHONE2", $_SESSION['systemLang']) ?></label>
                                    <input type="number" class="form-control" name="soldier-phone2" id="soldier-phone2">
                                </div>
                            </div>
                            <!-- third column -->
                            <div class="col-12">
                                <div class="section-header">
                                    <h5 class="h5"><?php echo language("UNIT INFO/JOINED DATE/SPECIALIZATION", $_SESSION['systemLang']) ?></h5>
                                    <hr>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="basic-unit"><?php echo language("THE BASIC UNIT", $_SESSION['systemLang']) ?></label>
                                    <select class="form-select" name="basic-unit" id="basic-unit" >
                                        <?php
                                            # get all units
                                            $unitQ = "SELECT *FROM `units`";
                                            $stmt = $con->prepare($unitQ);
                                            $stmt->execute();
                                            $rows = $stmt->fetchAll();
                                            $counter = $stmt->rowCount()
                                            
                                            ?>
                                        <?php if ($counter > 0) { ?>
                                            <option disabled selected><?php echo language("THE BASIC UNIT", $_SESSION['systemLang']) ?></option>
                                            <?php foreach ($rows as $row) { ?>
                                              <option value="<?php echo $row['unit_id'] ?>"><?php echo $row['unit_name_ar']?></option>
                                              <?php } ?>
                                        <?php } else { ?>
                                            <option disabled selected><?php echo language("UNITS NOT ENTERED", $_SESSION['systemLang']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="current-unit"><?php echo language("THE CURRENT UNIT", $_SESSION['systemLang']) ?></label>
                                    <select class="form-select" name="current-unit" id="current-unit" >
                                        <?php
                                            # get all units
                                            $unitQ = "SELECT *FROM `units`";
                                            $stmt = $con->prepare($unitQ);
                                            $stmt->execute();
                                            $rows = $stmt->fetchAll();
                                            $counter = $stmt->rowCount()

                                            ?>
                                        <?php if ($counter > 0) { ?>
                                            <option disabled selected><?php echo language("THE CURRENT UNIT", $_SESSION['systemLang']) ?></option>
                                            <?php foreach ($rows as $row) { ?>
                                                <option value="<?php echo $row['unit_id']?>"><?php echo $row['unit_name_ar']?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option disabled selected><?php echo language("UNITS NOT ENTERED", $_SESSION['systemLang']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>  
                                <div class="mb-3 position-relative">
                                    <label for="specialization"><?php echo language("SPECIALIZATION", $_SESSION['systemLang']) ?></label>
                                    <select class="form-select" name="specialization" id="specialization" >
                                        <?php
                                            # get all specialization
                                            $specQ = "SELECT *FROM `specialization`";
                                            $stmt = $con->prepare($specQ);
                                            $stmt->execute();
                                            $rows = $stmt->fetchAll();
                                            $counter = $stmt->rowCount()
                                        ?>
                                        <?php if ($counter > 0) { ?>
                                            <option disabled selected><?php echo language("SPECIALIZATIONS", $_SESSION['systemLang']) ?></option>
                                            <?php foreach ($rows as $row) { ?>
                                                <option value="<?php echo $row['spec_id']?>"><?php echo $row['spec_name']?></option>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <option disabled selected><?php echo language("SPECIALIZATIONS NOT ENTERED", $_SESSION['systemLang']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="joined-date"><?php echo language("JOINED DATE", $_SESSION['systemLang']) ?></label>
                                    <input type="date" class="form-control" name="joined-date" id="joined-date" >
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="discharge-date"><?php echo language("DISCHARGE DATE", $_SESSION['systemLang']) ?></label>
                                    <input type="date" class="form-control" name="discharge-date" id="discharge-date" >
                                </div>
                            </div>
                            
                        </div>
                        <div class="my-5 row row-cols-sm-2">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary" form="addNewSoldierForm"><?php echo language("ADD NEW SOLDIER", $_SESSION['systemLang']) ?></button>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <!-- end the form -->
            </div>
            <!-- end content -->
        </div>
    <?php } elseif ($query == "insertNewSoldier") {        // insert page ?>
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE SOLDIERS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- start header -->
                <header class="header">
                    <h5 class="h5 text-capitalize"><?php echo language('ADD NEW SOLDIER', $_SESSION['systemLang']) ?></h5>
                    <hr>
                </header>
                <!-- <pre> -->
                <?php 
                    # check the request method
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        # print_r($_POST);    # text request
                        # print_r($_FILES);   # img request
                        # get soldier data
                        $photoInfo      = !empty($_FILES['soldier-img']) ? $_FILES['soldier-img'] : array();                    # soldier photo
                        $milNum         = intval(trim($_POST['militiray-num'], ' '));                                           # military number
                        $nationalId     = intval(trim($_POST['national-id'], ' '));                                             # national id
                        $name           = trim($_POST['soldier-name'], ' ');                                                    # soldier name
                        $addr           = trim($_POST['soldier-address'], ' ');                                                 # soldier address
                        $qualification  = trim($_POST['qualification'], ' ');                                                   # soldier qualification
                        $specialization = isset($_POST['specialization']) ? intval(trim($_POST['specialization'], ' ')) : 0;    # specialization
                        $basicUnit      = isset($_POST['basic-unit']) ? intval(trim($_POST['basic-unit'], ' ')) : 0;            # basic unit
                        $currentUnit    = isset($_POST['current-unit']) ? intval(trim($_POST['current-unit'], ' ')) : 0;        # current unit
                        $joinedDate     = trim($_POST['joined-date'], ' ');                                                     # joined date to current unit
                        $dischargeDate  = trim($_POST['discharge-date'], ' ');                                                  # discharge date of current unit
                        $phone1         = trim($_POST['soldier-phone1'], ' ');                                                  # soldier phone
                        $phone2         = trim($_POST['soldier-phone2'], ' ');                                                  # phone of the most relevant person to the soldier
                        $religion       = trim($_POST['soldier-religion'], ' ');                                                # relision
                        $status         = trim($_POST['soldier-status'], ' ');                                                  # status
                        $child          = isset($status) && $status != 0 ? trim($_POST['number-child'], ' ') : 0;               # number of child
                        $fatherJob      = trim($_POST['father-job'], ' ');                                                      # father`s job
                        $motherJob      = trim($_POST['mother-job'], ' ');                                                      # mother`s job


                        # error array
                        $errArray = array();

                        # check the soldier photo
                        if (empty($photoInfo) || $photoInfo['error'] > 0 || $photoInfo['size'] == 0) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("SOLDIER PHOTO CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier military number 
                        if (empty($milNum)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("MILITIRAY NUMBER CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }
                        
                        # check the soldier national id 
                        if (empty($nationalId)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("NATIONAL ID CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }
                        if (empty($nationalId) || strlen($nationalId) != 14) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("NATIONAL ID CANNOT BE LESS THAN 14 CHARACTER", $_SESSION['systemLang'])."</div>";
                        }
                        
                        # check the soldier name 
                        if (empty($name)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("NAME CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        } elseif (checkItem("`name`", "`soldier`", $name)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("THIS NAME IS EXIST", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier address
                        if (empty($addr)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("ADDRESS CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier qualification
                        if (empty($qualification)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("QUALIFICATION CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier basic unit
                        if (empty($specialization) || $specialization == 0) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("SPECIALIZATION CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier basic unit
                        if (empty($basicUnit) || $basicUnit == 0) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("BASIC UNIT CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier current unit
                        if (empty($currentUnit) || $currentUnit == 0) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("CURRENT UNIT CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier joined date
                        if (empty($joinedDate)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("JOINED DATE CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier discharge date
                        if (empty($dischargeDate)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("DISCHARGE DATE CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier phone
                        if (empty($phone1)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("ONE PHONE NUMBER IS REQUIRED", $_SESSION['systemLang'])."</div>";
                        }

                        # check the errArray if empty
                        if (empty($errArray)) {
                            # insert query
                            $insertQuery = "";
                            # get photo info
                            $photoName  = $photoInfo['name'];
                            $photoType  = $photoInfo['type'];
                            $photoTmp   = $photoInfo['tmp_name'];
                            $photoError = $photoInfo['error'];
                            $photoSize  = $photoInfo['size'];
                            # values of photos to insert
                            $updatePhoto = "";
                            # check photo array
                            if (!empty($photoName)) {
                                # get new soldier id
                                $soldierId = getNextID("`soldier`");
                                # code...
                                $arrName = explode('.', $photoName);
                                $photoExtension = strtolower(end($arrName));
                                # add the date of day and malfunction id to the photo name
                                $updatePhoto = strtoupper($photoExtension) . "_". Date('Ymd') . "_" . $nationalId . "." . $photoExtension;
                                # move photo into upload directory
                                move_uploaded_file($photoTmp, $uploads."//soldiers//".$updatePhoto);
                            }   

                            # insert query
                            $insertQuery = "INSERT INTO `soldier`(`name`, `address`, `phone1`, `phone2`, `militiry_number`, `national_id`, `basic_unit`, `current_unit`, `qualification`, `specialization`, `joined_date`, `discharge_date`, `status`, `num_child`, `father_job`, `mother_job`, `religion`, `current_img_name`, `img_name`, `type`, `temp_name`, `error`, `img_size`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                            # insert into the database soldier info
                            $stmt = $con->prepare($insertQuery);
                            $stmt->execute(array($name, $addr, $phone1, $phone2, $milNum, $nationalId, $basicUnit, $currentUnit, $qualification, $specialization, $joinedDate, $dischargeDate, $status, $child, $fatherJob, $motherJob, $religion, $updatePhoto, $photoName, $photoType, $photoTmp, $photoError, $photoSize));


                            # echo success message
                            $msg = '<div class="alert alert-success text-capitalize">'.language("SOLDIER ADDED SUCCESSFULLY", $_SESSION['systemLang']).'</div>';
                            # time of show the alert
                            $time = 3;
                        } else {
                            # loop on error to display it
                            foreach ($errArray as $err) {
                                echo $err;
                            }
                            # error message
                            $msg = '<div class="alert alert-danger text-capitalize">'.language("ONE OR MORE FIELDS ARE REQUIRED", $_SESSION['systemLang']).'</div>';
                            # time of show the alert
                            $time = 10;
                        }
                        # redirect to home page
                        redirectHome($msg, 'back', $time);
                    } else { 
                        $msg = '<div class="alert alert-warning text-capitalize">'.language('YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE').'</div>';
                        redirectHome($msg); // redirect to home page 
                    }
                ?>
            </div>
        </div>
    <?php } elseif ($query == "editSoldier") {          // edit page ?>
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE SOLDIERS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- start header -->
                <header class="header">
                    <h5 class="h5 text-capitalize"><?php echo language('EDIT SOLDIER INFO', $_SESSION['systemLang']) ?></h5>
                    <hr>
                </header>
                <!-- end header -->
                <?php
                    # get soldier id
                    $soldierId = isset($_GET['soldierid']) && !empty($_GET['soldierid']) ? $_GET['soldierid'] : 0;
                    // create an object from Soldiers class
                    $sol_obj = new Soldiers();
                    # check if soldier id exist or not
                    $isExist = $sol_obj->is_exist($soldierId);                   
                    # check if exist
                    if ($isExist > 0) {
                        # get soldier data
                        $soldier = $sol_obj->get_soldier($soldierId);
                ?>
                        <!-- start the form -->
                        <div class="mb-5">
                            <form action="?do=updateSoldier" method="post" enctype="multipart/form-data" id="editSoldierForm">
                                <div class="row row-cols-sm-1 row-cols-lg-2 gx-5">
                                    <!-- first column -->
                                    <div class="mb-5 col-12">
                                        <div class="section-header">
                                            <h5 class="h5"><?php echo language("PERSONAL INFO", $_SESSION['systemLang']) ?></h5>
                                            <hr>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <input type="hidden" class="form-control" name="soldier-id" id="soldier-id" value="<?php echo $soldier['id'] ?>">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="militiray-num"><?php echo language("MILITIRAY NUMBER", $_SESSION['systemLang']) ?></label>
                                            <input type="number" class="form-control" name="militiray-num" id="militiray-num" value="<?php echo $soldier['militiry_number'] ?>">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="national-id"><?php echo language("NATIONAL ID", $_SESSION['systemLang']) ?></label>
                                            <input type="number" class="form-control" name="national-id" id="national-id" value="<?php echo $soldier['national_id'] ?>">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="soldier-name"><?php echo language("NAME", $_SESSION['systemLang']) ?></label>
                                            <input type="text" class="form-control" name="soldier-name" id="soldier-name" value="<?php echo $soldier['name'] ?>">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="soldier-address"><?php echo language("ADDRESS", $_SESSION['systemLang']) ?></label>
                                            <input type="text" class="form-control" name="soldier-address" id="soldier-address" value="<?php echo $soldier['address'] ?>">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="qualification"><?php echo language("QUALIFICATION", $_SESSION['systemLang']) ?></label>
                                            <input type="text" class="form-control" name="qualification" id="qualification" value="<?php echo $soldier['qualification'] ?>">
                                        </div>
                                    </div>
                                    <!-- second column -->
                                    <div class="mb-5 col-12">
                                        <div class="section-header">
                                            <h5 class="h5"><?php echo language("PERSONAL PHOTO", $_SESSION['systemLang']) ?></h5>
                                            <hr>
                                        </div>
                                        <div class="mb-5 mt-3 order-sm-5">
                                            <div class="position-relative text-center">
                                                <?php if (!empty($soldier['current_img_name'])) { ?>
                                                    <img src="<?php echo $uploads . "soldiers/". $soldier['current_img_name'] ?>" class="soldier-img" alt="soldier image">
                                                <?php } else { ?>
                                                        <img src="<?php echo $assets ?>user-icon.png" class="soldier-img" alt="soldier image not assigned">
                                                <?php } ?>
                                                <div class="img-container bg-gradient">
                                                    <input type="file" name="soldier-img" id="update-soldier-img" class="form-control" onchange="uploadSoldierImage(this)">
                                                    <i class="bi bi-camera"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- forth column -->
                                    <div class="mb-5 col-12">
                                        <div class="section-header">
                                            <h5 class="h5"><?php echo language("FAMILY INFO", $_SESSION['systemLang']) ?></h5>
                                            <hr>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="soldier-religion"><?php echo language("RELIGION", $_SESSION['systemLang']) ?></label>
                                            <select class="form-select" name="soldier-religion" id="soldier-religion">
                                                <option value="" disabled selected><?php echo language("RELIGION", $_SESSION['systemLang']) ?></option>
                                                <option value="0" <?php echo $soldier['religion'] == 0 ? 'selected' : '' ?>><?php echo language("MUSLIM", $_SESSION['systemLang']) ?></option>
                                                <option value="1" <?php echo $soldier['religion'] == 1 ? 'selected' : '' ?>><?php echo language("CRISTEN", $_SESSION['systemLang']) ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="soldier-status"><?php echo language("STATUS", $_SESSION['systemLang']) ?></label>
                                            <select class="form-select" name="soldier-status" id="soldier-status" onchange="showChild(this)">
                                                <option value="" disabled selected><?php echo language("STATUS", $_SESSION['systemLang']) ?></option>
                                                <option value="0" <?php echo $soldier['status'] == 0 ? 'selected' : '' ?>><?php echo language("SINGLE", $_SESSION['systemLang']) ?></option>
                                                <option value="1" <?php echo $soldier['status'] == 1 ? 'selected' : '' ?>><?php echo language("MARRIAGE", $_SESSION['systemLang']) ?></option>
                                            </select>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="number-child"><?php echo language("NUMBER OF CHILD", $_SESSION['systemLang']) ?></label>
                                            <input type="number" class="form-control" name="number-child" id="number-child" value="<?php echo $soldier['status'] == 1 ? $soldier['num_child'] : '' ?>" <?php echo $soldier['status'] == 0 ? 'disabled' : '' ?>>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="father-job"><?php echo language("FATHER JOB", $_SESSION['systemLang']) ?></label>
                                            <input type="text" class="form-control" name="father-job" id="father-job" value="<?php echo $soldier['father_job'] ?>" >
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="mother-job"><?php echo language("MOTHER JOB", $_SESSION['systemLang']) ?></label>
                                            <input type="text" class="form-control" name="mother-job" id="mother-job" value="<?php echo $soldier['mother_job'] ?>" >
                                        </div>
                                    </div>
                                    <!-- forth column -->
                                    <div class="mb-5 col-12">
                                        <div class="section-header">
                                            <h5 class="h5"><?php echo language("CONNECTION INFO", $_SESSION['systemLang']) ?></h5>
                                            <hr>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="soldier-phone1"><?php echo language("PHONE1", $_SESSION['systemLang']) ?></label>
                                            <input type="number" class="form-control" name="soldier-phone1" id="soldier-phone1" value="<?php echo $soldier['phone1'] ?>">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="soldier-phone2"><?php echo language("PHONE2", $_SESSION['systemLang']) ?></label>
                                            <input type="number" class="form-control" name="soldier-phone2" id="soldier-phone2" value="<?php echo $soldier['phone2'] ?>">
                                        </div>
                                    </div>
                                    <!-- third column -->
                                    <div class="col-12">
                                        <div class="section-header">
                                            <h5 class="h5"><?php echo language("UNIT INFO/JOINED DATE/SPECIALIZATION", $_SESSION['systemLang']) ?></h5>
                                            <hr>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="basic-unit"><?php echo language("THE BASIC UNIT", $_SESSION['systemLang']) ?></label>
                                            <select class="form-select" name="basic-unit" id="basic-unit" >
                                                <?php
                                                    # get all units
                                                    $unitQ = "SELECT *FROM `units`";
                                                    $stmt = $con->prepare($unitQ);
                                                    $stmt->execute();
                                                    $rows = $stmt->fetchAll();
                                                    $counter = $stmt->rowCount()  
                                                ?>
                                                <?php if ($counter > 0) { ?>
                                                    <option disabled selected><?php echo language("THE BASIC UNIT", $_SESSION['systemLang']) ?></option>
                                                    <?php foreach ($rows as $row) { ?>
                                                    <option value="<?php echo $row['unit_id'] ?>" <?php echo $soldier['basic_unit'] == $row['unit_id'] ? 'selected' : '' ?> ><?php echo $row['unit_name_ar']?></option>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <option disabled selected><?php echo language("UNITS NOT ENTERED", $_SESSION['systemLang']) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="current-unit"><?php echo language("THE CURRENT UNIT", $_SESSION['systemLang']) ?></label>
                                            <select class="form-select" name="current-unit" id="current-unit" >
                                                <?php
                                                    # get all units
                                                    $unitQ = "SELECT *FROM `units`";
                                                    $stmt = $con->prepare($unitQ);
                                                    $stmt->execute();
                                                    $rows = $stmt->fetchAll();
                                                    $counter = $stmt->rowCount()

                                                    ?>
                                                <?php if ($counter > 0) { ?>
                                                    <option disabled selected><?php echo language("THE CURRENT UNIT", $_SESSION['systemLang']) ?></option>
                                                    <?php foreach ($rows as $row) { ?>
                                                        <option value="<?php echo $row['unit_id']?>" <?php echo $soldier['current_unit'] == $row['unit_id'] ? 'selected' : '' ?>><?php echo $row['unit_name_ar']?></option>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <option disabled selected><?php echo language("UNITS NOT ENTERED", $_SESSION['systemLang']) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>  
                                        <div class="mb-3 position-relative">
                                            <label for="specialization"><?php echo language("SPECIALIZATION", $_SESSION['systemLang']) ?></label>
                                            <select class="form-select" name="specialization" id="specialization" >
                                                <?php
                                                    # get all specialization
                                                    $specQ = "SELECT *FROM `specialization`";
                                                    $stmt = $con->prepare($specQ);
                                                    $stmt->execute();
                                                    $rows = $stmt->fetchAll();
                                                    $counter = $stmt->rowCount()
                                                ?>
                                                <?php if ($counter > 0) { ?>
                                                    <option disabled selected><?php echo language("SPECIALIZATIONS", $_SESSION['systemLang']) ?></option>
                                                    <?php foreach ($rows as $row) { ?>
                                                        <option value="<?php echo $row['spec_id']?>" <?php echo $soldier['specialization'] == $row['spec_id'] ? 'selected' : '' ?>><?php echo $row['spec_name']?></option>
                                                    <?php } ?>
                                                    <?php } else { ?>
                                                    <option disabled selected><?php echo language("SPECIALIZATIONS NOT ENTERED", $_SESSION['systemLang']) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="joined-date"><?php echo language("JOINED DATE", $_SESSION['systemLang']) ?></label>
                                            <input type="date" class="form-control" name="joined-date" id="joined-date" value="<?php echo $soldier['joined_date'] ?>">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label for="discharge-date"><?php echo language("DISCHARGE DATE", $_SESSION['systemLang']) ?></label>
                                            <input type="date" class="form-control" name="discharge-date" id="discharge-date" value="<?php echo $soldier['discharge_date'] ?>">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="my-5 row row-cols-sm-1 g-5">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary"><?php echo language("EDIT SOLDIER INFO", $_SESSION['systemLang']) ?></button>
                                        <!-- delete soldier button -->
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteSoldierModal" data-target="delete" data-unit-id="<?php echo $unit['unit_id'] ?>" data-name-ar="<?php echo $unit['unit_name_ar'] ?>" data-name-en="<?php echo $unit['unit_name_en'] ?>" onclick="putDataUnitModal(this)">
                                            <?php echo language("DELETE SOLDIER INFO", $_SESSION['systemLang']) ?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end the form -->
                <?php } else {
                    # error message
                    $msg = '<div class="alert alert-warning text-capitalize">'.language('THERE IS NO ID LIKE THAT', $_SESSION['systemLang']).'</div>';
                    # redirect to the previous page
                    redirectHome($msg);
                } ?>
            </div>
        </div>
    <?php } elseif ($query == "updateSoldier") {        // update the profile ?>
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE SOLDIERS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- start header -->
                <header class="header">
                    <h5 class="h5 text-capitalize"><?php echo language('EDIT SOLDIER INFO', $_SESSION['systemLang']) ?></h5>
                    <hr>
                </header>
                <!-- end header -->
                <?php 
                    # check the request method
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        # get soldier data
                        $id             = isset($_POST['soldier-id']) ? intval(trim($_POST['soldier-id'], ' ')) : 0;                                           # military number
                        $photoInfo      = !empty($_FILES['soldier-img']) ? $_FILES['soldier-img'] : array();                    # soldier photo
                        $milNum         = intval(trim($_POST['militiray-num'], ' '));                                           # military number
                        $nationalId     = intval(trim($_POST['national-id'], ' '));                                             # national id
                        $name           = trim($_POST['soldier-name'], ' ');                                                    # soldier name
                        $addr           = trim($_POST['soldier-address'], ' ');                                                 # soldier address
                        $qualification  = trim($_POST['qualification'], ' ');                                                   # soldier qualification
                        $specialization = isset($_POST['specialization']) ? intval(trim($_POST['specialization'], ' ')) : 0;    # specialization
                        $basicUnit      = isset($_POST['basic-unit']) ? intval(trim($_POST['basic-unit'], ' ')) : 0;            # basic unit
                        $currentUnit    = isset($_POST['current-unit']) ? intval(trim($_POST['current-unit'], ' ')) : 0;        # current unit
                        $joinedDate     = trim($_POST['joined-date'], ' ');                                                     # joined date to current unit
                        $dischargeDate  = trim($_POST['discharge-date'], ' ');                                                  # discharge date of current unit
                        $phone1         = trim($_POST['soldier-phone1'], ' ');                                                  # soldier phone
                        $phone2         = trim($_POST['soldier-phone2'], ' ');                                                  # phone of the most relevant person to the soldier
                        $religion       = trim($_POST['soldier-religion'], ' ');                                                # relision
                        $status         = trim($_POST['soldier-status'], ' ');                                                  # status
                        $child          = isset($status) && $status != 0 ? trim($_POST['number-child'], ' ') : 0;               # number of child
                        $fatherJob      = trim($_POST['father-job'], ' ');                                                      # father`s job
                        $motherJob      = trim($_POST['mother-job'], ' ');                                                      # mother`s job


                        # error array
                        $errArray = array();
                        # check if the photo is changed
                        $isChanged = 0;

                        # check if id is exist or not
                        if (checkItem("`id`", "`soldier`", $id) == 0) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("THERE IS NO ID LIKE THAT", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier photo
                        if (!empty($photoInfo) && ($photoInfo['error'] == 0 || $photoInfo['size'] > 0)) {
                            $isChanged = 1;
                        }

                        # check the soldier military number 
                        if (empty($milNum)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("MILITIRAY NUMBER CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }
                        
                        # check the soldier national id 
                        if (empty($nationalId)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("NATIONAL ID CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }
                        if (empty($nationalId) || strlen($nationalId) != 14) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("NATIONAL ID CANNOT BE LESS THAN 14 CHARACTER", $_SESSION['systemLang'])."</div>";
                        }
                        
                        # check the soldier name 
                        if (empty($name)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("NAME CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        } elseif (selectSpecificColumn("`name`", "`soldier`", "WHERE `id` != " . $id)[0]['name'] == $name) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("THIS NAME IS EXIST", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier address
                        if (empty($addr)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("ADDRESS CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier qualification
                        if (empty($qualification)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("QUALIFICATION CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier basic unit
                        if (empty($specialization) || $specialization == 0) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("SPECIALIZATION CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier basic unit
                        if (empty($basicUnit) || $basicUnit == 0) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("BASIC UNIT CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier current unit
                        if (empty($currentUnit) || $currentUnit == 0) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("CURRENT UNIT CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier joined date
                        if (empty($joinedDate)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("JOINED DATE CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier discharge date
                        if (empty($dischargeDate)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("DISCHARGE DATE CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }

                        # check the soldier phone
                        if (empty($phone1)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("ONE PHONE NUMBER IS REQUIRED", $_SESSION['systemLang'])."</div>";
                        }

                        # executable array
                        $executableArr = array();
                        # check the errArray if empty
                        if (empty($errArray)) {
                            # update query
                            $updateQuery = "UPDATE `soldier` SET `name` = ?, `address` = ?, `phone1` = ?, `phone2` = ?, `militiry_number` = ?, `national_id` = ?, `basic_unit` = ?, `current_unit` = ?, `qualification` = ?,`specialization` = ?,`joined_date` = ?,`discharge_date` = ?,`status` = ?,`num_child` = ?,`father_job` = ?,`mother_job` = ?,`religion` = ? ";
                            # executable array
                            array_push($executableArr, $name, $addr, $phone1, $phone2, $milNum, $nationalId, $basicUnit, $currentUnit, $qualification, $specialization, $joinedDate, $dischargeDate, $status, $child, $fatherJob, $motherJob, $religion);
                            # check if photo is changed
                            if ($isChanged == 1) {
                                # get photo info
                                $photoName  = $photoInfo['name'];
                                $photoType  = $photoInfo['type'];
                                $photoTmp   = $photoInfo['tmp_name'];
                                $photoError = $photoInfo['error'];
                                $photoSize  = $photoInfo['size'];
                                # values of photos to insert
                                $updatePhoto = "";
                                # check photo array
                                if (!empty($photoName)) {
                                    # get new soldier id
                                    $soldierId = getNextID("`soldier`");
                                    # code...
                                    $arrName = explode('.', $photoName);
                                    $photoExtension = strtolower(end($arrName));
                                    # add the date of day and malfunction id to the photo name
                                    $updatePhoto = strtoupper($photoExtension) . "_". Date('Ymd') . "_" . $nationalId . "." . $photoExtension;
                                    # move photo into upload directory
                                    move_uploaded_file($photoTmp, $uploads."//soldiers//".$updatePhoto);
                                    # append the new data of photo 
                                    $updateQuery .= ", `current_img_name` = ?, `img_name` = ?, `type` = ?, `temp_name` = ?, `error` = ?, `img_size` = ?";
                                    # executable array
                                    array_push($executableArr, $updatePhoto, $photoName, $photoType, $photoTmp, $photoError, $photoSize);
                                }   
                            }
                            # push soldier id
                            array_push($executableArr, $id);
                            # append the condittion to the query
                            $updateQuery .= " WHERE `id` = ?";
                            # prepare the query
                            $stmt = $con->prepare($updateQuery);
                            $stmt->execute($executableArr);
                            # success message
                            $msg = '<div class="alert alert-success text-capitalize">'.language('SOLDIER UPDATED SUCCESSFULLY').'</div>';
                            # redirect to home page
                            redirectHome($msg, "back");
                        } else {
                            # loop on error to display it
                            foreach ($errArray as $err) {
                                echo $err;
                            }
                            # redirect to home page
                            redirectHome(""); 
                        }
                    } else { 
                        $msg = '<div class="alert alert-warning text-capitalize">'.language('YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE').'</div>';
                        # redirect to home page
                        redirectHome($msg); 
                    }
                ?>
            </div>
        </div>
    <?php } elseif ($query == "deleteSoldier") {        // delete soldier ?>
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE SOLDIERS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- start header -->
                <header class="header">
                    <h5 class="h5 text-capitalize"><?php echo language('DELETE SOLDIER INFO', $_SESSION['systemLang']) ?></h5>
                    <hr>
                </header>
                <!-- end header -->
                <?php 
                    # check the form method
                    # check the request method
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        # get soldier id
                        $soldier_id = isset($_POST['soldierid']) && !empty($_POST['soldierid']) ? $_POST['soldierid'] : 0;
                        # create a object from soldiers class
                        $soldier_obj = new Soldiers();
                        # check if soldier is exist
                        if ($soldier_obj->is_exist($soldier_id)) {
                            # delete soldier info
                            $is_deleted = $soldier_obj->delete_soldier($soldier_id);
                            # check if deleted
                            if ($is_deleted) {
                                $msg = '<div class="alert alert-success text-capitalize">'.language('SOLDIER DELETED SUCCESSFULLY', $_SESSION['systemLang']).'</div>';
                            } else {
                                $msg = '<div class="alert alert-warning text-capitalize">'.language('THERE IS A PROBLEM TO EXECUTE THE QUERY IN DATABASE', $_SESSION['systemLang']).'</div>';
                            }
                        } else {
                            $msg = '<div class="alert alert-warning text-capitalize">'.language('THERE IS NO ID LIKE THAT', $_SESSION['systemLang']).'</div>';
                        }
                    } else {
                        $msg = '<div class="alert alert-warning text-capitalize">'.language('YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE', $_SESSION['systemLang']).'</div>';
                    }
                    # redirect to the previous page
                    redirectHome($msg, '');
                ?>
            </div>
        </div>
    <?php } elseif ($query == "showAllSoldiers") {        // delete soldier ?>
        <?php $unitid = isset($_GET['unitid']) && !empty($_GET['unitid']) ? $_GET['unitid'] : 0; ?>
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE SOLDIERS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- start header -->
                <header class="header">
                    <h5 class="h5 text-capitalize"><?php echo language('SHOW ALL SOLDIERS', $_SESSION['systemLang']) ?></h5>
                    <hr>
                </header>
                <!-- end header -->
                <?php
                    # select all units
                    $q = "SELECT *FROM `soldier` " . ($unitid != 0 ? "WHERE `basic_unit` = ".$unitid : '') . " ORDER BY `basic_unit` ASC";
                    $stmt = $con->prepare($q);      # prepare thequery
                    $stmt->execute();               # execute the query
                    $soldiersRow = $stmt->fetchAll();      # fetch the query
                    $count = $stmt->rowCount();     # count all records
                ?>
                <?php if ($count > 0) { ?>
                    <!-- second row -->
                    <table class="mt-3 table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <!-- <th scope="col" class="text-center"><?php echo language("AVATAR", $_SESSION['systemLang']) ?></th> -->
                                <th scope="col" class="text-center"><?php echo language("MILITIRAY NUMBER", $_SESSION['systemLang']) ?></th>
                                <th scope="col" class="text-center"><?php echo language("SOLDIER NAME", $_SESSION['systemLang']) ?></th>
                                <th scope="col" class="text-center"><?php echo language("JOINED DATE", $_SESSION['systemLang']) ?></th>
                                <th scope="col" class="text-center"><?php echo language("DISCHARGE DATE", $_SESSION['systemLang']) ?></th>
                                <th scope="col" class="text-center"><?php echo language("SPECIALIZATION", $_SESSION['systemLang']) ?></th>
                                <th scope="col" class="text-center"><?php echo language("THE BASIC UNIT", $_SESSION['systemLang']) ?></th>
                                <th scope="col" class="text-center" style="width: 150px"><?php echo language("CONTROL", $_SESSION['systemLang']) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 0; ?>
                            <?php foreach ($soldiersRow as $soldier) { ?>
                                <tr class="text-center">
                                    <td><?php echo ++$counter ?></td>
                                    <!-- <td><img style="width: 40px; height: 40px" src="<?php echo $uploads ?>soldiers/<?php echo $soldier['photo'] ?>" alt=""></td> -->
                                    <td>
                                        <a href="?do=editSoldier&soldierid=<?php echo $soldier['id'] ?>">
                                            <?php echo $soldier['militiry_number'] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="?do=editSoldier&soldierid=<?php echo $soldier['id'] ?>">
                                            <?php echo $soldier['name'] ?>
                                        </a>
                                    </td>
                                    <td><?php echo $soldier['joined_date'] ?></td>
                                    <td><?php echo $soldier['discharge_date'] ?></td>
                                    <td><?php echo selectSpecificColumn("`spec_name`", "`specialization`", "WHERE `spec_id` = ".$soldier['specialization'])[0]['spec_name'] ?></td>
                                    <td><?php echo selectSpecificColumn("`unit_name_ar`", "`units`", "WHERE `unit_id` = ".$soldier['basic_unit'])[0]['unit_name_ar'] ?></td>
                                    <td>
                                        <!-- edit soldier button -->
                                        <a href="?do=editSoldier&soldierid=<?php echo $soldier['id'] ?>" type="button" class="btn btn-outline-primary rounded-circle">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <!-- delete soldier button -->
                                        <button type="button" class="btn btn-danger rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteSoldierModal" data-target="delete" data-unit-id="<?php echo $unit['unit_id'] ?>" data-name-ar="<?php echo $unit['unit_name_ar'] ?>" data-name-en="<?php echo $unit['unit_name_en'] ?>" onclick="putDataUnitModal(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="alert alert-info bg-gradient">
                        <?php if ($unitid != 0) { ?>
                            <p class="lead"><?php echo language("THERE IS NO SOLDIERS IN THIS UNIT TO SHOW", $_SESSION['systemLang']) ?></p>
                        <?php } else { ?>
                            <p class="lead"><?php echo language("THERE IS NO SOLDIERS TO SHOW", $_SESSION['systemLang']) ?></p>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } elseif ($query == "updateSpecialization") {        // update specialization ?>
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE SOLDIERS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- start header -->
                <header class="header">
                    <h5 class="h5 text-capitalize"><?php echo language('EDIT SPECIALIZATION', $_SESSION['systemLang']) ?></h5>
                    <hr>
                </header>
                <!-- end header -->
                <?php
                    // print_r($_POST);
                    # operation message
                    $msg = "";
                    # check the request method
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        # get specialization name
                        $spec_id     = isset($_POST['specialization-id']) && !empty($_POST['specialization-id']) ? trim($_POST['specialization-id'], ' ') : 0;
                        $spec_name   = isset($_POST['specialization-new']) && !empty($_POST['specialization-new']) ? trim($_POST['specialization-new'], ' ') : '';
                        # array of error
                        $errArray = array();

                        # check id if exist
                        if (checkItem("`spec_id`", "`specialization`", $spec_id) > 0) {
                            if (empty($spec_name)) {
                                $errArray[] = "<div class='alert alert-danger text-capitalize'>".language("SPECIALIZATION CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                            } 
                            if (!empty($spec_name) && countRecords("`spec_id`", "`specialization`", "WHERE `spec_id` != $spec_id AND `spec_name` = '$spec_name'") > 0) {
                                $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("SPECIALIZATION ALREADY EXIST", $_SESSION['systemLang'])."</div>";
                            }
    
                            # echo error array
                            if (empty($errArray)) {
                                # the query
                                $q = "UPDATE `specialization` SET `spec_name` = ? WHERE `spec_id` = ?;";
                                $stmt = $con->prepare($q);
                                $stmt->execute(array($spec_name, $spec_id));
                                # echo success message
                                $msg = '<div class="alert alert-success text-capitalize">'.language("SPECIALIZATION UPDATED SUCCESSFULLY", $_SESSION['systemLang']).'</div>';
                            } else {
                                # loop on error to display it
                                foreach ($errArray as $err) {
                                    echo $err;
                                }
                            }
                        } else {
                            $msg = '<div class="alert alert-warning text-capitalize">'.language('THERE IS NO ID LIKE THAT', $_SESSION['systemLang']).'</div>';
                        }
                    } else {
                        $msg = '<div class="alert alert-warning text-capitalize">'.language('YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE', $_SESSION['systemLang']).'</div>';
                    }
                    # redirect to the previous page
                    redirectHome($msg, 'back');
                ?>
            </div>
        </div>
    <?php } elseif ($query == "insertSpecialization") {        // add new specialization ?>
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE SOLDIERS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- start header -->
                <header class="header">
                    <h5 class="h5 text-capitalize"><?php echo language('ADD NEW SPECIALIZATION', $_SESSION['systemLang']) ?></h5>
                    <hr>
                </header>
                <!-- end header -->
                <?php
                    # operation message
                    $msg = "";
                    # check the request method
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        # get specialization name
                        $spec_name = isset($_POST['specialization']) ? trim($_POST['specialization'], ' ') : '';
                        # array of error
                        $errArray = array();
                        # check the name 
                        if (empty($spec_name)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("SPECIALIZATION CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }
                        # echo error array
                        if (empty($errArray)) {
                            # the query
                            $q = "INSERT INTO `specialization` (`spec_name`) VALUES (?);";
                            $stmt = $con->prepare($q);
                            $stmt->execute(array($spec_name));
                            # echo success message
                            $msg = '<div class="alert alert-success text-capitalize">'.language("SPECIALIZATION ADDED SUCCESSFULLY", $_SESSION['systemLang']).'</div>';
                        } else {
                            # loop on error to display it
                            foreach ($errArray as $err) {
                                echo $err;
                            }
                        }
                    } else {
                        $msg = '<div class="alert alert-warning text-capitalize">'.language('YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE').'</div>';
                    }
                    # redirect to the previous page
                    redirectHome($msg, 'back');
                ?>
            </div>
        </div>
    <?php } elseif ($query == "deleteSpecialization") {        // delete specialization ?>
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE SOLDIERS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- start header -->
                <header class="header">
                    <h5 class="h5 text-capitalize"><?php echo language("DELETE SPECIALIZATION", $_SESSION['systemLang']) ?></h5>
                    <hr>
                </header>
                <!-- end header -->
                <?php
                    # operation message
                    $msg = "";
                    # check the request method
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        # get specialization id
                        $spec_id = isset($_POST['specialization-id']) ? trim($_POST['specialization-id'], ' ') : '';
                        # array of error
                        $errArray = array();
                        # check the name 
                        if (empty($spec_id)) {
                            $errArray[] = "<div class='alert alert-warning text-capitalize'>".language("SPECIALIZATION ID CANNOT BE EMPTY", $_SESSION['systemLang'])."</div>";
                        }
                        # echo error array
                        if (empty($errArray)) {
                            # the query
                            $q = "DELETE FROM `specialization` WHERE `spec_id` = ?;";
                            $stmt = $con->prepare($q);
                            $stmt->execute(array($spec_id));
                            # echo success message
                            $msg = '<div class="alert alert-success text-capitalize">'.language("SPECIALIZATION DELETED SUCCESSFULLY", $_SESSION['systemLang']).'</div>';
                        } else {
                            # loop on error to display it
                            foreach ($errArray as $err) {
                                echo $err;
                            }
                        }
                    } else {
                        $msg = '<div class="alert alert-warning text-capitalize">'.language('YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE').'</div>';
                    }
                    # redirect to the previous page
                    redirectHome($msg, 'back');
                ?>
            </div>
        </div>
    <?php } else { ?>
        <!-- start edit profile page -->
        <div class="mt-5 container">
            <!-- start header -->
            <header class="header">
                <h4 class="h4">
                    <?php $msg = '<div class="alert alert-warning text-capitalize">'.language('THERE IS NO PAGE WITH THIS NAME').'</div>'; ?>
                    <?php redirectHome($msg); // redirect to home page ?>
                </h4>
            </header>
        </div>
    <?php } ?>
<?php } else { ?>
    <!-- start edit profile page -->
    <div class="mt-5 container">
        <!-- start header -->
        <header class="header">
            <h4 class="h4">
                <?php $msg = '<div class="alert alert-warning text-capitalize">'.language('YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE').'</div>'; ?>
                <?php redirectHome($msg); // redirect to home page ?>
            </h4>
        </header>
    </div>
<?php } ?>
<?php
    include $tpl . "footer.php"; 
    include $tpl . "modals.php";
    include $tpl . "js-includes.php";

    ob_end_flush();
?>