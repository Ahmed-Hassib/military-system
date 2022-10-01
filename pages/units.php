<?php
// start output buffering
ob_start();
// start session
session_start(); 
// page title
$pageTitle = "THE UNITS";
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
                <h2 class="h2 text-capitalize"><?php echo language('THE UNITS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <!-- first row -->
                <div class="mb-5 row row-cols-sm-2 row-cols-lg-5 g-3">
                    <div class="col-6">
                        <!-- add new unit button -->
                        <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#addNewUnitModal" data-target="add">
                            <?php echo language("ADD NEW UNIT", $_SESSION['systemLang']) ?>
                        </button>
                    </div>
                </div>
                <!-- some statistics -->
                <div class="mb-5">
                    <header class="mb-2 header">
                        <h5 class="h5 text-capitalize"><?php echo language("ALL THE UNITS", $_SESSION['systemLang']) ?></h5>
                        <hr>
                    </header>
                    
                    <?php
                        # select all units
                        $q = "SELECT *FROM `units`";
                        $stmt = $con->prepare($q);      # prepare thequery
                        $stmt->execute();               # execute the query
                        $unitsRows = $stmt->fetchAll();      # fetch the query
                        $count = $stmt->rowCount();     # count all records
                    ?>
                    <?php if ($count > 0) { ?>
                        <div class="search-box row row-cols-sm-1">
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <input type="text" class="form-control w-100" name="search" id="search" placeholder="ابحث هنا" onkeyup="tableFiltration(this, 'unitsName')">
                                </div>
                            </div>
                        </div>
                        <!-- second row -->
                        <table class="mt-3 table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center"><?php echo language("UNIT NAME IN ARABIC", $_SESSION['systemLang']) ?></th>
                                    <th scope="col" class="text-center"><?php echo language("UNIT NAME IN ENGLISH", $_SESSION['systemLang']) ?></th>
                                    <th scope="col" class="text-center"><?php echo language("NUMBER OF SOLDIERS", $_SESSION['systemLang']) ?></th>
                                    <th scope="col" class="text-center" style="width: 200px"><?php echo language("CONTROL", $_SESSION['systemLang']) ?></th>
                                </tr>
                            </thead>
                            <tbody id="unitsName">
                                <?php $counter = 0; ?>
                                <?php foreach ($unitsRows as $unit) { ?>
                                    <tr class="text-center">
                                        <td><?php echo ++$counter ?></td>
                                        <td><?php echo $unit['unit_name_ar'] ?></td>
                                        <td><?php echo $unit['unit_name_en'] ?></td>
                                        <td><?php echo countRecords("`id`", "`soldier`", "WHERE `basic_unit` = " . $unit['unit_id']) ?></td>
                                        <td>
                                            <!-- show soldiers of this unit button -->
                                            <a href="soldiers.php?do=showAllSoldiers&unitid=<?php echo $unit['unit_id'] ?>" class="btn btn-outline-primary rounded-circle" title="<?php echo language("SHOW ALL SOLDIERS", $_SESSION['systemLang']) ?>">
                                                <i class="mt-2 bi bi-eye"></i>
                                            </a>
                                            <!-- edit unit button -->
                                            <button type="button" class="btn btn-outline-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editUnitModal" data-target="edit" data-unit-id="<?php echo $unit['unit_id'] ?>" data-name-ar="<?php echo $unit['unit_name_ar'] ?>" data-name-en="<?php echo $unit['unit_name_en'] ?>" onclick="putDataUnitModal(this)" title="<?php echo language("EDIT THE UNIT", $_SESSION['systemLang']) ?>">
                                                <i class="mt-2 bi bi-pencil"></i>
                                            </button>
                                            <!-- delete unit button -->
                                            <button type="button" class="btn btn-danger rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteUnitModal" data-target="delete" data-unit-id="<?php echo $unit['unit_id'] ?>" data-name-ar="<?php echo $unit['unit_name_ar'] ?>" data-name-en="<?php echo $unit['unit_name_en'] ?>" onclick="putDataUnitModal(this)" title="<?php echo language("DELETE THE UNIT", $_SESSION['systemLang']) ?>">
                                                <i class="mt-2 bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="alert alert-info fe-bold">
                            <?php echo language("THERE IS NO UNITS TO SHOW", $_SESSION['systemLang']) ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- end content -->
        </div>

        <!-- EDIT UNIT MODAL -->
        <div class="modal fade" id="editUnitModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel"><?php echo language("EDIT THE UNIT", $_SESSION['systemLang']) ?> - <span class="text-decoration-underline" id="unit-name"></span></h5>
                    </div>
                    <div class="modal-body">
                        <form action="?do=updateUnit" method="post" id="editUnitForm">
                            <input type="hidden" name="unit-id" id="unit-id" required>
                            <div class="mb-3">
                                <label for="unit-name-ar" class="form-label"><?php echo language("UNIT NAME IN ARABIC", $_SESSION['systemLang']) ?></label>
                                <input type="text" class="form-control" name="unit-name-ar" id="unit-name-ar" required>
                            </div>
                            <div class="mb-3">
                                <label for="unit-name-en" class="form-label"><?php echo language("UNIT NAME IN ENGLISH", $_SESSION['systemLang']) ?></label>
                                <input type="text" class="form-control" name="unit-name-en" id="unit-name-en">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
                        <button type="submit" class="btn btn-primary" form="editUnitForm"><?php echo language("SAVE CHANGES", $_SESSION['systemLang']) ?></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- EDIT UNIT MODAL -->
        <div class="modal fade" id="deleteUnitModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel"><?php echo language("DELETE THE UNIT", $_SESSION['systemLang']) ?> - <span class="text-decoration-underline" id="unit-name"></span></h5>
                    </div>
                    <div class="modal-body">
                        <form action="?do=deleteUnit" method="post" id="deleteUnitForm">
                            <input type="hidden" name="unit-id" id="unit-id" data-no-astrisk="true" required>
                            <div class="mb-3">
                                <h5 class="h5 text-capitalize"><?php echo language("ARE YOU SURE TO DELETE THIS UNIT?", $_SESSION['systemLang']) ?></h5>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo language("CLOSE", $_SESSION['systemLang']) ?></button>
                        <button type="submit" class="btn btn-danger" form="deleteUnitForm"><?php echo language("DELETE UNIT", $_SESSION['systemLang']) ?></button>
                    </div>
                </div>
            </div>
        </div>
    <?php } elseif ($query == "insertUnit") {        // insert page ?>
         <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE UNITS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <?php
                    # check if the rquest method => POST
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        # declare an error array to store in it if exits 
                        $errArray = array();
                        # and unit-name is set
                        # and unit-name is not empty
                        if (isset($_POST['unit-name-ar']) && !empty($_POST['unit-name-ar'])) {
                            # get unit name
                            $unitNameAr = trim($_POST['unit-name-ar'], ' ');
                            $unitNameEn = isset($_POST['unit-name-en']) ? trim($_POST['unit-name-en'], ' ') : "";
                            # check if name is exist before 
                            if (checkItem("`unit_name_ar`", "`units`", $unitNameAr) > 0 || checkItem("`unit_name_en`", "`units`", $unitNameEn) > 0) {
                                $errArray[] = '<div class="alert alert-danger text-capitalize">'.language("UNIT NAME IS EXIST BEFORE", $_SESSION['systemLang']).'</div>';
                            }
                        } else {
                            $errArray[] = '<div class="alert alert-danger text-capitalize">'.language("UNIT NAME CANNOT BE EMPTY", $_SESSION['systemLang']).'</div>';
                        }

                        # query status message
                        $msg = "";

                        # check if error array is empty or not
                        if (empty($errArray)) {
                            # insert query
                            $insertQuery = "INSERT INTO `units` (`unit_name_ar`, `unit_name_en`) VALUES (?, ?)";
                            $insertStmt = $con->prepare($insertQuery);
                            $insertStmt->execute(array($unitNameAr, $unitNameEn));
                            # sucess message
                            $msg = '<div class="alert alert-success text-capitalize">'.language("UNIT ADDED SUCESSFULLY", $_SESSION['systemLang']).'</div>';
                        } else {
                            # if error array not empty => display errors
                            foreach ($errArray as $err) {
                                echo $err;
                            }
                        }
                    } else {
                        # error message 
                        $msg = '<div class="alert alert-danger text-capitalize">'.language("YOU CANNOT ACCESS THIS PAGE DIRECTLY", $_SESSION['systemLang']).'</div>';   
                    }
                    # redirect to previous page
                    redirectHome($msg, "back");
                ?>
            </div>
            <!-- end content -->
        </div>
    <?php } elseif ($query == 'updateUnit') {        // update the profile ?>
         <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE UNITS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <header class="header">
                    <h5 class="h5 text-capitalize"><?php echo language("EDIT UNIT", $_SESSION['systemLang']) ?></h5>
                    <hr>
                </header>
                <?php
                    # check if the rquest method => POST
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        # declare an error array to store in it if exits 
                        $errArray = array();
                        # and unit-name is set
                        # and unit-name is not empty
                        if (isset($_POST['unit-id']) && !empty($_POST['unit-id']) && isset($_POST['unit-name-ar']) && !empty($_POST['unit-name-ar'])) {
                            # get unit name
                            $unitId     = trim($_POST['unit-id'], ' ');
                            $unitNameAr = trim($_POST['unit-name-ar'], ' ');
                            $unitNameEn = isset($_POST['unit-name-en']) ? trim($_POST['unit-name-en'], ' ') : "";
                            # check if the new values are exist or not
                            if (countRecords("`unit_id`", "`units`", "WHERE `unit_name_ar` = '".$unitNameAr."' AND  `unit_id` != ".$unitId) > 0 || countRecords("`unit_id`", "`units`", "WHERE `unit_name_en` = '".$unitNameEn."' AND  `unit_id` != ".$unitId) > 0) {
                                $errArray[] = '<div class="alert alert-danger text-capitalize">'.language("UNIT NAME IS EXIST BEFORE", $_SESSION['systemLang']).'</div>';
                            }
                        } else {
                            $errArray[] = '<div class="alert alert-danger text-capitalize">'.language("UNIT NAME CANNOT BE EMPTY", $_SESSION['systemLang']).'</div>';
                        }

                        # query status message
                        $msg = "";

                        # check if error array is empty or not
                        if (empty($errArray)) {
                            # insert query
                            $insertQuery = "UPDATE `units` SET `unit_name_ar` = ?, `unit_name_en` = ? WHERE `unit_id` = ?";
                            $insertStmt = $con->prepare($insertQuery);
                            $insertStmt->execute(array($unitNameAr, $unitNameEn, $unitId));
                            # sucess message
                            $msg = '<div class="alert alert-success text-capitalize">'.language("UNIT UPDATED SUCESSFULLY", $_SESSION['systemLang']).'</div>';
                        } else {
                            # if error array not empty => display errors
                            foreach ($errArray as $err) {
                                echo $err;
                            }
                        }
                    } else {
                        # error message 
                        $msg = '<div class="alert alert-danger text-capitalize">'.language("YOU CANNOT ACCESS THIS PAGE DIRECTLY", $_SESSION['systemLang']).'</div>';   
                    }
                    # redirect to previous page
                    redirectHome($msg, "back");
                ?>
            </div>
            <!-- end content -->
        </div>
    <?php } elseif ($query == 'deleteUnit') {        // delete Unit ?>
         <div class="container">
            <!-- start header -->
            <header class="header">
                <h2 class="h2 text-capitalize"><?php echo language('THE UNITS', $_SESSION['systemLang']) ?></h2>
                <hr>
            </header>
            <!-- end header -->
            <!-- start content -->
            <div class="content">
                <?php
                    # check if the rquest method => POST
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        # declare an error array to store in it if exits 
                        $errArray = array();
                        # and unit-name is set
                        # and unit-name is not empty
                        if (isset($_POST['unit-id']) && !empty($_POST['unit-id'])) {
                            # get unit name
                            $unitId     = trim($_POST['unit-id'], ' ');
                            
                            # check if the id is exist or not
                            if (checkItem("`unit_id`", "`units`", $unitId) == 0) {
                                $errArray[] = '<div class="alert alert-danger text-capitalize">'.language("UNIT NAME IS EXIST BEFORE", $_SESSION['systemLang']).'</div>';
                            }
                        } else {
                            $errArray[] = '<div class="alert alert-danger text-capitalize">'.language("UNIT NAME CANNOT BE EMPTY", $_SESSION['systemLang']).'</div>';
                        }

                        # query status message
                        $msg = "";

                        # check if error array is empty or not
                        if (empty($errArray)) {
                            # delete query
                            $deleteQuery = "DELETE FROM `units` WHERE `unit_id` = ?";
                            $deleteStmt = $con->prepare($deleteQuery);
                            $deleteStmt->execute(array($unitId));
                            # sucess message
                            $msg = '<div class="alert alert-success text-capitalize">'.language("UNIT DELETED SUCESSFULLY", $_SESSION['systemLang']).'</div>';
                        } else {
                            # if error array not empty => display errors
                            foreach ($errArray as $err) {
                                echo $err;
                            }
                        }
                    } else {
                        # error message 
                        $msg = '<div class="alert alert-danger text-capitalize">'.language("YOU CANNOT ACCESS THIS PAGE DIRECTLY", $_SESSION['systemLang']).'</div>';   
                    }
                    # redirect to previous page
                    redirectHome($msg, "back");
                ?>
            </div>
            <!-- end content -->
        </div>
    <?php } else { ?>
        <!-- start edit profile page -->
        <div class="container">
            <!-- start header -->
            <header class="header">
                <h4 class="h4">
                    <?php $msg = '<div class="alert alert-warning text-capitalize">' . language('THERE IS NO PAGE WITH THIS NAME', $_SESSION['systemLang']) . '</div>'; ?>
                    <?php redirectHome($msg); // redirect to home page ?>
                </h4>
            </header>
        </div>
    <?php } ?>
<?php } else { ?>
    <!-- start edit profile page -->
    <div class="container">
        <!-- start header -->
        <header class="header">
            <h4 class="h4">
                <?php $msg = '<div class="alert alert-warning text-capitalize">' . language('YOU DON`T HAVE THE PERMISSION TO ACCESS THIS PAGE') . '</div>'; ?>
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