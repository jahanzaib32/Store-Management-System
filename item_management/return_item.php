<?php

    session_start();

    $pageName = "Return Item";

include ("../common_functions/enable_error.php");
    include ("../common_functions/config.php");

    //session validation as admin
    if (!sessionValidation("admin")){
        header("Location: " . $domainName . "?ref=nosession");
    }
    
    $color = "green";
    $error = "";
    $conn = makeConn();

    //create query constraints if user has been set in get method

    if (isset($_GET['user'])){
        //Items issued to a user with item_id, user_id, qty, name (item)
        $selectItems = "SELECT items.ID AS item_id, users.ID AS user_id, items.name, SUM(issued.qty) AS qty FROM issued INNER JOIN users ON issued.user_id = users.ID INNER JOIN items ON issued.item_id = items.ID AND users.ID = " . $_GET['user'] . " GROUP BY items.name";
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        if (issuedQty($conn, $_GET['user'], $_POST['item_id']) >= $_POST['qty']){
            // issued right quantity
            //reduce quantity and add to the log
            $addQuantity = makeQuery($conn, "UPDATE items SET qty=qty+" . $_POST['qty'] . " WHERE ID=" . $_POST['item_id'] . ""); 
            $addLog = makeQuery($conn, "INSERT INTO returned (item_id, user_id, qty) VALUES (" . $_POST['item_id'] . "," . $_GET['user'] . "," . $_POST['qty'] . ");");
            if ($addQuantity && $addLog){
                $color ="green";
                $error = "Returned item has been successfully added!";
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
            <div class="note">
                Note: You must select a user who have returned an item.<br>
                Please select user: 
                <select name="user_id" onchange="if (this.value) window.location.href= 'return_item.php?user='+ this.value">
                    <option <?php if(!isset($_GET['user'])){ echo "selected"; } ?>disabled>Select a user</option>
                    <?php 
                        makeOption($conn, "SELECT * FROM `users`", "name", "ID", "option", $_GET['user']);
                    ?>
                </select>
            </div>
            <div class="inlineSectors leftFloat">
                <div class="sector">
    
                    <div class="sectorForm">
                        <div class="sectorDescription">
                            Please enter the main category name and press submit.
                        </div>
    
                        <form method="post">
                            Returned Item:
                            <select name="item_id">
                                <?php 
                                if (isset($_GET['user'])){
                                    makeOption($conn, $selectItems, "name", "item_id");
                                }else{
                                    echo "<option disabled selected>No user has been seleted!</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <br>
                            Quantity:
                            <input type="text" name="qty" required>
                            <br>
                            <br>
                            
                            <input type="submit" class="submit_btn">
                        </form>
    
                    </div>
    
                </div>
            </div>
            <div class="inlineSectors rightFloat">
                <div class="sectorInstructions">
                    You can add the returned item to the system in following way:
                    <ul>
                        <li>Select a user from the drop down menu.</li>
                        <li>Select product and enter the quantity retruned by user</li>
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