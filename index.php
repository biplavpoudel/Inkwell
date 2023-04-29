<?php
  session_start();
  // connec to database
  
  $title = "Index";
  require_once "./header.php";
  require_once "./functions/db_functions.php";
  $conn = db_connect();
  $row = select4books($conn);
?> 

