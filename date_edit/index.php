<?php
    session_start();

    $pageName = "Edit Date";


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
        $type = $_GET['type'];
        $date = $_POST['date'];
        $id = $_GET['id'];

        //echo "INSERT INTO sub_carta (name, main_cata_id) VALUES ('" . $_POST['cata_name'] . "', " . $_POST['isReturnable'] . ")";
        $result = makeQuery($conn, "UPDATE " . $type . " SET date='" . $date . "' WHERE ID = " . $id);
        if ($result){
            $color ="green";
            $error = "Changes have been saved successfully";
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
                            Please select the date
                        </div>
    
                        <form method="post">
                            Date:
                            <input type="date" name="date" required>
                            <br>
                            <br>
                            <input type="submit" class="submit_btn">
                        </form>
    
                    </div>
    
                </div>
            </div>
            <div class="inlineSectors rightFloat">
                <div class="sectorInstructions">
                    Select the date and press submit to save changes to database.
                </div>
            </div>
        </div>
        

        <div class="footer">
            Copyright 2019, All right reserved!
        </div>
    </div>
</body>
</html>