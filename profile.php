<?php
    session_start();
    $title = "Profile";
    include "./functions/db_functions.php";

    // Including connection to database
    $conn = db_connect();

    include "./template/header.php";

    //if customer logins, email session is set in user_verify.php
    if (isset($_SESSION['email'])){
        $customer = getCustomerInfoByEmail($_SESSION['email']);
    }

?>

<style>
 .center {
  height: 500px;
  display: flex;
  align-items: center;
  justify-content: center;
 }
</style>

<!-- Now need to make editable PROFILE 😪😪😪😪 -->
<div class="container">
    <h1>Edit Profile</h1>
    <hr>
    <div class="row">
      <div class="col-md-7">
        <div class="alert alert-info alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a>
                    <i class="fa fa-coffee"></i> You can edit and update your profile information. 
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">

        <!-- edit right form column -->
        <div class="col-md-8 personal-info">
        <h3 style="padding-left:10px;">Personal info</h3>
        <br>
            <form class="form-horizontal" role="form" method="post" action="update_user.php" enctype="multipart/form-data" style="padding:20px; background-color:gainsboro" >
                <div class="form-group">
                    <label class="col-lg-3 control-label">First name:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?php echo $customer['firstname']?>" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Last name:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?php echo $customer['lastname']?>" name="lastname">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?php echo $customer['email']?>" name="email" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Address:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?php echo $customer['address']?>" name="address">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">City:</label>
                    <div class="col-lg-8">
                        <div class="ui-select">
                            <select id="user_city" class="form-control" name="city">
                                <option selected><?php echo $customer['city']?></option>
                                <option>Kathmandu</option>
                                <option>Pokhara</option>
                                <option>Lalitpur</option>
                                <option>Bhaktapur</option>
                                <option>Butwal</option>
                                <option>Hetauda</option>
                                <option>Bharatpur</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Zipcode</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" value="<?php echo $customer['zipcode']?>" name="zipcode">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Card Number:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?php echo $customer['cardnumber']?>" name="cardnumber">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Expiry Date:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="date" value="<?php echo $customer['expiry_date']?>" name="expiry_date">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">CVV:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="password" value="<?php echo $customer['cvv']?>" name="cvv">
                    </div>
                </div>
                <!-- <div class="form-group">
                    <label class="col-md-3 control-label">Profile Picture</label>
                    <div class="col-md-8">
                        <input class="form-control" type="file" name="image">
                    </div>
                    <p style="color: red; font-size:small;">
                        <?php
                            if (isset($_SESSION['upload_msg']))
                            {
                              echo $_SESSION['upload_msg'];
                              unset ($_SESSION['upload_msg']);
                            }
                        ?>
                    </p>
                </div> -->
                <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="password" value="<?php echo $customer['password']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm password:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="password" value="<?php echo $customer['password']?>" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="submit" class="btn btn-primary" value="Save Changes">
                        <span></span>
                        <input type="reset" id="reset" class="btn btn-default" value="Cancel" onclick="reset_form()">
                        <br>
                        <p style=" font-size:small;">
                          <?php
                              if (isset($_SESSION['profile_msg1']))
                              {
                                echo '<p style="color: red; font-size: small;">'.$_SESSION['profile_msg1'].'</p>';
                                unset ($_SESSION['profile_msg1']);
                              }
                              if (isset($_SESSION['profile_msg2']))
                              {
                                echo '<p style="color: green; font-size: small;">'.$_SESSION['profile_msg2'].'</p>';
                                unset ($_SESSION['profile_msg2']);
                              }
                          ?>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<hr>


<!-- On clicking Cancel button -->
<script>
function reset_form() {
  document.getElementById("reset").reset();
}
</script>
<!-- JS script ends here -->


<?php 
    if(isset($conn)) {
            mysqli_close($conn);
    }

    require_once "./template/footer.php";

?>