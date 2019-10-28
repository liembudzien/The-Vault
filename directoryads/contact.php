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
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li> <!--  class="has-children"> -->
                  <a href="listings.html">Games</a>
                  <!-- <ul class="dropdown">
                    <li><a href="#">The Company</a></li>
                    <li><a href="#">The Leadership</a></li>
                    <li><a href="#">Philosophy</a></li>
                    <li><a href="#">Careers</a></li>
                  </ul> -->
                </li>
                <!-- <li><a href="blog.html">Blog</a></li> -->
                <li><a href="Buy.php">Subscribe</a></li>
                <li class="mr-5"><a href="contact.html">Contact Us</a></li>

                <li class="ml-xl-3 login"><a href="login.php"><span class="border-left pl-xl-4"></span>Log In</a></li>

                <li><a href="register.php" class="cta"><span class="bg-primary text-white rounded">Register</span></a></li>
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

            // Check if first name has been entered
            if(empty($_POST['first']) || (preg_match("/^([a-zA-Z]+|[a-zA-Z]+\s{1}[a-zA-Z]{1,}|[a-zA-Z]+\s{1}[a-zA-Z]{3,}\s{1}[a-zA-Z]{1,})$/", $_POST["user"]) === 0)){
                $errName= 'Please enter your first name. No sepcial characters (!, @, #, etc.) or numbers.';
                $valid=false;
            }

            // Check if last name has been entered
            if(empty($_POST['last']) || (preg_match("/^([a-zA-Z]+|[a-zA-Z]+\s{1}[a-zA-Z]{1,}|[a-zA-Z]+\s{1}[a-zA-Z]{3,}\s{1}[a-zA-Z]{1,})$/", $_POST["user"]) === 0)){
                $errName= 'Please enter your last name. No sepcial characters (!, @, #, etc.) or numbers.';
                $valid=false;
            }
            
            // Check if email has been entered and is valid -- this is already checked more by the code, so mostly useless
            if(empty($_POST['email']) || (preg_match("/^[^@]+@[^@]+\.[^@]+$/", $_POST["email"]) === 0)) {
                $errEmail = '<p class="errText"> All emails must have a @ and a .</p>';
                $valid=false;
            }
            
            // Check if address has been entered and matches correct format
            if(empty($_POST['address']) || (preg_match("/^\d+\s[A-z]+\s[A-z]+$/", $_POST["address"]) === 0) ){
                $errAddr= '<p class="errText">Address must contain address number and street name and street type (i.e. dr, blvd, etc.).</p>';
                $valid=false;
            }
            // Check if name has been entered
            if(empty($_POST['city']) || (preg_match("/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/", $_POST["city"]) === 0)) {
              $errCity= '<p class="errText">Please enter your city. No sepcial characters (!, @, #, etc.) or numbers.</p>';
              $valid=false;
            }
            //check for state input 
            if(empty($_POST['state'])) {
              $errState= '<p class="errText">Please select a state</p>';
              $valid=false;
            }
            
            // Check if zipcode has been entered in the correct format
            if(empty($_POST['zipcode']) || (preg_match("/^\d{5}$/", $_POST["zipcode"]) === 0) ){
                $errZipcode= '<p class="errText">Zipcode must be 5 numbers</p>';
                $valid=false;
            }
            

            if($valid){
                if($valid){
                  echo '<div class="row justify-content-center" style="font-size:1.5em;color:green" >The form has been submitted</div>';
                }
               
                /**
                * This example shows settings to use when sending via Google's Gmail servers.
                * This uses traditional id & password authentication - look at the gmail_xoauth.phps
                * example to see how to use XOAUTH2.
                * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
                */
                //Create a new PHPMailer instance
                $mail = new PHPMailer;

                $body = file_get_contents('email/email.html');

                //Tell PHPMailer to use SMTP
                $mail->isSMTP();
                //Enable SMTP debugging
                // SMTP::DEBUG_OFF = off (for production use)
                // SMTP::DEBUG_CLIENT = client messages
                // SMTP::DEBUG_SERVER = client and server messages
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                //Set the hostname of the mail server
                $mail->Host = 'smtp.gmail.com';
                // use
                // $mail->Host = gethostbyname('smtp.gmail.com');
                // if your network does not support SMTP over IPv6
                //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                $mail->Port = 587;
                //Set the encryption mechanism to use - STARTTLS or SMTPS
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                //Whether to use SMTP authentication
                $mail->SMTPAuth = true;
                //Username to use for SMTP authentication - use full email address for gmail
                $mail->Username = 'thevaultp@gmail.com';
                //Password to use for SMTP authentication
                $mail->Password = 'Vault100!';
                //Set who the message is to be sent from
                $mail->setFrom('customerservice@thevault.com', 'The Vault');
                //Set an alternative reply-to address
                $mail->addReplyTo('thevaultp@gmail.com', 'The Vault');
                //Set who the message is to be sent to
                $mail->addAddress($email, $name);
                //Set the subject line
                $mail->Subject = 'Hello from The Vault';
                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                $mail->msgHTML($body, 'email');
                //Replace the plain text body with one created manually
                $mail->AltBody = 'Welcome to The Vault';
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

            

            <form action="#" class="p-5 bg-white">
             

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" id="fname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" id="lname" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input type="subject" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4 text-white">
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