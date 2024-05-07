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
  <title>Copyright</title>
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
                    <a class="nav-link" aria-current="page" href="home.php">Home</a>
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
<h2>Copyright</h2>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 d-flex justify-content-center">
            <div class="card award-card" style="width: 60rem;">
                <div class="card-body">
                    <h5 class="card-title">Copyright Disclaimer for Sustain Energy</h5>
                    <p class="card-text">
                    <p>All content, materials, and intellectual property featured on the Sustain Energy website, including but not limited to text, graphics, logos, images, videos, and software, are the property of Sustain Energy or its licensors and are protected by copyright laws of the United Kingdom and international treaties.</p>

                    <p>Permission is granted to electronically copy and print hard copy portions of this site for the sole purpose of placing an order with Sustain Energy or purchasing Sustain Energy products. Any other use, including but not limited to reproduction, distribution, display, or transmission of the content of this site is strictly prohibited, unless authorized by Sustain Energy.</p>

                    <p> Energy respects the intellectual property rights of others. If you believe that your work has been copied in a way that constitutes copyright infringement, please contact us immediately for resolution.</p>

                    <p>For inquiries regarding the use of Sustain Energy's copyrighted materials, please contact: admindesk@fakemail.com </p>

                    <p>Sustain Energy reserves the right to modify, update, or revise this copyright disclaimer at any time without prior notice. By using this website, you agree to be bound by the terms and conditions of this disclaimer.</p>

                    <p> Last updated: 23/04/24</p>
                    </p>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<footer>
    <center>
       <p><a href="contact.php">Contact us</a></p>
       <p><a href="copyright.php">Copyright</a></p>
       <p><a href="termsofuse.php">Terms of use</a></p>
       <p><a href="home.php">2024 Sustain Energy</a></p>
    </center>
</footer>