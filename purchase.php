<?php
    session_start();
    $title = "Purchase";

    include "./functions/db_functions.php";
    // $conn = db_connect();
    require_once "./template/header.php";

    if (isset($_SESSION['cart']) && array_count_values($_SESSION['cart'])){
        $customer = getCustomerInfobyEmail($_SESSION['email']);
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
    </div>

<?php }
?>