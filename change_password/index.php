<?php
    session_start();

    $pageName = "Change Password";


    include ("../common_functions/enable_error.php");
    include ("../common_functions/config.php");

    if (isset($_GET['id'])){

        $_SESSION['user_login_tried_id'] = $_GET['id'];
        header("Location: " . $domainName . "change_password/");
    }elseif (isset($_SESSION['user_login_tried_id'])){
        $userID = $_SESSION['user_login_tried_id'];
    }
    //$userID = $_SESSION['user_login_tried_id'];

    $color = "green";
    $error = "";
    $conn = makeConn();

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        //$userID = $_POST['mail'];
        $userPass = $_POST['pass'];

        //echo "INSERT INTO sub_carta (name, main_cata_id) VALUES ('" . $_POST['cata_name'] . "', " . $_POST['isReturnable'] . ")";
        $result = makeQuery($conn, "UPDATE users SET pass = '" . $userPass . "' WHERE ID = " . $userID);
        if ($result){
            $color ="green";
            $error = "Password has ben changed successfully";
            $_SESSION["type"] = "user";
            $_SESSION["userID"] = $userID;

            header("Location: " . $domainName . "user_dashboard/");
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
                            Please enter a new password.
                        </div>
    
                        <form method="post">
                            Password:
                            <input type="password" name="pass" required>
                            <br>
                            <br>
                            <input type="submit" class="submit_btn">
                        </form>
    
                    </div>
    
                </div>
            </div>
            <div class="inlineSectors rightFloat">
                <div class="sectorInstructions">
                    Please make sure to enter a changed password.
                </div>
            </div>
        </div>
        

        <div class="footer">
            Copyright 2019, All right reserved!
        </div>
    </div>
</body>
</html>