<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "Edit publisher";
	require_once "./template/admin_header.php";
	require_once "./functions/db_functions.php";
	$conn = db_connect();

	if(isset($_GET['pubid'])){
		$pubid = $_GET['pubid'];
	} else {
		echo "Empty query!";
		exit;
	}

	if(!isset($pubid)){
		echo "Empty isbn! check again!";
		exit;
	}

	// get book data
	$query = "SELECT * FROM publisher WHERE publisherid = '$pubid'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	$row = mysqli_fetch_assoc($result);

	// //to update publisher's name
	// if (isset($_POST['save_change'])){
	// 	$newName = $_POST['name'];
	// }

	// $update_query = "UPDATE publisher SET publisher_name='' WHERE publisherid = '$pubid' ";
	// $update_result = mysqli_query($conn, $query);
	// if(!$update_result){
	// 	echo "Can't update data " . mysqli_error($conn);
	// 	exit;
	// }
?>

<div class="container" style="margin-top:30px;">
	<div style="padding-top:30px;">
        <p class="lead text-center text-muted" style="background-color:gold; width:fit-content; ;">EDIT PUBLISHER</p>
	</div>
	<form method="post" action="edit_publisher.php" enctype="multipart/form-data" style="background-color: aliceblue; max-width:50%">
		<table class="table" style="max-width: fit-content;">
        <th>Name</th>
			<tr>
				<td style="display:none"><input type="text" name="id" value="<?php echo $row['publisherid'];?>"></td>
				
				<td><input type="text" name="name" value="<?php echo $row['publisher_name'];?>" required></td>
			</tr>

		</table>
		<input type="submit" name="save_change" value="Change" class="btn btn-primary">
		<a href="admin_publishers.php" class="btn btn-default">Cancel</a>
	</form>
</div>
	<br/>
	<!-- <a href="admin_publishers.php" class="btn btn-success">Confirm</a> -->
