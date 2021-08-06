<?php

    session_start();

    $pageName = "Issue Item";

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

        if (itemQty($conn, $_POST['item_id']) >= $_POST['qty']){
            // issued right quantity
            //reduce quantity and add to the log
            $result = makeQuery($conn, "UPDATE items SET qty=qty-" . $_POST['qty'] . " WHERE ID=" . $_POST['item_id'] . ""); 
            $result = makeQuery($conn, "INSERT INTO issued (item_id, user_id, qty, register_no, page_no) VALUES (" . $_POST['item_id'] . "," . $_POST['user_id'] . "," . $_POST['qty'] . ", " . $_POST['register_no'] . ", " . $_POST['page_no'] . ");");
            if ($result){
                $color ="green";
                $error = "Item has been successfully added!";
            }else{
                $color ="red";
                $error = "There is a problem!" . $conn->error;
            }


        }else{
            // error

            $color = "red";
            $error = "There is quantity mismatch error";
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
                            Please enter the main category name and press submit.
                        </div>
    
                        <form method="post">
                            Item Issued:
                            <select name="item_id">
                                <?php 
                                    makeOption($conn, "SELECT * FROM `items` WHERE qty > 0", "name", "ID");
                                ?>
                            </select>
                            <br>
                            <br>
                            User:
                            <select name="user_id">
                                <?php 
                                    makeOption($conn, "SELECT * FROM `users`", "name", "ID");
                                ?>
                            </select>
                            <br>
                            <br>
                            Quantity:
                            <input type="text" name="qty" required>
                            <br>
                            <br>
                            Register No:
                            <input type="text" name="register_no" required>
                            <br>
                            <br>
                            Page No:
                            <input type="text" name="page_no" required>
                            <br>
                            <br>
                            <input type="submit" class="submit_btn">
                        </form>
    
                    </div>
    
                </div>
            </div>
            <div class="inlineSectors rightFloat">
                <div class="sectorInstructions">
                    Issue item to a registered user.
                    <br><b>Note: Item can be issued to only the registered user.</b>
                    <br>If you don't have a user registered please make sure to register.
                </div>
            </div>
        </div>
        

        <div class="footer">
            Copyright 2019, All right reserved!
        </div>
    </div>
</body>
</html>