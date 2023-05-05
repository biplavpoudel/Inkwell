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

<?php
  if(isset($conn)) {mysqli_close($conn);}
  require_once "./template/footer.php";
?>