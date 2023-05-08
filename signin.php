<?php
	$title = "User Signin";
	require_once "./template/header.php";
?>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!--Get your own code at fontawesome.com-->

<style>
    /* .bg-image-vertical {
position: relative;
overflow: hidden;
background-repeat: no-repeat;
background-position: right center;
background-size: auto 100%;
}

@media (min-width: 900px) {
.h-custom-2 {
height: 100%;
}
} */


.bg-img {
  /* The image used */
  background-image: url("./bootstrap/img/signin.jpg");

  /* Control the height of the image */
  min-height: 600px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

/* Add styles to the form container */
.container1 {
  position: absolute;
  right: 0;
  margin: 20px;
  max-width: 300px;
  padding: 16px;
  background-color: white;
  padding-top:10px;
  margin-top:100px;
  opacity:0.9;
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
  margin-bottom: 5px;
}

.btn:hover {
  opacity: 1;
}
</style>

<!-- Signin form -->

<div class="container-fluid-lg">
    <div class="bg-img">

        <form method="post" action="user_verify.php" class="container1">
            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
            <br>
              <div class="form-outline mb-4">
              <label class="form-label" for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control form-control-lg" placeholder="Enter your email" name="email"/>
              <!-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> -->
              <?php
                if (isset($_SESSION['email_msg']))
                {
                  echo '<p style="color: red; font-size: small;">'.$_SESSION['email_msg'].'</p>';
                  unset ($_SESSION['email_msg']);
                }
                else
                {
                  echo '<small class="form-text text-muted">'."We'll never share your email with anyone else.".'</small>';
                }
              ?>
              </div>
                <br>
              <div class="form-outline mb-4">
              <label class="form-label" for="exampleInputPassword1">Password</label>
              <input type="password"  class="form-control form-control-lg" placeholder="Enter your password" name="password"/>
              <p style="color: red; font-size: small;">
                <?php
                  if (isset($_SESSION['pwd_msg']))
                  {
                    echo $_SESSION['pwd_msg'];
                    unset ($_SESSION['pwd_msg']);
                  }
                ?>
              </p>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="autoSizingCheck2">
                <label class="form-check-label" for="autoSizingCheck2">
                    Remember me
                </label>
              </div>
                <br>
              <div class="pt-1 mb-4">
              <button class="btn btn-info btn-md" type="submit">Login</button>
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
              <p>Don't have an account? <a href="signup.php" class="link-info" style="color:blueviolet;">Register here</a></p>
              <p style="color: red; font-size: small;">
                <?php
                  if (isset($_SESSION['msg']))
                  {
                    echo $_SESSION['msg'];
                    unset ($_SESSION['msg']);
                  }
                ?>
              </p>
            </form>
    </div>
</div>


<hr>
<?php
	require_once "./template/footer.php";
?>