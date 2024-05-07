<?php
// Start the session
session_start();

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
  <script src="script.js"></script>
  <title>Information Page</title>
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
                    <a class="nav-link " aria-current="page" href="home.php">Home</a>
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
                    <a class="nav-link active" href="information.php">Information</a>
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
    <h2> Information Page</h2>
  <br>
 <!-- Card to hold the mission statement -->
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card" >
          <div class="card-body">
            <h5 class="card-title">Mission Statement</h5>
            <p class="card-text">
            Our mission is to make the world a greener place, by encouraging companies to always keep in mind the impact they have on the planet. We are using this website to encourage companies to use more sustainable measures within their company which will have long term effects on the company and planet for the better! The money gathered from the donations go toward UNESCO who promote sustainability and help the planet by being greener. 
            </p>
          </div>
        </div>
    </div>

 <!-- Card to hold the quotes that companies have said about sustain energy -->
        <div class="col-md-6">
        <div class="card" >
          <div class="card-body">
            <h5 class="card-title">Companies involved Quotes</h5>
            <p class="card-text">
            "Just wow, Sustain Energy has reduced our carbon emissions by ten fold!"
            <br>
            "Fantastic idea of help fighting against global warming!"
            <br>
            "Sustain Energy helped us keep on the right track."
            <br>
            "Can never go back to our old practices"
            <br>
            "Our company has never been greener!"
            <br>
            "Just... Amazing"
            </p>
          </div>
        </div>
        </div>
      </div>
</div>
<br><br>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card h-100">
        <img src="images/waterfallman.jpg" class="card-img-top h-100" alt="...">
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100">
        <div style="height: 100%;">
        <img src="images/leaf.jpg" class="card-img-top h-100" alt="...">
        </div>
      </div>
    </div>
  </div>
</div>
<br><br>
 
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