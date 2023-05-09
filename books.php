<?php
    $title = "Full Catalog of Books";
    require "./functions/db_functions.php";
    $conn = db_connect();
    include "./template/header.php";

    // For Sorting books according to title, price, author
    if(isset($_POST['title']))
    {
        if(isset($_POST['asc'])){
          $query = "SELECT * FROM books order by book_title asc";   
        }
        else if(isset($_POST['desc'])){
          $query = "SELECT * FROM books order by book_title desc";
        }
        else{
          $query = "SELECT * FROM books";
        }
    }
    else if(isset($_POST['price']))
    {
        if(isset($_POST['asc'])){
          $query = "SELECT * FROM books order by book_price asc";
        }
        else if(isset($_POST['desc'])){
          $query = "SELECT * FROM books order by book_price desc";
        }
        else{
          $query = "SELECT * FROM books";
        }
    }
    else if(isset($_POST['author']))
    {
        if(isset($_POST['asc'])){
          $query = "SELECT * FROM books order by book_author asc";
    
        }
        else if(isset($_POST['desc'])){
          $query = "SELECT * FROM books order by book_author desc";
        }
        else{
          $query = "SELECT * FROM books";
        }
    }
    else
    {
        $query = "SELECT * FROM books";
    }
?>


<?php
    include "./template/footer.php";
    if (isset($conn)){
        mysqli_close($conn);
    }
?>