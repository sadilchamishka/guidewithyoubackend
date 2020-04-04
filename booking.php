<?php
require 'vendor/autoload.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require_once('connection.php');
$link = $connection;

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['submit'])){

    echo $_POST['fname'];
// Escape user inputs for security
$first_name = mysqli_real_escape_string($link, $_POST['fname']);
$last_name = mysqli_real_escape_string($link, $_POST['lname']);
$email = mysqli_real_escape_string($link, $_POST['email']);
$dateOfTravel = mysqli_real_escape_string($link, $_POST['dateOfTravel']);
$phone = mysqli_real_escape_string($link, $_POST['phone']);
$persons = mysqli_real_escape_string($link, $_POST['persons']);
$city = mysqli_real_escape_string($link, $_POST['city']);
$place = mysqli_real_escape_string($link, $_POST['place']);
$days = mysqli_real_escape_string($link, $_POST['daysSpend']);
//$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$privacy = mysqli_real_escape_string($link, $_POST['privacy']);

// Attempt insert query execution
$sql = "INSERT INTO booking(firstname, lastname, email, date, phone, persons, city, place, days, privacy) VALUES ('$first_name', '$last_name', '$email', '$dateOfTravel', '$phone', '$persons', '$city', '$place', '$days', '$privacy')";
if(mysqli_query($link, $sql)){
    echo "Booking successfully. You will get the details of the guide, please check your mail";
    $from = new SendGrid\Email(null, "sadilchamishka.16@cse.mrt.ac.lk");
    $subject = "Guide With You, tour guide service provider";
    $to = new SendGrid\Email(null, $email);
    $content = new SendGrid\Content("text/plain", "Hello, How are you");
    $mail = new SendGrid\Mail($from, $subject, $to, $content);

    $apiKey = getenv('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');
    $sg = new \SendGrid($apiKey);

    $response = $sg->client->mail()->send()->post($mail);
    echo $response->statusCode();
    echo $response->headers();
    echo $response->body();
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}
// Close connection
mysqli_close($link);
?>


<?php
// these variables for error messeges
    $nameErr = $emailErr = $phoneErr = $websiteErr = $privacyErr = "";
    $fname = $lname = $email = $phone = $comment = $website = $privacy = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["fname"])) {
        $nameErr = "Name is required";
      } else {
        $fname = test_input($_POST["fname"]);
      }

      if (empty($_POST["lname"])) {
        $nameErr = "Name is required";
      } else {
        $lname = test_input($_POST["lname"]);
      }

      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
      }

      if (empty($_POST["privacy"])) {
        $privacyErr = "Agreement is required";
      } else {
        $privacy = test_input($_POST["privacy"]);
      }

      if (empty($_POST["phone"])) {
        $phoneErr = "Contact number is required";
      } else {
        $phone = test_input($_POST["phone"]);
      }
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>

<!--
<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
-->



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Guide with You &mdash;Guiding Company</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900|Display+Playfair:200,300,400,700">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">


    <link rel="stylesheet" href="css/aos.css">

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

    <header class="site-navbar py-1" role="banner">

      <div class="container-fluid">
        <div class="row align-items-center">

          <div class="col-6 col-xl-2 text-center">
            <h1 class="mb-0"><a href="index.html" class="text-black h2 mb-0">Guide with You</a></h1>
          </div>
          <div class="col-6 col-xl-6 d-none d-xl-block text-center">
            <nav class="site-navigation position-relative text-right text-lg-center" role="navigation">

              <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
                <li class="active">
                  <a href="index.html">Home</a>
                </li>
                <li class="has-children">
                  <a href="destination.html">Destinations</a>
                  <ul class="dropdown">
                    <li><a href="AncientPlaces.html">Ancient Places</a></li>
                    <li><a href="Mountains.html">Mountains</a></li>
                    <li><a href="Beaches.html">Beaches</a></li>
                    <li><a href="NationalParks.html">National Parks</a></li>
					          <li><a href="AdventureParks.html">Advernture Parks</a></li>
                    <li><a href="WhaleWatching.html">Whale Watching</a></li>
                  </ul>
                </li>

                <li><a href="discount.html">Discount</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="blog.html">Blog</a></li>

                <li><a href="contact.html">Contact</a></li>
                <!-- <li><a href="booking.html">Book Online</a></li>

              -->

              </ul>

            </nav>



          </div>

          <div class="col-6 col-xl-4 text-right">
            <div class="input-group mb-3">
                <input type="text" class="form-control border-secondary text-black bg-transparent input-md" placeholder="Explore" aria-label="Explore" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary text-white" type="button" id="button-addon2">Search</button>
                </div>
            </div>

            <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

          </div>

        </div>
      </div>




    </header>




    <div class="site-blocks-cover inner-page-cover" style="background-image: url(images/beaches.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">

            <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
              <h1 class="text-white font-weight-light">Book A Tour</h1>
              <div><a href="index.html">Home</a> <span class="mx-2 text-white">&bullet;</span> <span class="text-white">Booking</span></div>

            </div>
          </div>
        </div>
      </div>



    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-7 mb-5">


            <form class="p-5 bg-white" method="POST" action="booking.php">

              <p><span class="error">* required fields</span></p>
              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name<span class="error">* <?php echo $nameErr;?></span></label>
                  <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" required autocomplete="fname">

                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name<span class="error">* <?php echo $nameErr;?></span></label>
                  <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" required autocomplete="lname">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="date">Date of Travel<span class="error">* <?php echo $emailErr;?></span></label>
                  <input type="text" id="dateOfTravel" name="dateOfTravel" class="form-control datepicker px-2" placeholder="Date of visit">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="email">Email<span class="error">* <?php echo $emailErr;?></span></label>

                  <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autocomplete="email">
                </div>
              </div>

	     <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="phone">Phone<span class="error">* <?php echo $phoneErr;?></span></label>
                  <input type="tel" name="phone" id="phone" class="form-control" placeholder="+1-650-450-1212" required autocomplete="tel">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="persons">How Many Person<span class="error"> *</span></label>
                  <select name="persons" id="persons" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5+</option>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="city">Destination<span class="error"> *</span></label>
                  <select name="city" id="city" class="form-control">
                    <option value="1">Japan</option>
                    <option value="2">Europe</option>
                    <option value="3">China</option>
                    <option value="4">France</option>
                    <option value="5">Philippines</option>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="place"><span class="error"> </span></label>
                  <select name="place" id="place" class="form-control">
                    <option value="1">Japan</option>
                    <option value="2">Europe</option>
                    <option value="3">China</option>
                    <option value="4">France</option>
                    <option value="5">Philippines</option>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="daysSpend">Days Hope to Spend<span class="error"> *</span></label>
                  <select name="daysSpend" id="daysSpend" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="2w">2 Weeks</option>
                    <option value="3w">3 Weeks</option>
                    <option value="1m">1 Month</option>
                  </select>
                </div>
              </div>


              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="note">Notes</label>
                  <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                  <br>
                  <input type="checkbox" id="privacy" name="privacy" value="privacy">
                  <label for="privacy">   I Agree to the all conditions in <a href="privacy.html">Privacy Policy</a></label>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Send" class="btn btn-primary py-2 px-4 text-white">
                </div>
              </div>


            </form>
          </div>
          <div class="col-md-5">



            <div class="p-4 mb-3 bg-white">
              <img src="images/hero_bg_1.jpg" alt="Image" class="img-fluid mb-4 rounded">
              <h3 class="h5 text-black mb-3">More Info about Your Tour</h3>
              <p>Travel with a best experienced professional guide will double your happiness and experience. Click here to get more details about your trip and more.</p>
              <p><a href="#" class="btn btn-primary px-4 py-2 text-white">Learn More</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>


    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="mb-5">
              <h3 class="footer-heading mb-4">About Travelers</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe pariatur reprehenderit vero atque, consequatur id ratione, et non dignissimos culpa? Ut veritatis, quos illum totam quis blanditiis, minima minus odio!</p>
            </div>



          </div>
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="row mb-5">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Destination</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">About</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Privacy Policy</a></li>
                  <li><a href="#">Contact Us</a></li>
                  <li><a href="#">Discounts</a></li>
                </ul>
              </div>
            </div>



          </div>

          <div class="col-lg-4 mb-5 mb-lg-0">


            <div class="mb-5">
              <h3 class="footer-heading mb-2">Subscribe Newsletter</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit minima minus odio.</p>

              <form action="#" method="post">
                <div class="input-group mb-3">
                  <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2" required autocomplete="email">
                  <div class="input-group-append">
                    <button class="btn btn-primary text-white" type="button" id="button-addon2">Send</button>
                  </div>
                </div>
              </form>

            </div>

          </div>

        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="mb-5">
              <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
              <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>

            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
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

  <script src="js/main.js"></script>

  </body>
</html>
