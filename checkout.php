<?php
    session_start();
    $title = "Checkout";

    include "./functions/db_functions.php";
    $conn = db_connect();

    include "./template/header.php";

?>