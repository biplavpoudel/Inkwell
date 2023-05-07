<?php
	$title = "User SignUp";
	require_once "./template/header.php";
?>

<!-- For Icons -->
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<style>

.bg-img {
  /* The image used */
  background-image: url("./bootstrap/img/login1.jpg");

  /* Control the height of the image */
  min-height: 700px;

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
  margin-top:70px;
  opacity: 0.9;
  background-image: linear-gradient(to bottom, #A1BED2,#C9D9DA, #D2D8D0, white);
  /* margin-bottom:15px; */
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
        <form action="user_verify.php" class="container1">
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
                <input type="text" class="form-control" name="zip">
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button><br>
            <br>
            <p>Already have an account? <a href="signin.php" class="link-info" style="color:blueviolet;">Login here</a></p>
        </form>
    </div>
</div>

<!-- Form Validation -->
<!-- Can be improved hai -->
<?php
    $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";    //e.g. http://localhost/Inkwell/signup.php
    if(strpos($fullurl,"signup=empty")==true){
        echo '<p style="color:red">You did not fill in all the fields.</p>';
        exit();
    }
    if(strpos($fullurl,"signup=invalidemail")==true){
        echo '<p style="color:red">You did not enter a valid email address.</p>';
        exit();
    }
?>

<hr>
<?php
	require_once "./template/footer.php";
?>