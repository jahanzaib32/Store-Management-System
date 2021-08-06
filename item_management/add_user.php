<?php

    session_start();

    $pageName = "Add Users";

include ("../common_functions/enable_error.php");
    include ("../common_functions/config.php");

    //session validation as admin
    if (!sessionValidation("admin")){
        header("Location: " . $domainName . "?ref=nosession");
    }
    
    $color = "green";
    $error = "";
    $conn = makeConn();

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        //echo "INSERT INTO items (name, description, sub_cata_id, store_id) VALUES ('" . $_POST['name'] . "', '" . $_POST['description'] . "', " . $_POST['sub_cata_id'] . ", " . $_POST['store_id'] . ")";
        $result = makeQuery($conn, "INSERT INTO users (name, email, pass, store_id) VALUES ('" . $_POST['name'] . "', '" . $_POST['mail'] . "', 'abc@123', '" . $_POST['store_id'] . "')");
        if ($result){
            $color ="green";
            $error = "User has been successfully added with default e-mail and password!";
        }else{
            $color ="red";
            $error = "There is a problem!";
        }
    }

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../report_style.css">
    <link rel="stylesheet" href="../item_mngmnt.css">
    
    <title><?php echo $pageName; ?> - <?php echo $appName; ?></title>
</head>
<body>
    <?php include("../common_html/admin/side_bar.php"); ?>
    <div class="mainBody" <?php echo $backgroundImage; ?>>
        <?php include ("../common_html/admin/header.php"); ?>

        <div class="wrapper hr_vr_center">
            <div class="note <?php echo $color; ?> <?php if ($_SERVER['REQUEST_METHOD'] == "POST"){echo 'visible';} else {echo "notVisible";} ?>">
            <?php echo $error; ?>
            </div>
            <div class="inlineSectors leftFloat">
                <div class="sector">
    
                    <div class="sectorForm">
                        <div class="sectorDescription">
                            Please enter user details below.
                        </div>
    
                        <form method="post">
                            Store ID:
                            <input type="text" name="store_id" required>
                            <br>
                            <br>
                            E-Mail Address:
                            <input type="text" name="mail" required>
                            <br>
                            <br>
                            Name:
                            <input type="text" name="name" required>
                            <br>
                            <br>
                            <input type="submit" class="submit_btn">
                        </form>
    
                    </div>
    
                </div>
            </div>
            <div class="inlineSectors rightFloat">
                <div class="sectorInstructions">
                    Users can't create their accouts by just regular register method. <br>Instead admin need to create them accounts.
                    <br>Every new user account will be created with a default password "abc@123".
                    <br>Upon loggin into the system for the first time. <br>User must have to change password in order to use system further.
                </div>
            </div>
        </div>
        

        <div class="footer">
            Copyright 2019, All right reserved!
        </div>
    </div>
</body>
</html>