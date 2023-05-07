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

<!-- <div class="container"> -->
    <!-- <form  class="form-horizontal" method="post" action="user_verify.php">
      <div class="form-group row">
        <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter your username" name="username">
          <small class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
      </div>
      <div class="form-group row">
        <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
      </div>
    </form> -->

    <!-- <section class="vh-100">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 text-black"  style="margin-top:100px;">

            <div class="px-5 ms-xl-4">
              <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
              <span class="h1 fw-bold mb-0">Logo</span>
            </div>

            <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

              <form style="width: 23rem;">

                <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

                <div class="form-outline mb-4">
                  <input type="email" id="form2Example18" class="form-control form-control-lg" />
                  <label class="form-label" for="form2Example18">Email address</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="form2Example28" class="form-control form-control-lg" />
                  <label class="form-label" for="form2Example28">Password</label>
                </div>

                <div class="pt-1 mb-4">
                  <button class="btn btn-info btn-lg btn-block" type="button">Login</button>
                </div>

                <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p>

              </form>

            </div>

          </div>
          <div class="col-sm-4  px-0 d-none d-sm-block">
            <img src="./bootstrap/img/signin.jpg" alt="Login image" class="w-100 vh-100 float-left" style="object-fit:cover; object-position: left; height: 500px;">
          </div>
        </div>
      </div>
    </section> -->
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
              <button class="btn btn-info btn-md" type="button">Login</button>
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