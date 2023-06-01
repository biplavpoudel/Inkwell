<?php
	$title = "User SignUp";
	require "./template/header.php";
?>

<!-- For Icons -->
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<style>

.bg-img {
  /* The image used */
  background-image: url("./bootstrap/img/login1.jpg");

  /* Control the height of the image */
  min-height: 720px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

/* Add styles to the form container */
.container1 {
  float:left;
  /* position: absolute; */
  right: 0;
  margin: 20px;
  max-width: 400px;
  padding: 16px;
  background-color:whitesmoke;
  padding-top:20px;
  margin-top:60px;
  opacity: 0.9;
  background-image: linear-gradient(to bottom, #A1BED2,#C9D9DA, #D2D8D0, white);
}

/* Full-width input fields */
  input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.btn {
  background-color: #04AA6D;
  color: white;
  padding: 10px 15px; 
  border: none;
  cursor: pointer;
  /* width: 50%; */
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>


<!-- Signup form -->

<div class="container-fluid-lg">
    <div class="bg-img">
        <form action="user_signup.php" class="container1" method="post" style="border-style:none ;">
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; padding-left: 15px;">Register Your Account</h3>
            <br><br>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputFname">Firstname</label>
                <input type="text" class="form-control" name="firstname" placeholder="Firstname">
              </div>
              <div class="form-group col-md-6">
                <label for="inputLname">Lastname</label>
                <input type="text" class="form-control" name="lastname" placeholder="Lastname">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email">
                <p style="color:red; font-size:small;">
                  <?php
                      if (isset($_SESSION['msg2']))
                      {
                        echo $_SESSION['msg2'];
                        unset ($_SESSION['msg2']);
                      }
                  ?>
                </p>
              </div>
            </div>    
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputPassword">Password</label>
                <input type="text" class="form-control" name="password" placeholder="Password">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Maitrinagar">
              </div>
              <div class="form-group col-md-4">
                <label for="inputCity">City</label>
                <select name="city" class="form-control">
                  <option selected>Kathmandu</option>
                  <option>Pokhara</option>
                  <option>Lalitpur</option>
                  <option>Bhaktapur</option>
                  <option>Butwal</option>
                  <option>Hetauda</option>
                  <option>Bharatpur</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" name="zipcode">
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button><br>
            <br>
            <p>Already have an account? <a href="signin.php" class="link-info" style="color:blueviolet;">Login here</a></p>
            <p style="color:red; font-size:small;">
              <?php
                  if (isset($_SESSION['msg1']))
                  {
                    echo $_SESSION['msg1'];
                    unset ($_SESSION['msg1']);
                  }
              ?>
            </p>
        </form>
    </div>
</div>

<?php
	require_once "./template/footer.php";
?>