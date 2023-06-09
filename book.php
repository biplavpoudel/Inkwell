<?php
    $title = "Book_Desc";
    require "./functions/db_functions.php";
    $conn = db_connect();
    include "./template/header.php";

    $book_isbn = $_GET['bookisbn'];

    $query = "SELECT book_descr, book_isbn, book_author, book_title, book_price, book_image, publisher_name, category_name FROM books JOIN category ON books.categoryid = category.categoryid JOIN publisher ON books.publisherid = publisher.publisherid WHERE book_isbn = '$book_isbn' ";    //use JOIN command here for books and category table
    $result = mysqli_query($conn, $query);
    if(!$result){
      echo "Can't retrieve data " . mysqli_error($conn);
      exit();
    }
  
    $row = mysqli_fetch_assoc($result);
    if(!$row){
      echo "Empty book";
      exit();
    }
?>

<style>
  @media (max-width: 1200px) {
    .container{
        padding-top: 25px;
        /* overflow-x: hidden; */
    }
}
</style>

<!-- have to figure out how to add genre ie category_name from category table -->
<!-- By joining tables ???? JOIN? -->

<div class="container">
    <p class="lead" style="margin: 25px 0; background-color:gold; width:fit-content"><a href="books.php">BOOKS</a> : <?php echo $row['book_title']; ?></p>

    <div class="row">
      <div class="col-md-3 text-center">
        <img class="img-responsive img-thumbnail" style="max-width:262px;" src="./bootstrap/img/<?php echo $row['book_image']; ?>?123">
      </div>
      <div class="col-md-8">
        <h4>Book Description</h4>
        <p><?php echo $row['book_descr']; ?></p>
        <br>
        <h4>Book Details</h4>
        <table class="table">
        	<?php foreach($row as $key => $value){
            if($key == "book_descr" || $key == "book_image" || $key == "publisherid" || $key == "book_title"){      //we are not showing these fields so continue
              continue;
            }
            switch($key){
              case "book_isbn":
                $key = "ISBN";
                break;
              case "book_author":
                $key = "Author";
                break;
              case "book_price":
                $key = "Price";
                break;
              case "publisher_name":
                $key = "Publisher";
                break;
              case "category_name":
                $key = "Genre";
                break;
            }
          ?>
          <tr>
            <td style="border:none;"><?php echo $key; ?>:</td>
            <td style="border:none;"><?php echo $value; ?></td>
          </tr>
          <?php 
            } 
            if(isset($conn)) {mysqli_close($conn); }
          ?>
        </table>
        <form method="post" action="cart.php">
          <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">         
          <input type="submit" value="Add to cart" name="cart" class="btn btn-info">
        </form>
     	</div>
    </div>
</div>  
<br>
<br>
<br>
<?php
  include "./template/footer.php";
?>