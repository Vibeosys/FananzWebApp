<?php
   $this->layout = 'home_layout';
   echo $this->element('header'); 
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Fananz | Login</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="keywords" content="" />
      <link rel="shortcut icon" href="favicon/favicon-16x16.png" type="image/x-icon">
      <link rel="icon" href="favicon/favicon-16x16.png" type="image/x-icon">
      <!-- css -->
      <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
      <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
      <link rel="stylesheet" href="css/slider-setting.css" type="text/css" media="all" />
      <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all" />
      <!--// css -->
      <!-- font -->
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i,900,900i" rel="stylesheet">
      <!--
         <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
           <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
           <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
         -->
      <!-- //font -->
   </head>
   <body>
      
      <section class="login">
         <div class="container">
            <div class="row">
               <div class="login-wrapper">
                  <div class="login-form-container">
                     <div class="col-lg-12">
                        <div class="login-social">
                           <h2>Sign In</h2>
                           <!--                            <h3>Sign in with social</h3>-->
                        </div>
                        <div class="social-login-btn">
                           <div class="fb-btn">
                              <a href=""><span class="icon"><i class="fa fa-facebook"></i></span> <span class="social-text">Login with Facebook</span></a>
                           </div>
                        </div>
                        <!--
                           <div class="social-login-btn">
                               <div class="tw-btn">
                                   <a href=""><span class="icon"><i class="fa fa-twitter"></i></span> <span class="social-text">Login with Twitter</span></a>
                               </div>
                            <div class="social-login-btn">
                               <div class="gp-btn">
                                   <a href=""><span class="icon"><i class="fa fa-google-plus"></i></span> <span class="social-text">Login with Google+</span></a>
                               </div>
                           </div>
                           -->
                     </div>
                     <div class="col-lg-12">
                        <div class="line-or">
                           <span>OR</span>
                        </div>
                     </div>
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-top-130">
                        <div class="form-group">
                           <label for="user_email">Email
                           <input type="email" id="user_email" class="form-control" name="name">
                           <span class="input-icon"><i class="fa fa-user"></i></span>
                           </label>
                        </div>
                        <div class="form-group">
                           <label for="user_pwd">Password <span class="forgot-pwd"><a href="#fogotpasswordModal" data-toggle="modal">Forgot password?</a></span>
                           <input type="email" id="user_pwd" class="form-control" name="password">
                           <span class="input-icon"><i class="fa fa-lock"></i></span>
                           </label>
                        </div>
                        <div class="form-group login-check">
                           <input type="checkbox" id="brand" value="">
                           <label for="brand"><span></span> Remember me</label>
                        </div>
                     </div>
                     <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                           <div class="login-button-set">
                              <a href="user_register.html" class="user-register">Register Now</a>   
                              <button type="submit" title="Submit" class="button black_sm">Sign In</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <div class="modal fade" id="fogotpasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="forgot_passowrd-popup">
                  <div class="header-modal">
                     <h1>Forgot Your Password?</h1>
                  </div>
                  <div class="modal-body">
                     <form action="" method="post">
                        <h3>RETRIEVE YOUR PASSWORD HERE</h3>
                        <p>Please enter your email address below. You will receive a link to reset your password.</p>
                        <div class="form-group">
                           <label for="user_email">Email
                           <input type="email" id="user_email" class="form-control" name="email">
                           <span class="input-icon"><i class="fa fa-user"></i></span>
                           </label>
                        </div>
                        <div class="forgot_set">
                           <button type="submit" title="Submit" class="button black_sm">Submit</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <footer class="footer">
         <div class="container">
            <div class="col-md-3 footer-grids fgd1">
               <a href="index.html">
                  <h3>Fananz</h3>
               </a>
               <ul>
                  <li>1234k Avenue, 4th block,</li>
                  <li>Dubai.</li>
                  <li><a href="mailto:info@example.com">info@example.com</a></li>
                  <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                  <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
               </ul>
            </div>
            <div class="col-md-3 footer-grids fgd2">
               <h4>Information</h4>
               <ul>
                  <li><a href="">About Us</a></li>
                  <li><a href="">Partner with Us</a></li>
                  <li><a href="">Policies</a></li>
                  <li><a href="">FAQ's</a></li>
               </ul>
            </div>
            <div class="col-md-3 footer-grids fgd3">
               <h4>Categories</h4>
               <ul>
                  <li><a href="categories.html">Artists</a></li>
                  <li><a href="">Media</a></li>
                  <li><a href="">Event</a></li>
                  <li><a href="">Model</a></li>
                  <li><a href="">Birthday</a></li>
                  <li><a href="">NightLife</a></li>
               </ul>
            </div>
            <div class="col-md-3 footer-grids fgd4">
               <h4>Contact</h4>
               <ul>
                  <li><a href="">Contact Us</a></li>
                  <li><a href="login.html">Login</a></li>
                  <li><a href="admin_login.html">Admin Login</a></li>
               </ul>
            </div>
            <div class="clearfix"></div>
            <p class="copy-right">© 2016 Fananz . All rights reserved | Design by <a href="http://vibeosys.com" target="_blank"> Vibeosys</a></p>
         </div>
      </footer>
      <!-- //cart-js -->  
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>