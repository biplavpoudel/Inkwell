<?php
    $title = "Full Catalog of Books";
    require "./functions/db_functions.php";
    $conn = db_connect();
    include "./template/header.php";
    $count = 0;

    // For Sorting books according to title, price, author
    // this code has no meaning unless the user clicks submit button in the below form
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

    //Now lets run the query
    $result = mysqli_query($conn, $query);

    if(!isset($result)){
        echo "Something went wrong !". mysqli_error($conn);
        exit();
    }
?>

<style>
</style>
<div style="background-color:mintcream;">
<!-- Now comes the HTML part 🥱🥱 -->
  <div class="container" style="padding-top:30px;">
    <p class="lead text-center text-muted" style="background-color:gold; width:fit-content; ;">Full Catalogs of Books</p>
    <h5 class="text-muted">Sort By:</h5>

    <form method="post" action="books.php">
      <div class="checkbox">
        <label><input type="checkbox" name="asc" >Ascending</label>
      </div>
      <div class="checkbox">
        <label><input type="checkbox" name="desc">Descending</label>
      </div>

      <button type="submit" class="btn btn-outline-secondary" name="title">Title</button>
      <button type="submit" class="btn btn-outline-secondary" name="price">Price</button>
      <button type="submit" class="btn btn-outline-secondary" name="author">Author</button>
      <button type="submit" class="btn btn-outline-secondary" name="clear">Clear</button>  
    </form>

    <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
        <div class="row">
          <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
            <div class="col-md-3">
              <br><br>
              <a href="book.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
                <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $query_row['book_image']; ?>?1234" style="height: 300px; ;">
              </a>
              <table>
                <tr>
                  <td><strong style="text-transform:uppercase">  <?php echo $query_row['book_title']; ?></strong></td>
                </tr>
                <tr>
                <td> <?php echo $query_row['book_author']; ?></td>
                </tr>
                <tr>
                <td><strong>$<?php echo $query_row['book_price'];?></strong>  </td>
                </tr>
              </table>
            </div>

          <!-- without below snippet, the books are displayed hapazardly. kunai column is filled, kunai isn't -->
          <?php
            $count++;
            if($count >= 4){
                $count = 0;
                break;
              }
            } 
          ?> 
        </div>
    <?php
          }
    ?>
    <br><br>
  </div>
</div>

<?php
    include "./template/footer.php";
    if (isset($conn)){
        mysqli_close($conn);
    }
?>