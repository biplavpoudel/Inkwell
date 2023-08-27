<?php
    session_start();
    $title = "Shopping Cart";

    include "./functions/db_functions.php";
    $conn = db_connect();

    include "./functions/cart_functions.php";
    include "./template/header.php";

    if (isset($_POST['bookisbn'])){
        $book_isbn = $_POST['bookisbn'];
    }

    if (isset($book_isbn))
    {
        if (!isset($_SESSION['cart']))
        {
            $_SESSION['cart'] = array();   //associative array with key-value pairs: isbn => qty
            $_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = 0.0;
        }

        if (!isset($_SESSION['cart'][$book_isbn])){
            $_SESSION['cart'][$book_isbn] = 1;    //i.e. qty = 1
        }
        elseif (isset($_POST['cart'])){    //session is already created and if I want to increase the quantity
            $_SESSION['cart'][$book_isbn]++;
            unset($_POST);   //else the qty keeps increasing when user refreshes the page
        }
    }

    // if "Save Changes" button is clicked, we change the qty of each bookisbn
	if (isset($_POST['save_change'])){
		foreach($_SESSION['cart'] as $isbn =>$qty){
			if($_POST[$isbn] == '0'){                       //value is passed by name = $isbn with value = $qty
				unset($_SESSION['cart'][$isbn]);
			}
            else{
				$_SESSION['cart'][$isbn] = $_POST[$isbn];
			}
		}  
	}

    if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart']))){      //array_count_values() returns an associative array with (values => frequency) pair
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
?>

<style>
    @media (max-width: 1200px)  {
        .check_cart{
            padding-top: 50px;
        }
    }

    .img-fluid{
        position: absolute;
    }
</style>

<div class="container">
    <form class="check_cart" action="<?php echo $_SERVER['PHP_SELF'] ?>" method= "post" style="padding:100px;">
        <table class="table table-bordered align-middle">
            <thead style="background-color:ghostwhite;">
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <?php
                foreach ($_SESSION['cart'] as $isbn => $qty){
                    // $conn = db_connect();
                    $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
            ?>
            <tbody>
                <tr>
                    <td><?php echo "<b>".$book['book_title']."</b>" ." by ". $book['book_author']; ?></td>
                    <td><?php echo "$". $book['book_price']; ?></td>

                    <!-- you can change the quantity in textbox (by default, it is $qty) and save it by clicking "Save Changes" button -->
                    <td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>"></td>

                    <td><?php echo "$".$qty * $book['book_price']; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <th>&nbsp;</th>
                    <th>Total:</th>
                    <th><?php echo $_SESSION['total_items']; ?></th>
                    <th><?php echo "$". $_SESSION['total_price']; ?></th>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-info" name="save_change">Save Changes</button>
    <br><br>
        <button type="button" class="btn btn-outline-primary"><a href="checkout.php">Go To Checkout</a></button>
	    <button type="button" class="btn btn-outline-primary"><a href="books.php" >Continue Shopping</a></button>
    </form>
</div>


<?php
    }
    else{
        echo "<div style=\"padding:10px;\"><img class=\"img-fluid\" src=\"./bootstrap/img/empty_cart.png\" alt=\"empty\"  style=\"display:block; margin-left:auto; margin-right:auto; max-width:20%;\"></div>";
        echo '<script language="javascript">'; echo 'alert("Your cart is empty! Add your favourite books to the cart.")';
        echo '</script>';
    }

    // I don't know when this is used 😵😵

    if(isset($_SESSION['user'])){    //this session is set in "user_verify.php"
        $customer = getCustomerInfobyEmail($_SESSION['email']);
        $customerid = $customer['id'];


        // Something is wrong here. Purchase Date database ma correctly update vako xa. tara still retrieve garda sab vanda first data retrieve vayo. Join milena
        // Reason: cart ma different cartid xa tara cartitems ma all items have same cartid


        // $query = "SELECT * FROM cart join cartitems join books join customers
        //     on customers.id='$customerid' and cart.customerid='$customerid' and cart.id=cartitems.cartid and  cartitems.productid=books.book_isbn";
        $query = "SELECT * FROM cart
        JOIN cartitems ON cart.id = cartitems.cartid
        JOIN books ON cartitems.productid = books.book_isbn
        WHERE cart.customerid = '$customerid'";


         $result = mysqli_query($conn,$query);

         if(mysqli_num_rows($result)!= 0){
         echo '	<br><br><br><h4 style="margin-left:100px;">Your Purchase History:</h4>   
         
         <table class="table table-bordered align-middle" style="margin-left:100px; max-width:60%; ">
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Date</th>
            </tr>';
               for($i = 0; $i < mysqli_num_rows($result); $i++){
                   
                   while($query_row = mysqli_fetch_assoc($result)){
                       echo '<tr>
                       <td>
                       <a href="book.php?bookisbn=';
                       echo $query_row['book_isbn'];
                       echo '">';
                       echo '<img style="height:100px;width:80px"class="img-responsive img-thumbnail" src="./bootstrap/img/';
                       echo $query_row['book_image'];
                       echo '">';
                       echo ' </a>
                       </td>
                       <td>';
                       echo $query_row['quantity'];
                       echo '
                       </td>
                       <td>';
                       echo $query_row['date'];
                       echo'
                       </td>
                       </tr>';
                   }
               }
            echo '</table>';
        }
    }
?>
<?php
    if (isset($conn)){
        mysqli_close($conn);
    }

    // include "./template/footer.php";
?>