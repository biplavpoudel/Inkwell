<!DOCTYPE html>

<head>
    <script src="../assets/js/color-modes.js"></script>

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }

      a{
        color:black;
      }

      #footer{
        /* position:fixed; */
         bottom:0;
      }
    </style>

    
  </head>

<body>
    


<hr style="margin:0 0 1px 0;">
<!--Quicklinks  -->
<div id="footer" class="container-flex" style="background-color:aliceblue; padding-top:50px; padding-left:200px; line-height:0.8em;">
  <footer class="py-6">
    <div class="row">
      <div class="col-6 col-md-2 mb-4">
        <!-- <h5 style="font-weight:bold;">Quicklinks</h5> -->
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a style="color:#712cf9; font-weight:bold; font-size:15px;">Quicklinks</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Book Requests</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Booksellers</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">New Arrivals</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Blogs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Used Books</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-4">
        <!-- <h5 style="font-weight:bold;">About</h5> -->
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a style="color:#712cf9; font-weight:bold; font-size:15px;">About</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Contact Us</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Careers</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About Us</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-4">
        <!-- <h5 style="font-weight:bold;">Popular Genre</h5> -->
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a style="color:#712cf9; font-weight:bold; font-size:15px;">Popular Genre</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Fiction</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Self Help</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Business</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Children</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Adult</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-3 mb-4">
        <!-- <h5 style="font-weight:bold;">Contact</h5> -->
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a style="color:#712cf9; font-weight:bold; font-size:15px;">Contact</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary"><span class="glyphicon glyphicon-home"></span>&nbsp;Pokhara, Nepal</a></li>
          <li class="nav-item mb-2"><a href="mailto: biplavpoudel764@gmail.com"" class="nav-link p-0 text-body-secondary"><span class="glyphicon glyphicon-envelope"></span>&nbsp;biplavpoudel764@gmail.com</a></li>
          <!-- <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary"><span class="glyphicon glyphicon-phone"></span>&nbsp;+977-9869141978</a></li> -->
          <li class="nav-item mb-2"><a href="https://www.facebook.com/biplav.poudel.10/" class="nav-link p-0 text-body-secondary"><i class="bi bi-facebook"></i>  Facebook</a></li>
          <li class="nav-item mb-2"><a href="https://twitter.com/biplavpoudel_" class="nav-link p-0 text-body-secondary"><i class="bi bi-twitter"></i>  Twitter</a></li>
          <li class="nav-item mb-2"><a href="https://www.instagram.com/_poudel_biplav/" class="nav-link p-0 text-body-secondary"><i class="bi bi-instagram"></i>  Instagram</a></li>
        </ul>
      </div>
    </div>
    </footer>
</div>  
<hr style="margin:0 0 1px 0">

<div id="footer" class="d-flex flex-column" style="background-color:lightcyan;">
  <!-- <p>&copy; 2023 InkWell, Inc.  All rights reserved.</p> -->
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: biege;">
      © 2023 Copyright:
      <a class="text-white" href="https://github.com/biplavpoudel"> Biplav Poudel    <span class="flag-icon flag-icon-np flag-icon-circle"></span></a>
    </div>
    <!-- Copyright -->
</div>
</body>
