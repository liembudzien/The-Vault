<?php
// Start the session
session_start();
if (!(isset($_SESSION["login"]))){
    $_SESSION["login"] = "no";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>The Vault - Contact Us</title>
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
                    <li><a href="memberhome.php">Member Home</a></li>
                    <li><a href="buy.php">Subscribe</a></li>
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
                <h1>Contact Us</h1>
                <p class="mb-0">Reach out if you have any questions or concerns!</p>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <!-- <div class="container"> -->
      <!-- php code for submitting -->
    <?php
        //Import PHPMailer classes into the global namespace
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        require 'vendor/autoload.php';

        //vars for changing the form box colors
        $yvalid = "form-control is-valid"; 
        $invalid = "form-control is-invalid";
        $emp = "form-control";
        //vars for the inputs and the error messages 
        $errEmail = $errFirst= $errLast= $errSubject= $errMessage= "";
        $email = $first = $last = $subject= $message= "";
        
        if(isset($_POST["submit"])) {
            $email = $_POST['email'];
            $first = $_POST['first'];
            $last = $_POST['last'];
            $valid=true;
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com port=5432 dbname=d81pqnbohorfk0 user=ddsgwogqfbfyyv password=751ab46d5dac57762560abf99367ea2cac7cf7e81ebab8719935e8d7fd244db3");

            // Check if first name has been entered
            if(empty($_POST['first']) || (preg_match("/^[a-zA-Z]+$/", $_POST["first"]) === 0)){
                $errFirst= 'Please enter your first name, letters only.';
                $valid=false;
            }

            // Check if last name has been entered
            if(empty($_POST['last']) || (preg_match("/^[a-zA-Z]+$/", $_POST["last"]) === 0)){
                $errLast= 'Please enter your last name, letters only.';
                $valid=false;
            }
            
            // Check if email has been entered and is valid -- this is already checked more by the code, so mostly useless
            if(empty($_POST['email']) || (preg_match("/^[^@]+@[^@]+\.[^@]+$/", $_POST["email"]) === 0)) {
                $errEmail = '<p class="errText"> All emails must have a @ and a .</p>';
                $valid=false;
            }
            
            //check for subject input 
            if(empty($_POST['subject'])) {
              $errSubject= '<p class="errText">Please provide a subject</p>';
              $valid=false;
            }

            //check for state input 
            if(empty($_POST['message'])) {
              $errMessage= '<p class="errText">You cannot leave the message blank!</p>';
              $valid=false;
            }

            if($valid){
                echo '<div class="row justify-content-center" style="font-size:1.5em;color:green" >The form has been submitted</div>';
                $query = "INSERT INTO contact VALUES ('$email', '$first', '$last', '$message', '$subject')";
                $result = pg_query($db_connection, $query);

                $name = $first . ' ' . $last;
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                $mail->Username = 'thevaultp@gmail.com';
                $mail->Password = 'Vault100!';
                $mail->setFrom('customerservice@thevault.com', $name);
                $mail->addReplyTo($email, $first);
                $mail->addAddress('thevaultp@gmail.com', 'Contact Form');
                $mail->Subject = $subject;
                $mail->Body = $message;
                //Replace the plain text body with one created manually
                $mail->AltBody = 'Message from Contact Form';
                //send the message, check for errors
                $mail->send();
            }
            else{
              echo '<div class="row justify-content-center" style="font-size:1.25em;color:red" >Please completely fill out the form!</div>';
            }
        }
    ?>
    <!-- end php code -->

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5"  data-aos="fade">

            

            <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="p-5 bg-white">
             

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="inputFirst">First Name</label>
                  <input type="text" id="inputFirst" name="first" placeholder="First Name" class=" <?php
                    if($errFirst == "" && ($first != "")){
                      echo $yvalid;
                    }
                    else if($errFirst != ""){
                      echo $invalid;
                    }
                    else{
                      echo $emp;
                    } ?>"

                    value="<?php echo $first; ?>" autofocus>
                    <span class="error"> <?php echo $errFirst; ?> </span>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="inputLast">Last Name</label>
                  <input type="text" id="inputLast" name="last" placeholder="Last Name" class=" <?php
                    if($errLast == "" && ($last != "")){
                      echo $yvalid;
                    }
                    else if($errLast != ""){
                      echo $invalid;
                    }
                    else{
                      echo $emp;
                    } ?>"

                    value="<?php echo $last; ?>" autofocus>
                    <span class="error"> <?php echo $errLast; ?> </span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="inputEmail">Email</label> 
                  <input type="email" id="inputEmail" name="email" placeholder="Your Email" class=" <?php
                    if($errEmail == "" && ($email != "")){
                      echo $yvalid;
                    }
                    else if($errEmail != ""){
                      echo $invalid;
                    }
                    else{
                      echo $emp;
                    } ?>"

                    value="<?php echo $email; ?>" autofocus>
                    <span class="error"> <?php echo $errEmail; ?> </span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="inputSubject">Subject</label> 
                  <input type="subject" id="inputSubject" name="subject" placeholder="Subject" class=" <?php
                    if($errSubject == "" && ($subject != "")){
                      echo $yvalid;
                    }
                    else if($errSubject != ""){
                      echo $invalid;
                    }
                    else{
                      echo $emp;
                    } ?>"

                    value="<?php echo $subject; ?>" autofocus>
                    <span class="error"> <?php echo $errSubject; ?> </span>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="inputMessage">Message</label> 
                  <textarea type="message" name="message" id="inputMessage" cols="30" rows="7" placeholder="Write your notes or questions here..." class=" <?php
                    if($errMessage == "" && ($message != "")){
                      echo $yvalid;
                    }
                    else if($errMessage != ""){
                      echo $invalid;
                    }
                    else{
                      echo $emp;
                    } ?>"

                    value="<?php echo $message; ?>" autofocus>
                    
                  </textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5"  data-aos="fade" data-aos-delay="100">
            
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">1826 University Ave Charlottesville, Virginia, 22904, USA</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">customerservice@thevault.com</a></p>

            </div>
            
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">More Info</h3>
              <p>Does you message not fit within an email? We have customer service representatives ready to assist you with any questions or concerns about our product.
                Drop us a call during any business hours and we're happy to take your call!</p>
              <p><a href="#" class="btn btn-primary px-4 py-2 text-white">Learn More</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center border-primary">
            <h2 class="font-weight-light text-primary">Frequently Asked Questions</h2>
            <p class="color-black-opacity-5">See below for commonly asked questions, answered.</p>
          </div>
        </div>


        <div class="row justify-content-center">
          <div class="col-8">
            <div class="border p-3 rounded mb-2">
              <a data-toggle="collapse" href="#collapse-1" role="button" aria-expanded="false" aria-controls="collapse-1" class="accordion-item h5 d-block mb-0">How much does The Vault cost?</a>

              <div class="collapse" id="collapse-1">
                <div class="pt-2">
                  <p class="mb-0">The price depends on the subscription plan. Monthly all access plans cost $15.99 a month, while Annual plans are $9.99 a month (annualized). Outside of
                    the monthly and annual plans, we also offer individual games on a subscription basis, for $3.99 a month.</p>
                </div>
              </div>
            </div>

            <div class="border p-3 rounded mb-2">
              <a data-toggle="collapse" href="#collapse-4" role="button" aria-expanded="false" aria-controls="collapse-4" class="accordion-item h5 d-block mb-0">Is this available in my country?</a>

              <div class="collapse" id="collapse-4">
                <div class="pt-2">
                  <p class="mb-0">Right now, we currently offer our product to consumers in the United States, Canada, and the United Kingdom. Stay tuned for future expansion of
                    availability!</p>
                </div>
              </div>
            </div>

            <div class="border p-3 rounded mb-2">
              <a data-toggle="collapse" href="#collapse-2" role="button" aria-expanded="false" aria-controls="collapse-2" class="accordion-item h5 d-block mb-0">My games aren't loading.</a>

              <div class="collapse" id="collapse-2">
                <div class="pt-2">
                  <p class="mb-0">Be sure to double check your internet connection before playing any games. We use an online system to ensure the integrity of the
                    subscription pass and to optimize multiplayer environments. We recommend at least 25 mbps download and 10 mbps upload for smooth operation.</p>
                </div>
              </div>
            </div>

            <div class="border p-3 rounded mb-2">
              <a data-toggle="collapse" href="#collapse-3" role="button" aria-expanded="false" aria-controls="collapse-3" class="accordion-item h5 d-block mb-0">What if I have multiple computers?</a>

              <div class="collapse" id="collapse-3">
                <div class="pt-2">
                  <p class="mb-0">You can use our product on as many computers as you like! Simply log in and enjoy access to all of your games, instantly. However, there
                    is a limit on active sessions. You may only actively play one game at a time on your account.</p>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        
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