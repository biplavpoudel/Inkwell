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
        echo "<div style=\"padding:50px;\"><img class=\"img-fluid\" src=\"./bootstrap/img/empty_cart.png\" alt=\"empty\"  style=\"display:block; margin-left:auto; margin-right:auto; max-width:90%;\"></div>";
        echo '<script language="javascript">'; echo 'alert("Your cart is empty! Add your favourite books to the cart.")';
        echo '</script>';
    }
?>
<?php
    if (isset($conn)){
        mysqli_close($conn);
    }

    // include "./template/footer.php";
?>