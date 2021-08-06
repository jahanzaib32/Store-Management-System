<?php 
    session_start();
    
    $pageName = "Homepage";

    include ("common_functions/enable_error.php");
    include ("common_functions/config.php");

    $conn = makeConn();
    $displayNoti = "none";

    if (isset($_GET['ref']) && $_GET['ref'] == "nosession"){
        $notification = "Please log in as admin before continuing!";
        $displayNoti = "block";
    }


    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];

        $query = ("SELECT * FROM users WHERE email='" . $mail . "' AND pass = '" . $pass . "' LIMIT 1");
        $result = $conn -> query($query);
        
        if ($result -> num_rows > 0){
            $row = $result -> fetch_assoc();

            if ($row['isAdmin'] == 1){
                // admin logged in
                $_SESSION["type"] = "admin";
                header("Location: " . $domainName . "dashboard");
            }else{
                // normal user
                if ($row["pass"] != "abc@123"){
                    $_SESSION["type"] = "user";
                    $_SESSION["userID"] = $row["ID"];
                    header("Location: " . $domainName . "user_dashboard/");
                }else{
                    header("Location: " . $domainName . "change_password/?id=" . $row["ID"]);
                }

            }

        }else{
            $displayNoti = "block";
            $notification = "There is error loggin you into the system! Please recheck login credentials.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="windows.css">

    
    <title>Homepage - Store Management System</title>
    <style>
    </style>
</head>
<body>
    <div class="notification" style="display: <?php echo $displayNoti; ?>;">
        <?php echo $notification; ?>
        <div class="close" onclick="this.parentNode.style.display = 'none'">
            x
        </div>
    </div>
        <div class="windows messageBox" style="display: none;">
                <div class="titleBar clearFix">
                    <div class="title verticallyCenter">
                        Login - Store Management System
                    </div>
                    <div class="buttons">
                        <a href="javascript:void(0)" onclick="closeLogin()">x</a>
                    </div>
                </div>
                <div class="windows-mainBody">
                    <div class="textArea description">
                        Please fill the following information correctly!
                    </div>
                    <form method="post">
                        <div class="formArea">
                                <div class="inputTextArea">
                                    <div class="imageIcon verticallyCenter"><img src="images/mail.png"></div>
                                    <input type="text" placeholder="Please enter your email address" name="mail">
                                </div>
                                <div class="inputTextArea">
                                    <div class="imageIcon verticallyCenter"><img src="images/lock.png"></div>
                                    <input type="password" placeholder="Please enter your password" name="pass">
                                </div>
                        </div>
                        <div class="submitButton">
                            <input type="submit">
                        </div>
                    </form>
                </div>
            </div>    
        
    <div class="area area_0 area_blue">
        <div class="areaContainer">
            <div class="fullWidth verticallyCenter">
                <div class="header">
        
                    <div class="left">
                        <a href="http://127.0.0.1:5500">
                            <img src="images/logo.png">
                        </a>
                    </div>
        
                    <div class="right verticallyCenter">
                        <ul>
                            <li><a href="#" onclick="showLogin()">Login</a></li>
                        </ul>
        
                    </div>
        
                </div>
                <div class="introduction clearFix">
        
                    <div class="left">
                        <div class="container verticallyCenter clearFix">
                            <h3>
                                Store Management System
                            </h3>
                            <div class="mainButton">
                                <a href="javascript:void(0)" onclick="showLogin()">Dashboard</a>
                            </div>
                        </div>
                    </div>
                    <div class="right verticallyCenter">
                        <div class="statsImage">
                            <img src="images/head1.PNG">
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mainBody">
        <div class="wrapper">
            <div class="left">
                <div class="imageWrapper verticallyCenter">
                    <img src="images/head2.png">
                </div>
            </div>
            <div class="right">
                <div class="contentWrapper verticallyCenter">
                    <h3 class="heading_3">
                        No More Paper Work
                    </h3>
                    <p>
                        Are you worried about mistakes? Or you got tired of doing paper work? This Store management system will change the life by making your work easir and error free. Now you can deal your customers/users more easily!
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footerLinks">
            <ul class="horizontalList">
                <li style="margin-left: 0px;">
                    <h4 class="title">Important Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact Us!</a></li>
                    </ul>
                </li><li>
                    <h4 class="title">Others</h4>
                    <ul>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                    </ul>
                </li><li style="margin-right: 0px;">
                    <h4 class="title">Social Media</h4>
                    <ul>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="footerCopyrights">
            <div class="copyrightText">
                <p>
                    Copyrights, all rights reserved!
                </p>
            </div>
            <div class="socialLinks">
                
            </div>
        </div>
    </div>

    <script>
        function showLogin(){
            document.querySelector(".windows").style.display = "block";
        }
        function closeLogin(){
            document.querySelector(".windows").style.display = "none";
        }
    </script>
</body>
</html>