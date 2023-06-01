<?php
    session_start();
    $title = "Purchase";

    include "./functions/db_functions.php";
    // $conn = db_connect();
    require_once "./template/header.php";

    if (isset($_SESSION['cart']) && array_count_values($_SESSION['cart'])){
        $customer = getCustomerInfobyEmail($_SESSION['email']);
?>

<style>

</style> 

    <br>
    <div class="container col-md-12" style="padding:20px; background-image: linear-gradient(to right, #D2D8D0, white, #C9D9DA);">

        <div class="col-md-6">
            <h4 style="background-color:gainsboro; width:fit-content">Order Summary:</h4>
            <br>
            <table class="table table-bordered align-middle col-md-6">
                <thead>
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
                    <tr>
                        <td>Shipping</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>$20.00</td>
                    </tr>
                    <tr>
                        <th>Total (Including Shipping)</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th><?php echo "$". ($_SESSION['total_price']+20); ?></th>
                    </tr>
                </tbody>
            </table>
        </div>

    <!-- To separate the Order Summary and Buyer Details -->
        <div class="col-md-1">
        </div>

    <!-- Now for the payment form -->
        <div class="col-md-5">
            <h4 style="margin-left:10px; background-color:gainsboro; width:fit-content;">Your Information:</h4>
            <br>
            <form class="border-class" id="infoForm" method="POST" action="process_form.php">
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="firstname">Firstname:</label>
                      <input type="text" class="form-control" value="<?php echo $customer['firstname']?>" name="firstname">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="lastname">Lastname:</label>
                      <input type="text" class="form-control" value="<?php echo $customer['lastname']?>" name="lastname">
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" value="<?php echo $customer['email']?>" name="email">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" value="<?php echo $customer['address']?>" name="address">
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" value="<?php echo $customer['city']?>" name="city">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="zipcode">Zip Code:</label>
                    <input type="text" class="form-control" value="<?php echo $customer['zipcode']?>" name="zipcode">
                  </div>
              </div>
              <div class="form-group col-md-12">
                <label for="paymentMethod">Payment Method:</label>
                <select class="form-control" id="paymentMethod" name="paymentMethod" onchange="toggleCardDetails()" required>
                  <option value="cashOnDelivery">Cash on Delivery</option>
                  <option value="creditCard">Credit Card</option>
                </select>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-5 card-details">
                    <label for="cardNumber">Card Number:</label>
                    <input type="text" class="form-control" name="cardNumber" value="<?php echo $customer['cardnumber']?>">
                  </div>
                  <div class="form-group col-md-5 card-details">
                    <label for="expiryDate">Expiry Date:</label>
                    <input type="date" class="form-control" name="expiryDate" value="<?php echo $customer['expiry_date']?>" name="expiry_date">
                  </div>
                  <div class="form-group col-md-2 card-details">
                    <label for="cvv">CVV:</label>
                    <input type="password" class="form-control" name="cvv" value="<?php echo $customer['cvv']?>">
                  </div>
              </div>
              <div class="form-row" >
                  <div class="form-group col-md-12" >
                        	<button type="reset" class="btn btn-default">Cancel</button>
                        	<button type="submit" class="btn btn-primary">Purchase</button>
                      </div>
                  </div>
            </form>
      </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  function toggleCardDetails() {
    var paymentMethod = document.getElementById('paymentMethod').value;
    var cardDetails = document.getElementsByClassName('card-details');
    if (paymentMethod === 'creditCard') {
      for (var i = 0; i < cardDetails.length; i++) {
        cardDetails[i].style.display = 'block';
      }
    } else {
      for (var i = 0; i < cardDetails.length; i++) {
        cardDetails[i].style.display = 'none';
      }
    }
  }
</script>
    
<?php
    }
    else{
        echo "<p class=\"text-warning\">Your cart is empty! Please make sure you add some books in it!</p>";
    }

    if (isset($conn)){
        mysqli_close($conn);
    }

    require_once("./template/footer.php");

?>