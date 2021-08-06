<?php
    session_start();

    $pageName = "Add Catagory";


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
        //echo "INSERT INTO sub_carta (name, main_cata_id) VALUES ('" . $_POST['cata_name'] . "', " . $_POST['isReturnable'] . ")";
        $result = makeQuery($conn, "INSERT INTO sub_carta (name, main_cata_id) VALUES ('" . $_POST['cata_name'] . "', " . $_POST['isReturnable'] . ")");
        if ($result){
            $color ="green";
            $error = "Category has been successfully added to system";
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
                            Category Name:
                            <input type="text" name="cata_name" required>
                            <br>
                            <br>
                            Returnable <input type="radio" value="1" name="isReturnable" checked>
                            Non-Returnable <input type="radio" value="0" name="isReturnable">
                            <br>
                            <br>
                            <input type="submit" class="submit_btn">
                        </form>
    
                    </div>
    
                </div>
            </div>
            <div class="inlineSectors rightFloat">
                <div class="sectorInstructions">
                    There are already following categories added to the system.<br>Make sure you don't add any duplicate category.
                    <br>
                    <br>
                    <ul>
                        <?php
                            makeLis($conn, "SELECT * FROM `sub_carta`", "name", "li");
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