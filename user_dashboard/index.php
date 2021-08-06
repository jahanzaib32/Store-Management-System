<?php 

    session_start();    
    
    include ("../common_functions/enable_error.php");
    include ("../common_functions/config.php");
    
    //check user session
    if (!sessionValidation("user")){
        header("Location: " . $domainName . "?ref=nosession");
    }

    $pageName = "User Dashboard";

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
        <div class="col-wrapper">
            <div class="col-left <?php echo $setClass; ?>">
                <div class="reportsArea">
                    <div class="sector">
                        <div class="sectorHeader">
                            <h3>
                                User Info
                            </h3>
                        </div>
                        <div class="userDetails">
                            <?php
                                $query = "SELECT * FROM users WHERE ID=". $userID . " LIMIT 1";
                                $result = $conn -> query($query);
                                $row = $result -> fetch_assoc();
                            ?>
                            <div class="icon">
                                <img src="<?php echo $domainName; ?>images/user.jpg">
                            </div>
                            <br>
                            <br>
                            <div class="userInfo">
                                <table>
                                    <tr><td>Name</td><td><?php echo $row['name']; ?></td></tr>
                                    <tr><td>E-Mail</td><td><?php echo $row['email']; ?></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-right <?php echo $setClass; ?>">
                <div class="reportsArea">
                    <div class="sector">
                        <div class="sectorHeader">
                            <h3>
                                Issued Items
                            </h3>
                        </div>
                        <div class="sectorTable">
                            <?php
                                $query = "SELECT issued.item_id, items.name, SUM(issued.qty) AS qty FROM issued INNER JOIN items ON items.ID = issued.item_id WHERE user_id=" . $userID . " GROUP BY item_id";
                                $result = $conn -> query($query);
                                $ttlIssuedItems = $result -> num_rows;
                            ?>
                            <?php
                                $rows = "";
                                $srNo = 1;
                                while ($row = $result -> fetch_assoc()){
                                    if ((issuedQty($conn, $userID, $row['item_id']) - returnedQty($conn, $userID, $row['item_id'])) > 0){
                                        $rows .= "<tr>";
                                        $rows .= "<td>" . $srNo . "</td>";
                                        $rows .= "<td>" . $row['name'] . "</td>";
                                        $rows .= "<td>" . (issuedQty($conn, $userID, $row['item_id']) - returnedQty($conn, $userID, $row['item_id'])) . "</td>";
                                        $rows .= "<td><a href='" . $domainName ."reports/item.php?item=" . $row['item_id'] . "' class='view_image'>View <img src='" . $domainName . "images/open_link.png' class='view_image'></a>" . "</td>";
                                        $rows .= "</tr>";
                                        $srNo++;
                                    }
                                }
                            ?>

                            <div class="impInfo">
                                <div class="infoWrapper">
                                    <div class="property">
                                        <div class="property-heading">
                                            Total Issued Items
                                        </div>
                                        <div class="property-qty">
                                            <?php echo $srNo - 1; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table>
                                <tr>
                                    <th>
                                        Sr No.
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Quantity (not returned)
                                    </th>
                                    <th>
                                        Details
                                    </th>
                                </tr>
                                <?php
                                    echo $rows;
                                ?>
                            </table>
                        </div>
                    </div>
                </div>            
            </div>
        </div>

        <div class="col-left">
            <div class="reportsArea <?php echo $setClass; ?>">
                <?php 
                    $query = "SELECT items.ID AS item_id, items.name AS item_name, users.name AS user_name, issued.date, issued.qty FROM issued INNER JOIN items on issued.item_id = items.ID INNER JOIN users on users.ID = issued.user_id WHERE users.ID = " . $userID . " LIMIT 7";
                    $result = $conn -> query($query);
                ?>
                <div class="sector">
                    <div class="sectorHeader">
                        <h3>
                            Recently Issued Items 
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
                                    Quantity
                                </th>
                                <th>
                                    Date
                                </th>
                            </tr>
                            <?php
                                $srNo = 1;
                                while ($row = $result -> fetch_assoc()){
                                    echo "<tr>";
                                    echo "<td>" . $srNo . "</td>";
                                    echo "<td>" . $row['item_name'] . "</td>";
                                    echo "<td>" . $row['qty'] . "</td>";
                                    echo "<td>" . $row['date'] . "</td>";
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
                    $query = "SELECT items.ID AS item_id, items.name AS item_name, users.name AS user_name, returned.date, returned.qty FROM returned INNER JOIN items on returned.item_id = items.ID INNER JOIN users on users.ID = returned.user_id WHERE users.ID = " . $userID . " LIMIT 7";
                    $result = $conn -> query($query);
                ?>
                <div class="sector">
                    <div class="sectorHeader">
                        <h3>
                            Recently Returned Items 
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
                                    Quantity
                                </th>
                                <th>
                                    Date
                                </th>
                            </tr>
                            <?php
                                $srNo = 1;
                                while ($row = $result -> fetch_assoc()){
                                    echo "<tr>";
                                    echo "<td>" . $srNo . "</td>";
                                    echo "<td>" . $row['item_name'] . "</td>";
                                    echo "<td>" . $row['qty'] . "</td>";
                                    echo "<td>" . $row['date'] . "</td>";
                                    echo "</tr>";
                                    $srNo++;
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