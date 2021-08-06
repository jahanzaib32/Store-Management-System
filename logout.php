
<?php 

    session_start();

    include ("common_functions/enable_error.php");
    include ("common_functions/config.php");

    $_SESSION['type'] = "";

    header("Location: " . $domainName . "?ref=logout")

?>
