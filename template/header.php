<?php
    if (!isset($_SESSION)){
        session_start();
    }

    $page = $_SERVER['PHP_SELF'];
    $sec = "5";
    
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
    <!-- <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'"> -->

    <!-- Linking of Bootstrap and Jumbotron -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="./bootstrap/css/jumbotron.css" rel="stylesheet">
  

<body style="padding-bottom:0px;">

<nav class="navbar navbar-light navbar-fixed-top"  style="background-color:aliceblue;" >
      <div class="container">
        <div class="navbar-header" >
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <div style="width: 400px; ">
          <div class="row">
            <!-- Image and text -->
            <a class="navbar-brand" href="index.php"><img src="./bootstrap/logo/logo.png" width="100%" height="150%" class="d-inline-block align-top" alt="" style="filter:saturate(200%);filter:contrast(150%)"></a>
            <form  method="post" action="search_book.php" class="col-md-4 form-inline" style="margin-top:7px; margin-left:5px; margin-bottom:5px;">
              <input type="text" class="form-control" id="inputPassword2" placeholder="Search for Books" name="text">
              <button type="submit" class="btn btn-primary mb-2" style="display:none"></button>
           </form>
          </div>
          </div>
        </div>

        <!--/.navbar-collapse -->
        <div class="navbar-collapse collapse"  id="navbar">
          <ul class="nav navbar-nav navbar-right">
              <!-- link to publiser_list.php -->
              <li class="nav-item"><a href="publisher_list.php"><span class="glyphicon glyphicon-paperclip" style="color:gray;"></span>&nbsp; Publishers</a></li>
              
              <li class="nav-item"><a href="category_list.php"><span class="glyphicon glyphicon-list-alt" style="color:gray;"></span>&nbsp; Categories</a></li>
              <!-- link to books.php -->
              <li class="nav-item"><a href="books.php"><span class="glyphicon glyphicon-book" style="color:gray;"></span>&nbsp; Books</a></li>
              <!-- link to shopping cart -->
              <li class="nav-item"><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart" style="color:gray;"></span>&nbsp; My Cart</a></li>
              
              <?php 
               if(isset($_SESSION['user'])){
                 echo ' <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" style="color:gray;"></span>&nbsp; Logout</a></li>'.'<li><a href="profile.php"><span class="glyphicon glyphicon-user" style="color:gray;"></span>&nbsp;'.$name.'</a></li>';
               }
               else{
                echo ' <li><a href="signin.php"><span class="glyphicon glyphicon-log-in" style="color:gray;"></span>&nbsp; Signin</a></li>'.'<li><a href="signup.php"><span class="glyphicon glyphicon-plus-sign" style="color:gray;"></span>&nbsp;Sign up</a></li>';
               }

              ?>
              
            </ul>
        </div>
      </div>
    </nav>


<!-- BANNER -->
    <?php
      if(isset($title) && $title == "Index") {
    ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="background: url('./bootstrap/img/jumbotron1.png') no-repeat center center; background-size: cover;height:400px;" >
      <div class="container">
        <img src="./bootstrap/logo/logo.png" style="margin-left:auto; margin-right:auto; display:block; width:30%; margin-top:10px;"></img>
        <h1 style="text-align:center; margin:5% auto; ;"><marquee>WELCOME TO THE INKWELL</marquee></h1>   
        <p style="text-align:center; margin:5% auto; background-color:bisque; width: 60%;">Here you can find your favourite books and order them online!</p>     
      </div>
    </div>


  <?php } ?>

    <div class="container" id="main"></div>
  
</body>
</html>