<?php
  session_start();
  // connec to database
  
  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/db_functions.php";
  $conn = db_connect();
  $row = select6books($conn);
?> 

<br/> <br/>

    <div class="container" style="padding-bottom: 50px; margin-bottom:50px;">
      <p class="lead text-center text-muted">OUR LATEST BOOKS</p>
      <br><br>
      <div class="d-flex justify-content-center">
        <?php foreach($row as $book) { ?>
      	<div class="col-md-2 col-sm-2">
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
           <img class="img-responsive img-thumbnail" style="height: 260px; ;" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          </a>
      	</div>
        <?php } ?>
      </div>
    </div>

<br><br>

<!-- Newletter -->
<div class="jumbotron" style="background: url('./bootstrap/img/newsletter.png') no-repeat center center; background-size:cover; height:250px; margin-bottom:0px; padding-top:20px;" >
      <div class= "container">
        <div class="col-md-5 offset-md-1 mb-3">
          <form>
            <h3>Subscribe to our Newsletter</h3>
            <h5>Monthly digest of what's new and exciting from us!</h5>
            <br>
            <div class="d-flex flex-column flex-sm-row w-100 gap-2">
              <label for="newsletter1" class="visually-hidden">Email address</label>
              <input id="newsletter1" type="text" class="form-control" placeholder="Email address"><br>
              <button class="btn btn-primary" type="button">Subscribe</button>
            </div>
          </form>
        </div>
     </div>
    </div>


<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>