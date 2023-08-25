<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "Admin List Categories";
	require_once "./template/admin_header.php";
	require_once "./functions/db_functions.php";
	$conn = db_connect();
	$result = getAllCategories($conn);
    $total_books=0;
?>	
	
<style>
    list-group:first-of-type{
       max-height:580px;
       overflow:scroll;
       -webkit-overflow-scrolling:touch;
       overflow-x:hidden;
    }
    /* .list-group-item ::-webkit-scrollbar{
        display:none;
    } */
</style>

<!-- HTML Body starts here -->
<div class="container" style="padding-top: 15px; padding-bottom:30px;">
    <div class="container" style="padding-top:30px;">
        <p class="lead text-center text-muted" style="background-color:gold; width:fit-content; ;">LIST OF CATEGORIES</p>
		<a href="admin_signout.php"><button class="btn btn-outline-secondary btn-danger"><span class="glyphicon glyphicon-off"></span>&nbsp;Logout</button></a>
    	<a href="admin_book.php"><button class="btn btn-outline-secondary btn-info"><span class="glyphicon glyphicon-book"></span>&nbsp;Books Catalog</button></a>
		<a href="admin_publishers.php"><button class="btn btn-outline-secondary btn-info"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Publishers</button></a>
	</div>

    <div class="container"  style="padding-top: 15px; max-width:50%; margin-left:0;">
    
        <table class="table table-bordered table-hover">
            <!-- Now for retrieving category list from publisher table and counting the books of each category by comparing with books table -->
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
                <tr>
                <td>
                    <a href="" style="pointer-events: none;"> 
                        <?php echo $cat_row['category_name'] ?>
                    </a>
                </td>
                <td><span class="badge badge-primary badge-pill"><?php echo $count ?></span></td>
                <td>
                    <span><a style="color:dodgerblue;" href="admin_editcategories.php?catid=<?php echo $cat_row['categoryid']?>"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Edit</a> </span>
                </td>
                <td>
                    <span><a style="color:dodgerblue;" href="admin_deletecategories.php?catid=<?php echo $cat_row['categoryid'];?>"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</a></span> 
                </td>
                </tr>
                
        <?php   } ?>

        </table>

        <ul class="list-group" style="width:100%;">
            <li class="list-group-item">
                <a href="admin_book.php" style="color:blueviolet;"> Full List of books </a>
                <span class="badge badge-primary badge-pill"><?php echo $total_books ?></span>
            </li>
        </ul>
	<a class="btn btn-info" href="admin_addcategory.php"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add Category</a>
    </div>
</div>

<?php
	if(isset($conn)) {mysqli_close($conn);}
	require_once "./template/footer.php";
?>