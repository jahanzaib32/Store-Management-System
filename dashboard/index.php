<?php

    $pageName = "Dashboard";
    
    session_start();    

    //include ("../common_functions/enable_error.php");
    include ("../common_functions/config.php");
    $setClass = "";

    //session validation as admin
    if (!sessionValidation("admin")){
        header("Location: " . $domainName . "?ref=nosession");
    }
    
    $conn = makeConn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../report_style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300&display=swap" rel="stylesheet">
    
    <title>Dashboard - Store Management System</title>
</head>
<body>
    <?php include("../common_html/admin/side_bar.php"); ?>

    <div class="mainBody">
        <?php include ("../common_html/admin/header.php"); ?>
        <div class="col-wrapper">
            <div class="col-left">
                <div class="reportsArea">
                    <div class="sector">
                        <div class="sectorHeader">
                            <h3>
                                Summary
                            </h3>
                        </div>
                        <div class="sectorTable">
                            <?php 
                                $query = "SELECT * FROM items WHERE qty > 0";
                                $result = $conn -> query($query);
                            ?>
                            <div class="impInfo">
                                <div class="infoWrapper">
                                    <div class="property">
                                        <div class="property-heading">
                                            Total Items
                                        </div>
                                        <div class="property-qty">
                                            <?php echo totalItems($conn); ?>
                                        </div>
                                    </div>
                                    <div class="property">
                                        <div class="property-heading">
                                            Total Users
                                        </div>
                                        <div class="property-qty">
                                            <?php echo totalUsers($conn); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="infoButton">
                                    <a href="<?php echo $domainName; ?>reports/item.php" class="infoLink">Details</a>
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
                                        Quantity (in stock)
                                    </th>
                                    <th>
                                        Details
                                    </th>
                                </tr>
                                <?php
                                    $srNo = 1;
                                    while ($row = $result -> fetch_assoc()){
                                        echo "<tr>";
                                        echo "<td>" . $srNo . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['qty'] . "</td>";
                                        echo "<td><a href='" . $domainName ."reports/item.php?item=" . $row['ID'] . "' class='view_image'>View <img src='" . $domainName . "images/open_link.png' class='view_image'></a>" . "</td>";
                                        echo "</tr>";
                                        $srNo++;
                                    }
                                ?>
                                <tr class="sumup_row">
                                    <td colspan="2">Total</td>
                                    <td><?php echo allItemsQty($conn); ?></td>
                                    <td><a href="<?php echo $domainName . "reports/item.php"; ?>" class="view_image">All items <img src="<?php echo $domainName; ?>images/open_link_white.png" class="view_image"></a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="reportsArea <?php echo $setClass; ?>">
                    <?php 
                        $query = "SELECT issued.ID AS issued_id, items.ID AS item_id, items.name AS item_name, users.name AS user_name, issued.date, issued.qty FROM issued INNER JOIN items on issued.item_id = items.ID INNER JOIN users on users.ID = issued.user_id ORDER BY issued.date DESC LIMIT 7";
                        $result = $conn -> query($query);
                    ?>
                    <div class="sector">
                        <div class="sectorHeader">
                            <h3>
                                Recently Issued 
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
                                        User Name
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Edit Date
                                    </th>
                                </tr>
                                <?php
                                    $srNo = 1;
                                    while ($row = $result -> fetch_assoc()){
                                        echo "<tr>";
                                        echo "<td>" . $srNo . "</td>";
                                        echo "<td>" . $row['item_name'] . "</td>";
                                        echo "<td>" . $row['user_name'] . "</td>";
                                        echo "<td>" . $row['qty'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td><a href='" . $domainName . "date_edit/?id=" . $row['issued_id'] . "&type=issued' class='view_image'>Edit <img src='" . $domainName . "images/edit.png' class='view_image'></a>" . "</td>";
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
                <div class="reportsArea">
                    <div class="sector">
                        <div class="sectorHeader">
                            <h3>
                                Issued Items
                            </h3>
                        </div>
                        <div class="sectorTable">
                            <div class="impInfo">
                                <div class="infoWrapper">
                                    <div class="property">
                                        <div class="property-heading">
                                            All Time Issued
                                        </div>
                                        <div class="property-qty">
                                            <?php echo allTimeIssued($conn); ?>
                                        </div>
                                    </div>
                                    <div class="property">
                                        <div class="property-heading">
                                            All Time Returned
                                        </div>
                                        <div class="property-qty">
                                            <?php echo allTimeReturned($conn); ?>
                                        </div>
                                    </div>
                                    <div class="property">
                                        <div class="property-heading">
                                            All Time Added
                                        </div>
                                        <div class="property-qty">
                                            <?php echo allTimeAdded($conn); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="infoButton">
                                    <a href="#" class="infoLink">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
                <div class="reportsArea <?php echo $setClass; ?>">
                    <?php
                        $query = "SELECT received.ID AS received_id, items.name, received.req_no, received.register_name, received.page_no, received.qty, received.date FROM received INNER JOIN items ON items.ID = received.item_id ORDER BY received.date DESC LIMIT 10";
                        //echo $query;
                        $result = $conn -> query($query);
                        $ttlIssuedItems = $result -> num_rows;
                    ?>
                    <div class="sector">
                        <div class="sectorHeader">
                            <h3>
                                Recently Added 
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
                                        Requisition No.
                                    </th>
                                    <th>
                                        Register Name & Page No.
                                    </th>
                                    <th>
                                        Quantity (in stock)
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Edit Date
                                    </th>
                                </tr>
                                <?php
                                    $srNo = 1;
                                    while ($row = $result -> fetch_assoc()){
                                        echo "<tr>";
                                        echo "<td>" . $srNo . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['req_no'] . "</td>";
                                        echo "<td>" . $row['register_name'] . " (Page # " . $row['page_no'] . ")</td>";
                                        echo "<td>" . $row['qty'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td><a href='" . $domainName . "date_edit/?id=" . $row['received_id'] . "&type=received' class='view_image'>Edit <img src='" . $domainName . "images/edit.png' class='view_image'></a>" . "</td>";
                                        echo "</tr>";
                                        $srNo++;
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reportsArea <?php echo $setClass; ?>">
            <?php 
                $query = "SELECT returned.ID AS returned_id, items.ID AS item_id, items.name AS item_name, users.name AS user_name, returned.date, returned.qty FROM returned INNER JOIN items on returned.item_id = items.ID INNER JOIN users on users.ID = returned.user_id ORDER BY returned.date DESC LIMIT 7";
                $result = $conn -> query($query);
            ?>
            <div class="sector">
                <div class="sectorHeader">
                    <h3>
                        Recently Returned 
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
                                User Name
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Edit Date
                            </th>
                        </tr>
                        <?php
                            $srNo = 1;
                            while ($row = $result -> fetch_assoc()){
                                echo "<tr>";
                                echo "<td>" . $srNo . "</td>";
                                echo "<td>" . $row['item_name'] . "</td>";
                                echo "<td>" . $row['user_name'] . "</td>";
                                echo "<td>" . $row['qty'] . "</td>";
                                echo "<td>" . $row['date'] . "</td>";
                                echo "<td><a href='" . $domainName . "date_edit/?id=" . $row['returned_id'] . "&type=returned' class='view_image'>Edit <img src='" . $domainName . "images/edit.png' class='view_image'></a>" . "</td>";
                                echo "</tr>";
                                $srNo++;
                            }
                        ?>

                    </table>
                </div>
            </div>
        </div>

        <div class="footer">
            Copyright 2019, All right reserved!
        </div>
    </div>
</body>
</html>