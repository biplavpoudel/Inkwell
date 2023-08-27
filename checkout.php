<?php
    session_start();
    $title = "Checkout";

    include "./functions/db_functions.php";
    include "./template/header.php";

    if (!isset($_SESSION['user'])){
        echo '<div class="alert alert-danger" role="alert">
        You need to <a href="signin.php">Signin</a> first!
        </div>';
    }

    if (isset($_SESSION['cart']) && array_count_values($_SESSION['cart'])){
?> 
    <div class="container" style="padding:100px;">
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
                    $conn = db_connect();
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
        
        <?php 
		if(isset($_SESSION['user'])){
			echo '<form method="post" action="purchase.php" class="form-horizontal">
			    <div class="form-group" style="margin-left:0px">
			    	<input type="submit" name="submit" value="Purchase" class="btn btn-info" >
			    	<a href="cart.php" class="btn btn-info">Edit Cart</a> 
			    </div>
		    </form>
            <br/>
		    <div><p class="text-muted">Please press <text class="text-info">Purchase</text> to confirm your purchase, or <text class="text-info">Edit Cart</text> to add or remove items.</p></div>';
		}
	    ?>
    </div>

    <?php
	}
    else {
		echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
	}

    if(isset($conn)){ mysqli_close($conn); }
    // include "./template/footer.php";

    ?>