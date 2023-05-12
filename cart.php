<?php
    session_start();
    $title = "Shopping Cart";

    include "./functions/db_functions.php";
    $conn = db_connect();

    include "./functions/cart_functions.php";
    include "./template/header.php";

    if (isset($_POST['bookisbn'])){
        $book_isbn = $_POST['bookisbn'];
    }

?>