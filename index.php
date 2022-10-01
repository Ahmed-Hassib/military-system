<?php
// start output buffering
ob_start();
// start session
session_start(); 

// check username in SESSION variable
if (isset($_SESSION['UserName'])) {
    header('Location: pages/soldiers.php');  // redirect to admin page
    exit();
}

// no navbar
$noNavBar = "";
// title page
$pageTitle = "LOGIN";

// include system file
include "etc/init.php";

// check if user comming from http request ..
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get request info
    $username   = $_POST["username"];
    $pass       = $_POST["pass"];
    
    // check username && password
    if (!empty($username) && !empty($pass)) {
        // create object from Users class
        $user_obj = new Users($username, $pass);
        // get the user
        $is_exist = $user_obj->user_login()[0];
        $user_info = $user_obj->user_login()[1];
        // if count > 0 this mean that user exist
        if ($is_exist != false) {
            // save user info into session
            userInfo($user_info);
            // reset error variables
            $_SESSION['loginError'] = 0;
            $_SESSION['passwordError'] = 0;
            $_SESSION['usernameError'] = 0;
            // update last login date and time
            $lastLoginUpdate = $con->prepare("UPDATE `users` SET `last_login_date` = CURRENT_DATE, `last_login_time` = CURRENT_TIME WHERE `id` = ?");
            $lastLoginUpdate->execute(array($_SESSION['UserID']));
            // redirect to dashboard page
            header('Location: pages/soldiers.php');
            exit();
        } else {
            $_SESSION['loginError'] = 1;
        }
    } elseif (empty($username) && empty($pass)) {
        $_SESSION['usernameError'] = 1;
        $_SESSION['passwordError'] = 1;
    } elseif (empty($username)) {
        $_SESSION['usernameError'] = 1;
    } elseif (empty($pass)) {
        $_SESSION['passwordError'] = 1;
    }
} 
?>

<div class="loginPageContainer">
    <div class="contentBox">
        <div class="formBox">
            <!-- <?php echo sha1("admincsoc") ?> -->
            <!-- login form avatar -->
            <div class="formBoxAvatar">
                <i class="bi bi-person-circle"></i>
                <!-- <img src="<?php echo $assets?>air-defence-logo-2.png" alt=""> -->
            </div>
            <!-- login form -->
            <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="mb-4">
                    <label class="mb-2" for="username"><?php echo language('USERNAME') ?></label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                </div>
                <div class="mb-4 position-relative login">
                    <label class="mb-2" for="password"><?php echo language('PASSWORD') ?></label>
                    <input type="password" class="form-control" id="password" name="pass">
                    <i class="bi bi-eye-slash show-pass text-dark" id="show-pass" onclick="showPass(this)"></i>
                </div>
                <div class="mb-4 position-relative">
                    <button type="submit" class="btn w-100" ><?php echo language('LOGIN') ?></button>
                </div>
                <div class="mb-4">
                    <?php if (isset($_SESSION['usernameError']) && $_SESSION['usernameError'] == 1) { ?>
                        <?php $_SESSION['usernameError'] = 0 ?>
                        <div class='alert alert-danger text-capitalize' role="alert">
                            <?php echo language("USERNAME IS REQUIRED") ?>
                            <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['passwordError']) && $_SESSION['passwordError'] == 1) { ?>
                        <?php $_SESSION['passwordError'] = 0 ?>
                        <div class='alert alert-danger text-capitalize' role="alert">
                            <?php echo language("PASSWORD IS REQUIRED") ?>
                            <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['loginError']) && $_SESSION['loginError'] == 1) { ?>
                        <?php $_SESSION['loginError'] = 0 ?>
                        <div class='alert alert-danger text-capitalize' role="alert">
                            <?php echo language("USERNAME OR PASSWORD IS WRONG") ?>
                            <button type="button" class="btn-close btn-close-alert" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <div class="hero-image"></div> -->

<?php 
    // include $tpl . "footer.php"; 
    include $tpl . "js-includes.php";
?>