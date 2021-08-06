<?php 

    session_start();    
    
    include ("../common_functions/enable_error.php");
    include ("../common_functions/config.php");
    
    //check user session
    if (!sessionValidation("user")){
        header("Location: " . $domainName . "?ref=nosession");
    }

    
    $pageName = "Store Items";
    $conn = makeConn();
    $userID = $_SESSION["userID"];
    
    if (isset($_GET["id"])){
        $itemID = $_GET["id"];
    }else{
        $result = $conn -> query ("SELECT ID FROM sub_carta ORDER BY ID ASC LIMIT 1");
        $row = $result -> fetch_assoc();
        $itemID = $row["ID"];
    }

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

        <div class="col-left">
            <div class="reportsArea <?php echo $setClass; ?>">
                <?php 
                    $query = "SELECT * FROM sub_carta";
                    $result = $conn -> query($query);
                ?>
                <div class="sector">
                    <div class="sectorHeader">
                        <h3>
                            Categories 
                        </h3>
                    </div>
                    <div class="sectorTable">
                        <table>
                            <tr>
                                <th>
                                    Sr No.
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    View Details
                                </th>
                            </tr>
                            <?php
                                $srNo = 1;
                                while ($row = $result -> fetch_assoc()){
                                    echo "<tr>";
                                    echo "<td ";
                                    if ($row["ID"] == $itemID){
                                            echo "class='selected'";
                                        }
                                    echo ">" . $srNo . "</td>";
                                    echo "<td ";
                                    if ($row["ID"] == $itemID){
                                            echo "class='selected'";
                                        }
                                    echo ">" . $row['name'] . "</td>";
                                    echo "<td ";
                                    if ($row["ID"] == $itemID){
                                            echo "class='selected'";
                                        }
                                    echo "><a href='" . $domainName . "store_items/?id=" . $row["ID"] . "' class='displayBlock'>View</a></td>";
                                    echo "</tr>";
                                    $srNo++;
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-right">
            <div class="reportsArea <?php echo $setClass; ?>">
                <?php 
                    $query = "SELECT * FROM items WHERE sub_cata_id = " . $itemID;
                    $result = $conn -> query($query);
                ?>
                <div class="sector">
                    <div class="sectorHeader">
                        <h3>
                            Products Details 
                        </h3>
                    </div>
                    <div class="sectorTable">
                        <table>
                            <tr>
                                <th>
                                    Sr No.
                                </th>
                                <th>
                                    Name
                                </th>
                            </tr>
                            <?php
                                $srNo = 1;
                                if ($result -> num_rows > 0){
                                    while ($row = $result -> fetch_assoc()){
                                        echo "<tr>";
                                        echo "<td>" . $srNo . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "</tr>";
                                        $srNo++;
                                    }
                                }else{
                                    echo "<tr> <td colspan='2'> No item is added in this category! </td></tr>";
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            Copyright 2019, All right reserved!
        </div>
    </div>
</body>
</html>