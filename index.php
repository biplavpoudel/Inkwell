<?php
  session_start();
  // connec to database
  
  $title = "Index";
  require_once "./template/header.php";
  require_once "./functions/db_functions.php";
  $conn = db_connect();
  $row = select4books($conn);
?> 
     <br/> <br/>
      <p class="lead text-center text-muted">OUR LATEST BOOKS</p>
      <br><br>
      <div class="row">
        <?php foreach($row as $book) { ?>
      	<div class="col-md-2">
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
           <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          </a>
      	</div>
        <?php } ?>
      </div>
