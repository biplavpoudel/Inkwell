<?php
    if (!isset($_SESSION)){
        session_start();
    }
    
    require_once "./functions/db_functions.php";

    if(isset($_SESSION['email'])){
        $customer = getCustomerInfoByEmail($_SESSION['email']);
        $name = $customer['firstname'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Linking of Bootstrap and Jumbotron-->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./bootstrap/css/jumbotron.css" rel="stylesheet">

  

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="logo.png" alt="logo" width="30" height="30" class="d-inline-block align-text-top">
      Title
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Link 1</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link 2</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link 3</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- BANNER -->
    <?php
      if(isset($title) && $title == "Index") {
    ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="  background: url('https://www.econlib.org/wp-content/uploads/2018/02/LF-books-background.png') no-repeat center center;background-size: cover;height:400px;" >
      <div class="container">
        <h1 style="text-align:center; margin:5% auto;">WELCOME TO THE BOOKLAND</h1>   
        <p style="text-align:center; margin:5% auto;">Here you can find your favourite books and order them online!</p>     
      </div>
    </div>
    <?php } ?>

    <div class="container" id="main"></div>
  
</body>
</html>