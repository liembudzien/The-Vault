<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>The Vault - Register</title>
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
    <style>
      .error {color: #FF0000;}
    </style>
    <style>
      .submited {color: #0FFF0F;} {size: 40}
    </style>
    <style>
    span.note {
    font-size: 120%;
    color: green;
}
    </style>
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
                <li> <!--  class="has-children"> -->
                  <!-- <a href="listings.html">Games</a> -->
                  <!-- <ul class="dropdown">
                    <li><a href="#">The Company</a></li>
                    <li><a href="#">The Leadership</a></li>
                    <li><a href="#">Philosophy</a></li>
                    <li><a href="#">Careers</a></li>
                  </ul> -->
                </li>
                <!-- <li><a href="blog.html">Blog</a></li> -->
              
                <li class="mr-5"><a href="contact.php">Contact Us</a></li>
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
        $errEmail = $errPass= $errName= $errAddr= $errZipcode= $errState= $errDuplicate = $errCity= $errForm= "";
        $email = $name = $password = $address= $state= $zipcode= $city= "";
        
        if(isset($_POST["submit"])) {
            $email = $_POST['email'];
            $name = $_POST['user'];
            $password = $_POST['password'];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $valid=true;
            $address = $_POST['address'];
            $state = $_POST['state'];
            $city = $_POST['city'];
            $zipcode = $_POST['zipcode'];
            $db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com port=5432 dbname=d81pqnbohorfk0 user=ddsgwogqfbfyyv password=751ab46d5dac57762560abf99367ea2cac7cf7e81ebab8719935e8d7fd244db3");

            // Check if name has been entered
            if(empty($_POST['user']) || (preg_match("/^([a-zA-Z]+|[a-zA-Z]+\s{1}[a-zA-Z]{1,}|[a-zA-Z]+\s{1}[a-zA-Z]{3,}\s{1}[a-zA-Z]{1,})$/", $_POST["user"]) === 0)){
                $errName= 'Please enter your first and last name separated by a space. No sepcial characters (!, @, #, etc.) or numbers.';
                $valid=false;
            }
            
            // Check if email has been entered and is valid -- this is already checked more by the code, so mostly useless
            if(empty($_POST['email']) || (preg_match("/^[^@]+@[^@]+\.[^@]+$/", $_POST["email"]) === 0)) {
                $errEmail = '<p class="errText"> All emails must have a @ and a .</p>';
                $valid=false;
            }
            
            // check if a valid password has been entered -- again checked by other code
            if(empty($_POST['password']) || (preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST["password"]) === 0)) {
                $errPass = '<p class="errText">Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit</p>';
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
            
            $test = pg_query($db_connection, "SELECT * from users where email='$email'");
            $num_rows = pg_affected_rows($test);
            if($num_rows > 0){
                $errDuplicate = '<p class="errText">Duplicate email address</p>';
                $valid=false;
            }

            if($valid){
                $query = "INSERT INTO users VALUES ('$name', '$email', '$address', '$city', '$state',  '$zipcode', '$hashed_password')";
                $result = pg_query($db_connection, $query);
                if($valid){
                  //echo '<div class="row justify-content-center" style="font-size:1.5em;color:green" >The form has been submitted</div>';
                   //php session redirect 
                $_SESSION["login"] = "yes";
                // echo '<div class="row justify-content-center" style="font-size:1.5em;color:green" >The form has been submitted</div>';
                 header("Location: memberhome.php") ; // redirects to page named (i.e. listings.php) 
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
              $errForm = "Please completely fill out the form!";
              //echo '<div class="row justify-content-center" style="font-size:1.25em;color:red" >Please completely fill out the form!</div>';
            }
        }
    ?>
    <!-- end php code -->
  
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/dark-background.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-10" data-aos="fade-up" data-aos-delay="400">
            
            
            <div class="row justify-content-center mt-5">
              <div class="col-md-8 text-center">
                <h1>Sign Up</h1>
                <!-- <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit</p> -->
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>  

    <!-- <div class="container"> -->

    <div class="site-section bg-light">
      <div class="container">
      <div class="row justify-content-center" style="font-size:1.5em;color:red" ><?php echo $errForm; ?></div>
        <div class="row justify-content-center">
        
          <div class="col-md-7 mb-5"  data-aos="fade">
        
            <h2 class="mb-5 text-black">Register</h2>

            <!-- <form action="#" class="p-5 bg-white"> -->

            <!-- start of form code -->
            <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="p-5 bg-white" >
            
            <!-- Email box -->
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                <!--   title="All emails must have @ and . " pattern="^[^@]+@[^@]+\.[^@]+$" -->
                    <input type="text" id="inputEmail" name="email" 
                  placeholder="Email" class="<?php 
                      if($errEmail == "" && ($email != "") && $errDuplicate == ""){ //if there is no error set and a email has been entered
                        echo $yvalid; //change box to green
                      }
                      else if($errEmail != ""){ //if there is an error message outprinted 
                        echo $invalid; //change box to red
                      }
                      else if($errDuplicate != ""){
                        echo $invalid;
                      }
                      else{
                        echo $emp;//otherwise have box grey
                      } ?>" 
                    value="<?php echo $email; ?>" autofocus> <!-- title tells what the issue is if the text entered doesn't match the pattern, 
                    pattern is a regrex saying that it must be at least one to many nums of chars followed by @ followed by at least one to many num of char followed by . followed by at least one to many chars  
                    value says retain the inputed value even when the form does not pass validation-->
                    <span class="error"> <?php echo $errEmail;?> </span>   <!-- if it fails validation, print out the error message in red-->
                    <span class="error"> <?php echo $errDuplicate;?> </span>
                </div>
            </div>
        
            <!-- name box -->
            <div class="form-group row">
                <label for="inputUser" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text"  id="inputUser" name="user" placeholder="Full Name" class="<?php 
                      if($errName == "" && ($name != "")){ //if there is no error set and a name has been entered
                        echo $yvalid; //change box to green
                      }
                      else if($errName != ""){ //if there is an error message outprinted 
                        echo $invalid; //change box to red
                      }
                      else{
                        echo $emp;//otherwise have box grey
                      } ?>" 
                    value="<?php echo $name; ?>" autofocus> 
                    <span class="error"> <?php echo $errName; ?> </span>
                </div>
            </div>

            <!-- Password box -->
            <div class="form-group row">
            <!-- old pattern and stuff -- NOT NEEDED 
              pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}" 
                    title="must be 8 char long, one upper, one lower, and at least 1 number"-->
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" id="inputPassword" name="password" placeholder="Password" 
                    value="<?php echo $password; ?>" class="<?php 
                      if($errPass == "" && ($password != "")){ //if there is no error set and a password has been entered
                        echo $yvalid; //change box to green
                      }
                      else if($errPass != ""){ //if there is an error message outprinted 
                        echo $invalid; //change box to red
                      } 
                      else{
                        echo $emp;//otherwise have box grey
                      }  ?>" 
                    autofocus> 
                    <span class="error"> <?php echo $errPass; ?> </span> 
                </div>
            </div>
                
            <!-- Address box -->
            <div class="form-group row">
                <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                    <input type="address" id="inputAddress" name="address" placeholder="Address" 
                    title="must have a street address with number and street name" value="<?php echo $address; ?>" class="<?php 
                      if($errAddr == "" && ($address != "")){ //if there is no error set and an address has been entered
                        echo $yvalid; //change box to green
                      }
                      else if($errAddr != ""){ //if there is an error message outprinted 
                        echo $invalid; //change box to red
                      }                                                                                                      
                      else{
                        echo $emp;//otherwise have box grey
                      }  ?>" 
                    autofocus> 
                    <span class="error"> <?php echo $errAddr; ?> </span> 
                </div>
            </div>
              <!-- City box-->
              <div class="form-group row">
                <label for="inputCity" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-10">
                    <input type="text"  id="inputCity" name="city" placeholder="City" class="<?php 
                      if($errCity == "" && ($city != "")){ //if there is no error set and a name has been entered
                        echo $yvalid; //change box to green
                      }
                      else if($errCity != ""){ //if there is an error message outprinted 
                        echo $invalid; //change box to red
                      }
                      else{
                        echo $emp;//otherwise have box grey
                      } ?>" 
                    value="<?php echo $city; ?>" autofocus> 
                    <span class="error"> <?php echo $errCity; ?> </span>
                </div>
            </div>
            <!-- State selection -->
            <div class="form-group row">
              <label for="inputState" class="col-sm-2 col-form-label">State</label>
              <div class="col-sm-10">
                <select id="inputState" name="state"  title="Must Select a state" class="<?php 
                      if($errState == "" && ($state != "")){ //if there is no error set and a password has been entered
                        echo $yvalid; //change box to green
                      }
                      else if($errState != ""){ //if there is an error message outprinted 
                        echo $invalid; //change box to red
                      } 
                      else{
                        echo $emp;//otherwise have box grey
                      }  ?>" 
                    autofocus> 
                  <option <?php if ((!isset($state)) || $state=="") echo "selected";?>></option>
                  <option <?php if ((isset($state)) && $state=="Alabama") echo "selected";?>>Alabama</option> <!-- Add the states here -->
                  <option <?php if ((isset($state)) && $state=="Alaska") echo "selected";?>>Alaska</option>
                  <option <?php if ((isset($state)) && $state=="Arizona") echo "selected";?>>Arizona</option>
                  <option <?php if ((isset($state)) && $state=="Arkansas") echo "selected";?>>Arkansas</option> 
                  <option <?php if (isset($state) && $state=="California") echo "selected";?>>California</option>
                  <option <?php if (isset($state) && $state=="Colorado") echo "selected";?>>Colorado</option>
                  <option <?php if (isset($state) && $state=="Connecticut") echo "selected";?>>Connecticut</option>
                  <option <?php if (isset($state) && $state=="Delaware") echo "selected";?>>Delaware</option>
                  <option <?php if (isset($state) && $state=="Florida") echo "selected";?>>Florida</option>
                  <option <?php if (isset($state) && $state=="Georgia") echo "selected";?>>Georgia</option> 
                  <option <?php if (isset($state) && $state=="Hawaii") echo "selected";?>>Hawaii</option>
                  <option <?php if (isset($state) && $state=="Idaho") echo "selected";?>>Idaho</option>
                  <option <?php if (isset($state) && $state=="Illinois") echo "selected";?>>Illinois</option> 
                  <option <?php if (isset($state) && $state=="Indiana") echo "selected";?>>Indiana</option>
                  <option <?php if (isset($state) && $state=="Iowa") echo "selected";?>>Iowa</option>
                  <option <?php if (isset($state) && $state=="Kansas") echo "selected";?>>Kansas</option>
                  <option <?php if (isset($state) && $state=="Kentucky") echo "selected";?>>Kentucky</option>
                  <option <?php if (isset($state) && $state=="Louisiana") echo "selected";?>>Louisiana</option>
                  <option <?php if (isset($state) && $state=="Maine") echo "selected";?>>Maine</option> 
                  <option <?php if (isset($state) && $state=="Maryland") echo "selected";?>>Maryland</option> 
                  <option <?php if (isset($state) && $state=="Massaschusetts") echo "selected";?>>Massaschusetts</option>
                  <option <?php if (isset($state) && $state=="Michigan") echo "selected";?>>Michigan</option>
                  <option <?php if (isset($state) && $state=="Minnesota") echo "selected";?>>Minnesota</option> 
                  <option <?php if (isset($state) && $state=="Mississippi") echo "selected";?>>Mississippi</option>
                  <option <?php if (isset($state) && $state=="Missouri") echo "selected";?>>Missouri</option>
                  <option <?php if (isset($state) && $state=="Montana") echo "selected";?>>Montana</option>
                  <option <?php if (isset($state) && $state=="Nebraska") echo "selected";?>>Nebraska</option>
                  <option <?php if (isset($state) && $state=="Nevada") echo "selected";?>>Nevada</option>
                  <option <?php if (isset($state) && $state=="New Hampshire") echo "selected";?>>New Hampshire</option> 
                  <option <?php if (isset($state) && $state=="New Jersey") echo "selected";?>>New Jersey</option> 
                  <option <?php if (isset($state) && $state=="New Mexico") echo "selected";?>>New Mexico</option>
                  <option <?php if (isset($state) && $state=="New York") echo "selected";?>>New York</option>
                  <option <?php if (isset($state) && $state=="North Carolina") echo "selected";?>>North Carolina</option> 
                  <option <?php if (isset($state) && $state=="North Dakota") echo "selected";?>>North Dakota</option>
                  <option <?php if (isset($state) && $state=="Ohio") echo "selected";?>>Ohio</option>
                  <option <?php if (isset($state) && $state=="Oklahoma") echo "selected";?>>Oklahoma</option>
                  <option <?php if (isset($state) && $state=="Oregon") echo "selected";?>>Oregon</option>
                  <option <?php if (isset($state) && $state=="Pennsylvania") echo "selected";?>>Pennsylvania</option>
                  <option <?php if (isset($state) && $state=="Rhode Island") echo "selected";?>>Rhode Island</option> 
                  <option <?php if (isset($state) && $state=="South Carolina") echo "selected";?>>South Carolina</option> 
                  <option <?php if (isset($state) && $state=="South Dakota") echo "selected";?>>South Dakota</option>
                  <option <?php if (isset($state) && $state=="Tennessee") echo "selected";?>>Tennessee</option>
                  <option <?php if (isset($state) && $state=="Texas") echo "selected";?>>Texas</option> 
                  <option <?php if (isset($state) && $state=="Utah") echo "selected";?>>Utah</option>
                  <option <?php if (isset($state) && $state=="Vermont") echo "selected";?>>Vermont</option>
                  <option <?php if (isset($state) && $state=="Virginia") echo "selected";?>>Virginia</option>
                  <option <?php if (isset($state) && $state=="Washington") echo "selected";?>>Washington</option>
                  <option <?php if (isset($state) && $state=="West Virginia") echo "selected";?>>West Virginia</option>
                  <option <?php if (isset($state) && $state=="Wisconsin") echo "selected";?>>Wisconsin</option> 
                  <option <?php if (isset($state) && $state=="Wyoming") echo "selected";?>>Wyoming</option>  
                  <!--My dropdown
                -
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
</head>
<body>

<h2>Clickable Dropdown</h2>
<p>Click on the button to open the dropdown menu.</p>

<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="#home">Alabama</a>
    <a href="#about">Alaska</a>
    <a href="#contact">Arizona</a>
    <a href="#home">Arkansas</a>
    <a href="#about">California</a>
    <a href="#contact">Colorado</a>
    <a href="#home">Connecticut</a>
    <a href="#about">Delaware</a>
    <a href="#contact">Florida</a>
    <a href="#home">Georgia</a>
    <a href="#about">Hawaii</a>
    <a href="#contact">Idaho</a>
    <a href="#home">Iowa</a>
    <a href="#about">Kansas</a>
    <a href="#contact">Kentucky</a>
    <a href="#home">Louisiana</a>
    <a href="#about">Maine</a>
    <a href="#contact">Maryland</a>
    <a href="#home">Massachusetts</a>
    <a href="#about">Michigan</a>
    <a href="#contact">Minnesota</a>
    <a href="#home">Mississippi</a>
    <a href="#about">Missouri</a>
    <a href="#contact">Montana</a>
    <a href="#home">Nebraska</a>
    <a href="#about">Nevada</a>
    <a href="#contact">New Hampshire</a>
    <a href="#home">New Jersey</a>
    <a href="#about">New Mexico</a>
    <a href="#contact">New York</a>
    <a href="#home">North Carolina</a>
    <a href="#about">North Dakota</a>
    <a href="#contact">Ohio</a>
    <a href="#home">Oklahoma</a>
    <a href="#about">Oregon</a>
    <a href="#contact">Pennyslvania</a>
    <a href="#home">Rhode Island</a>
    <a href="#about">South Carolina</a>
    <a href="#contact">South Dakota</a>
    <a href="#home">Tennessee</a>
    <a href="#about">Texas</a>
    <a href="#contact">Utah</a>
    <a href="#home">Vermont</a>
    <a href="#about">Virginia</a>
    <a href="#contact">Washington</a>
    <a href="#home">West Virginia</a>
    <a href="#about">Wisconsin</a>
    <a href="#contact">Wyoming</a>
  </div>
</div>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

</body>
</html>
                -->
                 
                </select>
                <span class="error"> <?php echo $errState;?> </span>
              </div>
            </div>
                
                        <!-- Zip code box -->
            <div class="form-group row">
                <label for="inputZip" class="col-sm-2 col-form-label">Zipcode</label>
                <div class="col-sm-10">
                    <input type="zipcode" id="inputzip" name="zipcode" placeholder="Zipcode" 
                    title="must be a five number zipcode" value="<?php echo $zipcode; ?>" class="<?php 
                      if($errZipcode == "" && ($zipcode != "")){ //if there is no error set and a password has been entered
                        echo $yvalid; //change box to green
                      }
                      else if($errZipcode != ""){ //if there is an error message outprinted 
                        echo $invalid; //change box to red
                      } 
                      else{
                        echo $emp;//otherwise have box grey
                      }  ?>" 
                    autofocus> 
                    <span class="error"> <?php echo $errZipcode; ?> </span> 
                </div>
            </div>
           
            <!-- button box -->
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <input type="submit" value="Register" name="submit" class="btn btn-primary"/>
                </div>
            </div>

              <!--  
                <div class="form-group has-success has-feedback row">
            <label class="col-sm-2 control-label" for="inputpassword">
                  Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword" name="password" placeholder="password" value="<?php //echo $password; ?>">
              <span class="glyphicon glyphicon-ok form-control-feedback"></span>
              <?php //echo $errPass; ?>
            </div>
               
               
               <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">Password</label> 
                  <input type="password" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="subject">Re-type Password</label> 
                  <input type="password" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-12">
                  <p>Have an account? <a href="login.html">Log In</a></p>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Sign In" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div> -->
              

  
            </form>
                </div>
          
        </div>
      </div>
    </div>

    
    <div class="newsletter bg-primary py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h2>Newsletter</h2>
            <p>Sign up for newsletter to get updates about whats getting added!</p>
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
  <script src="js/tether.min.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>