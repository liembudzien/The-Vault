<?php
// Start the session
session_start();
if (!(isset($_SESSION["login"]))){
  $_SESSION["login"] = "no";
}
if ($_SESSION["login"] != "yes"){ // if not logged in, redirect
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>The Vault - Buy Now</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/rangeslider.css">

    <link rel="stylesheet" href="css/style.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar container py-0 " role="banner">

      <!-- <div class="container"> -->
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><img src="images/logo.png" alt="Image" class="img-fluid rounded"></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <?php 
                  if ($_SESSION["login"] === "yes"){ //if you are logged in - show member home page
                    ?>
                    <li><a href="buy.php">Subscribe</a></li>
                    <li><a href="memberhome.php">Member Home</a></li>
                <?php
                  }
                ?>
                  <!-- <ul class="dropdown">
                    <li><a href="#">The Company</a></li>
                    <li><a href="#">The Leadership</a></li>
                    <li><a href="#">Philosophy</a></li>
                    <li><a href="#">Careers</a></li>
                  </ul> -->
                <!-- <li><a href="blog.html">Blog</a></li> -->
                
                <li class="mr-5"><a href="contact.php">Contact Us</a></li>
                <?php 
                  if ($_SESSION["login"] === "yes"){ //if you are logged in - show logout page 
                    ?>
                    <li class="ml-xl-3 login"><a href="login.php"><span class="border-left pl-xl-4"></span></a></li>
                    <li><a href="logout.php" class="cta"><span class="bg-primary text-white rounded ">Logout</span></a></li>
                <?php
                  }
                ?>
                  <?php 
                  if ($_SESSION["login"] != "yes"){ // if not logged in show the login and register pages
                    ?>
                    <li class="ml-xl-3 login"><a href="login.php"><span class="border-left pl-xl-4"></span>Log In</a></li>
                    <li><a href="register.php" class="cta"><span class="bg-primary text-white rounded">Register</span></a></li>
                <?php
                  }
                ?>
                
              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-auto py-3 col-6 text-right" style="position: relative; top: 3px;">
            <a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a>
          </div>

        </div>
      <!-- </div> -->
      
    </header>

  
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/dark-background.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1>Buy Now!</h1>
                <p class="mb-0">---</p>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  


    <div class="site-section ">

    <div class="container">
<div class="row">
  <div class="col-md-4 mb-lg-5">
	<figure class="card card-product">
		<div class="img-wrap"><img src="images/1-month.png" alt="Image" class="img-fluid mb-1"></div>
		<figcaption class="info-wrap">
				<h4 class="title"> 1 Month All Access</h4>
				<p class="desc">Get 1 month of access to all games</p>
    </figcaption>
    	<div class="price-wrap h5">
				<span class="price-new"> $15.99</span> <del class="price-old"> $19.99</del>
			</div> <!-- price-wrap.// -->
		<div class="bottom-wrap">
			
    <form action="https://test.bitpay.com/checkout" method="post" >
  <input type="hidden" name="action" value="cartAdd" />
  <input type="hidden" name="data" value="PA7Y1TcQGm55E18KZ9Vrfk" />
  <input type="image" src="https://test.bitpay.com/cdn/en_US/bp-btn-pay-currencies.svg" name="submit" style="width: 168px;" alt="BitPay, the easy way to pay with bitcoins." >
</form>
		
		</div> <!-- bottom-wrap.// -->
	</figure>
</div> <!-- col // -->
<div class="col-md-4 mb-lg-5">
	<figure class="card card-product">
		<div class="img-wrap"><img src="images/6-months.png" alt="Image" class="img-fluid mb-1"></div>
		<figcaption class="info-wrap">
				<h4 class="title"> 6 Month All Access</h4>
				<p class="desc">Get 6 months of access to all games</p>
    </figcaption>
    	<div class="price-wrap h5">
				<span class="price-new"> $77.99</span> <del class="price-old"> $95.99</del> <mark class="bg-info"> Save 20%</mark>  
			</div> <!-- price-wrap.// -->
		<div class="bottom-wrap">
			
    <form action="https://test.bitpay.com/checkout" method="post" >
  <input type="hidden" name="action" value="cartAdd" />
  <input type="hidden" name="data" value="NCwJeVrvC8hLcGiskvcKtg" />
  <input type="image" src="https://test.bitpay.com/cdn/en_US/bp-btn-pay-currencies.svg" name="submit" style="width: 168px;" alt="BitPay, the easy way to pay with bitcoins." >
</form>
		
		</div> <!-- bottom-wrap.// -->
  </figure>
    </div>
  <div class="col-md-4 mb-lg-5">
	<figure class="card card-product">
		<div class="img-wrap"><img src="images/1-year.png" alt="Image" class="img-fluid mb-1"></div>
		<figcaption class="info-wrap">
				<h4 class="title"> 1 Year All Access</h4>
				<p class="desc">Get 1 Year of access to all games</p>
    </figcaption>
    	<div class="price-wrap h5">
				<span class="price-new"> $107.99</span> <del class="price-old"> $191.99</del> <mark class="bg-info"> Save 45%</mark>  
			</div> <!-- price-wrap.// -->
		<div class="bottom-wrap">
			
    <form action="https://test.bitpay.com/checkout" method="post" >
  <input type="hidden" name="action" value="cartAdd" />
  <input type="hidden" name="data" value="5fED291gTrqXpxRSWT97Ur" />
  <input type="image" src="https://test.bitpay.com/cdn/en_US/bp-btn-pay-currencies.svg" name="submit" style="width: 168px;" alt="BitPay, the easy way to pay with bitcoins." >
</form>
		
		</div> <!-- bottom-wrap.// -->
	</figure>
</div> <!-- col // -->
</div> <!-- row.// -->
</div>
</div> 

  


    <div class="newsletter bg-primary py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h2>Sign up for updates to our product!</h2>
            <p>To hear the latest updates and promotions, enter your email on the right.</p>
          </div>
          <div class="col-md-6">
            
            <form class="d-flex">
              <input type="text" class="form-control" placeholder="Email">
              <input type="submit" value="Subscribe" class="btn btn-white"> 
            </form>
          </div>
        </div>
      </div>
    </div>
    
   

    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-6">
                <h2 class="footer-heading mb-4">About</h2>
                <p>We are a subscription service revolutionizing the gaming industry. Say goodbye to spending $60 on a single game, and enjoy 
                  full access to our entire library for a low price.</p>
              </div>
              
              <div class="col-md-3">
                <h2 class="footer-heading mb-4">Navigations</h2>
                <ul class="list-unstyled">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Games</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-3">
                <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <form action="#" method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Search products..." aria-label="Enter Email" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary text-white" type="button" id="button-addon2">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/rangeslider.min.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>