<?php


    $domainName = "http://localhost:8080/Store_Management_System/";
    $backgroundImage = "style='background: url(http://localhost:8080/Store_Management_System/images/bg3.jpg) fixed;'";

    $appName = "Store Management System";

    function makeConn(){
        // chnage
        $servername = "localhost";
        $username = "ZAIB";
        $password = "jahanzai3272";
        $dbNmae = "store_management_sys";

        $conn = new mysqli($servername, $username, $password, $dbNmae);

        /*if($conn -> connect_error){
            echo "Connection Preblem: ". $conn -> connect_problem;
        }
        */
        return $conn;
    }


    function sessionValidation($type){
        if ($_SESSION['type'] == $type){
            return true;
        }else{
            return false;
        }
    }

    function makeQuery($conn, $sql){
        if ($conn->query($sql) === TRUE) {
            return TRUE;
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
            return FALSE;
        }
    }

    function makeLis($conn, $query, $column, $tag = "li"){
        $result = $conn -> query($query);
        if ($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                echo "<" . $tag . ">" . $row[$column] . "</" . $tag . ">";
            }
        }else{
            echo "<" . $tag . ">No item found</" . $tag . ">";
        }
    }
    function makeOption($conn, $query, $column, $value, $tag = "option", $selectedID = NULL){
        $result = $conn -> query($query);
        if ($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                echo "<" . $tag . " value='" . $row[$value] . "' ";
                    if ($selectedID == $row[$value]){
                        echo "selected";
                    }
                echo ">" . $row[$column] . "</" . $tag . ">";
            }
        }else{
            echo "<" . $tag . ">No item found</" . $tag . ">";
        }
    }

    function itemQty($conn, $ID){
        $result = $conn -> query("SELECT * FROM items WHERE ID = " . $ID . " LIMIT 1");
        $row = $result -> fetch_assoc();
        return $row['qty'];
    }



    function issuedQty($conn, $userID, $itemID){
        $query = "SELECT SUM(issued.qty) AS qty FROM issued INNER JOIN users ON issued.user_id = users.ID INNER JOIN items ON issued.item_id = items.ID AND users.ID = " . $userID . " AND issued.item_id = " . $itemID . " GROUP BY items.name LIMIT 1";

        $result = $conn -> query($query);
        echo $conn->error;
        $row = $result -> fetch_assoc();
        return $row["qty"];
    }
    function returnedQty($conn, $userID, $itemID){
        $query = "SELECT SUM(returned.qty) AS qty FROM returned INNER JOIN users ON returned.user_id = users.ID INNER JOIN items ON returned.item_id = items.ID AND users.ID = " . $userID . " AND returned.item_id = " . $itemID . " GROUP BY items.name LIMIT 1";

        $result = $conn -> query($query);
        if ($result -> num_rows > 0){
            $row = $result -> fetch_assoc();
            echo $conn->error;
            return $row["qty"];
        }else{
            return 0;
        }
    }
    function allItemsQtyIssuedToUser($conn, $userID){
        $query = "SELECT SUM(qty) AS Qty FROM issued WHERE user_id = " . $userID;

        $result = $conn -> query($query);

        $row = $result -> fetch_assoc();
        return $row["Qty"];
    }
    function allItemsIssuedToUser ($conn, $userID){
        $query = "SELECT item_id FROM issued WHERE user_id = " . $userID . " GROUP BY item_id"; //this rerutns items uniquely issued to a user
        $result = $conn -> query($query);
        //$row = $result -> fetch_assoc();
        //echo $row["issuedItems"] . "issed";
        return $result -> num_rows;
    }
    /*
    function allItemsIssuedToUserWithDetails($conn, $userID){
        $query = "SELECT * FROM (SELECT item_id FROM issued WHERE user_id = " . $userID . " GROUP BY item_id) AS issuedItems INNER JOIN items ON issuedItems.item_id = items.ID";

        $result = $conn -> query ($query);

    }*/
    function allTimeIssued($conn){
        $query = "SELECT SUM(qty) AS sum FROM issued";
        $result = $conn -> query($query);

        $row = $result -> fetch_assoc();
        return $row['sum'];
    }
    function allTimeReturned($conn){
        $query = "SELECT SUM(qty) AS sum FROM returned";
        $result = $conn -> query($query);

        $row = $result -> fetch_assoc();
        return $row['sum'];
    }
    function allTimeAdded($conn){
        $query = "SELECT SUM(qty) AS sum FROM received";
        $result = $conn -> query($query);

        $row = $result -> fetch_assoc();
        return $row['sum'];
    }
    function totalIssued($conn, $itemID){
        $query = "SELECT SUM(issued.qty) AS qty FROM issued WHERE item_id=" . $itemID . " LIMIT 1";

        $result = $conn -> query($query);
        if ($result -> num_rows > 0){
            $row = $result -> fetch_assoc();
            echo $conn->error;
            return $row["qty"];
        }else{
            return 0;
        }
    }
    function totalReturned($conn, $itemID){
        $query = "SELECT SUM(returned.qty) AS qty FROM returned WHERE item_id=" . $itemID . " LIMIT 1";

        $result = $conn -> query($query);
        if ($result -> num_rows > 0){
            $row = $result -> fetch_assoc();
            echo $conn->error;
            return $row["qty"];
        }else{
            return 0;
        }
    }
    
    function qtyInStock($conn, $itemID){
        $query = "SELECT * FROM items WHERE ID = " . $itemID ;
    
        $result = $conn -> query($query);
        $row = $result -> fetch_assoc();
        echo $conn->error;
        return $row["qty"];
        
    }
    function totalItems($conn){
        $result = $conn -> query("SELECT * FROM items");
        return $result -> num_rows;
    }
    function totalUsers($conn){
        $result = $conn -> query("SELECT * FROM users");
        return $result -> num_rows;
    }
    function allItemsQty($conn){
        $query = "SELECT SUM(qty) AS qty FROM items";
        $result = $conn -> query($query);
        $row = $result -> fetch_assoc();
        return $row['qty'];
    }
?>