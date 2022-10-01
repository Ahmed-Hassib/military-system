
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getTitle(); ?></title>

    <!-- css files -->
    <link rel="stylesheet" href="<?php echo $node; ?>bootstrap-icons/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="<?php echo $node; ?>animate.css/animate.css"> -->
    <!-- <link rel="stylesheet" href="<?php echo $css; ?>jquery-ui.css"> -->
    <link rel="stylesheet" href="<?php echo $css; ?>jquery.selectBoxIt.css">
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $css; ?>backend.css">

    <!-- page icon -->
    <link rel="icon" href="<?php echo $assets ?>air-defence-logo-2.png">

    <style>
        <?php if ($_SESSION['systemLang'] == "ar") { ?>
            .dropdown-item {
                text-align: right;
            }
        <?php } ?>
    </style>
</head>

<body>