<?php

    session_start();

    $pageName = "Add Item Quantity";

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
        $result = makeQuery($conn, "INSERT INTO items (name, description, sub_cata_id, store_id) VALUES ('" . $_POST['name'] . "', '" . $_POST['description'] . "', " . $_POST['sub_cata_id'] . ", '" . $_POST['store_id'] . "')");
        if ($result){
            $color ="green";
            $error = "Item has been successfully added!";
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
                            Please enter the main category name and press submit.
                        </div>
    
                        <form method="post">
                            Store ID:
                            <input type="text" name="store_id" required>
                            <br>
                            <br>
                            Name:
                            <input type="text" name="name" required>
                            <br>
                            <br>
                            Category Name:
                            <select name="sub_cata_id">
                                <?php 
                                    makeOption($conn, "SELECT * FROM `sub_carta`", "name", "ID");
                                ?>
                            </select>
                            <br>
                            <br>
                            Item Description:
                            <br>
                            <br>
                            <textarea name="description" style="width: 550px; height: 150px;"></textarea>
                            <br>
                            <br>
                            <input type="submit" class="submit_btn">
                        </form>
    
                    </div>
    
                </div>
            </div>
            <div class="inlineSectors rightFloat">
                <div class="sectorInstructions">
                    You can add an item to the database. <br>Here is the list of already added items/products. <br>You can't add same product twice.
                    <br>
                    <br>
                    <ul>
                        <?php
                            makeLis($conn, "SELECT * FROM `items`", "name", "li");
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        

        <div class="footer">
            Copyright 2019, All right reserved!
        </div>
    </div>
</body>
</html>