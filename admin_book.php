<?php
    $title = "Admin Catalog of Books";
    require "./functions/db_functions.php";
    $conn = db_connect();
    include "./template/admin_header.php";
    $result = getAllBooks($conn);
?>

<style>
	.description{
		max-height: 6em; /* Adjust the number of lines you want to display */
  		overflow:hidden;
  		display: -webkit-box;
  		-webkit-line-clamp: 7;
  		-webkit-box-orient: vertical;
  		text-overflow:ellipse;
}
</style>
<div class="container">
	<div class="container" style="padding-top:30px;">
    <p class="lead text-center text-muted" style="background-color:gold; width:fit-content; ;">ADMIN PANEL</p>

		<a href="admin_signout.php"><button class="btn btn-outline-secondary btn-danger"><span class="glyphicon glyphicon-off"></span>&nbsp;Logout</button></a>
    	<a href="admin_publishers.php"><button class="btn btn-outline-secondary btn-info"><span class="glyphicon glyphicon-paperclip"></span>&nbsp;Publishers</button></a>
		<a href="admin_categories.php"><button class="btn btn-outline-secondary btn-info"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Categories</button></a>
		<a href="admin_add.php"><button class="btn btn-outline-secondary btn-info"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Book</button></a> 
	</div>

	<div class="container">
		<table class="table table-hover" style="margin-top: 50px; margin-bottom:50px;">
			<tr style="background:aliceblue">
				<th>ISBN</th>
				<th>Title</th>
				<th>Author</th>
				<th>Image</th>
				<th>Description</th>
				<th>Price</th>
				<th>Publisher</th>
				<th>Category</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
			<?php while($row = mysqli_fetch_assoc($result)){ ?>
			<tr>
				<td><?php echo $row['book_isbn']; ?></td>
				<td><?php echo $row['book_title']; ?></td>
				<td><?php echo $row['book_author']; ?></td>
				<td><img src="bootstrap/img/<?php echo $row['book_image']; ?>" style="width:70%"></td>
				<td class="description"><?php echo $row['book_descr']; ?></td>
				<td><?php echo $row['book_price']; ?></td>
				<td><?php echo getPubName($conn, $row['publisherid']); ?></td>
				<td><?php echo getCatName($conn, $row['categoryid']); ?></td>
    	        <td><a href="admin_edit.php?bookisbn=<?php echo $row['book_isbn']?>"><span class="glyphicon glyphicon-pencil" style="display:inline"></span>&nbsp;Edit</a></td>
    	        <td><a href="admin_delete.php?bookisbn=<?php echo $row['book_isbn']?>"><span class="glyphicon glyphicon-trash" style="display:inline"></span>&nbsp;Delete</a></td>

			</tr>
			<?php } ?>
		</table>
	</div>
</div>
<?php
	require_once "./template/footer.php";
?>