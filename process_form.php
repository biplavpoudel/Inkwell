<?php
	session_start();

	require_once "./functions/db_functions.php";

	$title = "Purchase Process";
	require "./template/header.php";

	$conn = db_connect();

		$firstname = trim($_POST['firstname']);
		$firstname = mysqli_real_escape_string($conn, $firstname);
		
		$lastname = trim($_POST['lastname']);
		$lastname = mysqli_real_escape_string($conn, $lastname);
	
		
		$address = trim(trim($_POST['address']));
		$address = mysqli_real_escape_string($conn, $address);
		
		$city = trim($_POST['city']);
        $city = mysqli_real_escape_string($conn, $city);
        
		$zipcode = trim($_POST['zipcode']);
		$zipcode = mysqli_real_escape_string($conn, $zipcode);

        $cardnumber = trim($_POST['cardNumber']);
		$cardnumber = mysqli_real_escape_string($conn, $cardnumber);

        $expiry_date = trim($_POST['expiryDate']);
		$expiry_date = mysqli_real_escape_string($conn, $expiry_date);

        $cvv = trim($_POST['cvv']);
		$cvv = mysqli_real_escape_string($conn, $cvv);

	// find customer
	$customer = getCustomerInfobyEmail($_SESSION['email']);
	$id = $customer['id'];

	$query = "UPDATE customers SET firstname='$firstname', lastname='$lastname' , address='$address', city='$city', zipcode='$zipcode', cardnumber='$cardnumber', expiry_date='$expiry_date', cvv='$cvv'  where id='$id' ";

	mysqli_query($conn, $query);

	$date = date("Y-m-d H:i:s");
	// insertIntoOrder($conn, $customer['id'], $_SESSION['total_price'],$date);
	insertIntoCart($conn, $customer['id'], $date);

	// take orderid from order to insert order items
	// $orderid = getOrderId($conn, $customer['id']);
	$Cartid = getCartId($conn, $customer['id']);

	foreach($_SESSION['cart'] as $isbn => $qty){
		$bookprice = getbookprice($isbn);
		$query = "INSERT INTO cartItems(cartid, productid, quantity) VALUES ('$Cartid', '$isbn', '$qty')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert value false!" . mysqli_error($conn);
			exit;
		}
	}

	unset($_SESSION['total_price']);
	unset($_SESSION['cart']);
	unset($_SESSION['total_items']);

?>
	<p class="lead text-success" id="p" style="text-align: center; padding: 20px;">Your order has been processed sucessfully..</p>
   <script>
   	
		window.setTimeout(function(){
		    window.location.href = "http://localhost/InkWell/index.php";
        }, 3000);
	
   </script>

<?php
	if(isset($conn)){
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>