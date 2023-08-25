<?php	
	// if "Change" is clicked
	if(!isset($_POST['save_change'])){
		echo "Something wrong!";
		exit;
	}

	$category = trim($_POST['name']);
	$id = trim($_POST['id']);

    require_once("./functions/db_functions.php");
	$conn = db_connect();


	$query = "UPDATE category SET category_name = '$category' where categoryid='$id'";
	
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't Update Data " . mysqli_error($conn);
		exit;
	} else {
		header("Location: admin_categories.php?bookisbn=$isbn");
	}
?>