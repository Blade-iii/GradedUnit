<?php
session_start(); // Start the session

// Connects to database
require("connectSQL.php");

// Check if the user's name is set in the session
if (isset($_SESSION["firstName"]) && ($_SESSION["lastName"])) {
  
  // Display the user's name
  $firstName = htmlspecialchars($_SESSION["firstName"]);
  $lastName = htmlspecialchars($_SESSION["lastName"]);
} else {
  include("login.html");
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <title>Home Page</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Sustain Energy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Log out</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account.php">
                        <?php echo $firstName . ' ' . $lastName ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="information.php">Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="partners.php">Partners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br>


  <br>
    <h2> Home Page</h2>
  <br>
 <!-- Text and images in cards for the home page -->
 <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">How to get started!</h5>
          <p class="card-text">
            On the navigation bar you should see your name click on it to access your account page. Where you can add payment methods and activate your account and more!
            <br><br>
            These are the things you can perform in your account page!
            <ul>
              <li>Add a payment method</li>
              <li>Activate your account</li>
              <li>Add points</li>
              <li>View Award</li>
            </ul>
            <br>
            Please note that you can only add points once per year or pay for points shortfall in the cart, if you would like to resubmit points you will have to deactivate your account and pay the subscription fee again.
            <br><br>
            If you have any questions, visit the Contact us page if you have any issues or concerns

          </p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-80">
        <div style="height: 100%;">
          <img src="images/watertree.jpg" class="card-img-top h-100" alt="...">
        </div>
      </div>
    </div>
  </div>
</div>
<br><br>

 <!-- Text and images in cards for the home page -->
 <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title">Welcome to Sustain Energy!</h5>
          <p class="card-text">
            Welcome to our website, and we urge you to register your company with Sustain Energy to promote sustainability and being green!
            <br><br>
            What we offer!
            <ul>
              <li>Certification for participating</li>
              <li>incentive for promoting sustainbility</li>
              <li>Making companies more thoughtful about their carbon footprint</li>
              <li>Promoting green practices within the workplace</li>
            </ul>
            <br><br>
            Thank you for visiting Sustain Energy! 

          </p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100">
        <div style="height: 100%;">
          <img src="images/kidtree.jpg" class="card-img-top h-100" alt="...">
        </div>
      </div>
    </div>
  </div>
</div>
<br><br><br>
        
<footer>

    <center>
       <p><a href="contact.php">Contact us</a></p>
       <p><a href="copyright.php">Copyright</a></p>
       <p><a href="termsofuse.php">Terms of use</a></p>
       <p><a href="home.php">2024 Sustain Energy</a></p>
    </center>
</footer>
</body> 
</html>


