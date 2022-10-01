<?php
// start output buffering
ob_start();
// start session
session_start(); 
// title page
$pageTitle = "DASHBOARD";
// check username in SESSION variable
if (isset($_SESSION['UserName'])) {
    // start dashboard page
    // initial configration of system
    include "../etc/init.php";
?>

    <!-- start home content container -->
    <div class="container">
        <!-- start header -->
        <header class="header">
            <h2 class="h2 text-capitalize"><?php echo language('DASHBOARD', $_SESSION['systemLang']) ?></h2>
            <hr>
        </header>
        <!-- end header -->
        <!-- start content -->
        <div class="content">
            <?php if($_SESSION['isWelcomed'] == 0) { ?>
                <div class="mb-4">
                    <div class='alert alert-info bg-gradient text-capitalize' role="alert">
                        <?php echo language("HI", $_SESSION['systemLang']). " " .$_SESSION['UserName']." ".language("WELCOME BACK", $_SESSION['systemLang']) ?>
                        <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php $_SESSION['isWelcomed'] = 1; ?>
                </div>
            <?php } ?>
        </div>
        <!-- end content -->
    </div>
    <!-- end dashboard page -->



<?php
    // footer
    include $tpl . "footer.php"; 
    include $tpl . "modals.php";
    include $tpl . "js-includes.php";
} else {
    header("Location: ../index.php");
    exit();
}

ob_end_flush();
?>