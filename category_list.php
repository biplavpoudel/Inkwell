<?php
    session_start();
    include "./functions/db_functions.php";
    $count = 0;
    $total_books = 0;

    $conn = db_connect();
    include "./template/header.php";

    $title = "Publishers";

    $query = "SELECT * from category ORDER BY category_name";
    $result = mysqli_query($conn, $query);

    if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}

	if(mysqli_num_rows($result) == 0){
		echo "Empty publisher ! Something wrong! check again";
		exit;
	}

?>

<style>

</style>

<!-- HTML Body starts here -->
<div class="container" style="padding-top: 15px;">
    <h4>Categories List</h4>
    <ul class="list-group" id="books" style="width:40%;">
        <!-- Now for retrieving publisher list from publisher table and counting the books of each publisher by comparing with books table -->
        <?php
            while($cat_row = mysqli_fetch_assoc($result))
            {
                $count = 0;
                $query = "SELECT categoryid from books";
                $result1 = mysqli_query($conn,$query);

                if(!$result1){
                    echo "Can't retrieve data " . mysqli_error($conn);
                    exit;
                }
                
                while ($book_row = mysqli_fetch_assoc($result1))
                {
                    if ($book_row['categoryid'] == $cat_row['categoryid'])
                    {
                        $count++;
                        $total_books++;
                    }
                }
        ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="book_per_category.php?catid=<?php echo $cat_row['categoryid'] ?>"> 
                    <?php echo $cat_row['category_name'] ?>
                </a>
              <span class="badge badge-primary badge-pill"><?php echo $count ?></span>
            </li>
    <?php   } ?>

    </ul>
    <ul class="list-group" style="width:40%;">
        <li class="list-group-item">
            <a href="books.php" style="color:blueviolet;"> Full List of books </a>
            <span class="badge badge-primary badge-pill"><?php echo $total_books ?></span>
        </li>
    </ul>
    
</div>
<!-- HTML Body ends here -->

<!-- For Footer -->
<br>
<?php
include "./template/footer.php";
if(isset($conn)) {
    mysqli_close($conn);
}
?>