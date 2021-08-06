<?php 

    session_start();    
    
    include ("../common_functions/enable_error.php");
    include ("../common_functions/config.php");
    
    //check user session
    if (!sessionValidation("user")){
        header("Location: " . $domainName . "?ref=nosession");
    }

    
    $pageName = "Requisition Form";
    $conn = makeConn();
    $userID = $_SESSION["userID"];

    $setClass = "";
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../report_style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300&display=swap" rel="stylesheet">
    
    <title><?php echo $pageName; ?> - <?php echo $appName; ?></title>
</head>
<body>
    <?php include("../common_html/user/side_bar.php"); ?>

    <div class="mainBody">
        <?php include ("../common_html/user/header.php"); ?>
        
        <?php
            echo file_get_contents("../requisition_form.html");
        ?>

        <div class="footer">
            Copyright 2019, All right reserved!
        </div>
    </div>
    
</body>
</html>