<?php
	session_start();
	if((!isset($_SESSION['manager'])  && !isset($_SESSION['expert']))){
		header("Location:index.php");
	}
	$title = "Add new publisher";
	require "./template/admin_header.php";
	require "./functions/db_functions.php";
	$conn = db_connect();

	if(isset($_POST['add'])){
		$name = trim($_POST['name']);
		$name = mysqli_real_escape_string($conn, $name);
		
		// find publisher and return pubid
		// if publisher is not in db, create new
		$findPub = "SELECT * FROM publisher WHERE publisher_name = '$name'";
		$findResult = mysqli_query($conn, $findPub);
		if(mysqli_num_rows($findResult)==0){
			// insert into publisher table and return id
			$insertPub = "INSERT INTO publisher(publisher_name) VALUES ('$name')";
			$insertResult = mysqli_query($conn, $insertPub);
			if(!$insertResult){
				echo "Can't add new publisher " . mysqli_error($conn);
				exit;
			}
			header("Location: admin_publishers.php");
		} else {
            echo '<p style="color:red;">Publisher already exists</p>';
		}
	}
?>
<div class="container" style="margin-top:30px;">
	<div style="padding-top:30px;">
        <p class="lead text-center text-muted" style="background-color:gold; width:fit-content; ;">ADD NEW PUBLISHER</p>
	</div>
	<form method="post" action="admin_addpublisher.php" enctype="multipart/form-data" style="background-color: aliceblue; max-width:50%">
		<table class="table" style="max-width: fit-content;">
				<tr>
					<td>Name</td>
					<td><input type="text" name="name"></td>
				</tr>
			<tr>
				<td><input type="submit" name="add" value="Add" class="btn btn-primary"></td>
				<td><a href="admin_publishers.php" class="btn btn-default">Cancel</a></td>
			</tr>
		</table>
	</form>
	<br/>
</div>
