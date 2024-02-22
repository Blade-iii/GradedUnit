<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])) {
  // Display the user's name
  $firstName = htmlspecialchars($_SESSION["firstName"]);
  $lastName = htmlspecialchars($_SESSION["lastName"]);

  // Retrieve additional user details from the database
  require('connectSQL.php');
  $q = "SELECT userID, firstName, lastName, email, regDate FROM users WHERE userID='{$_SESSION["userID"]}'";
  $r = mysqli_query($link, $q);



  if (mysqli_num_rows($r) > 0) {
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      // Format register date 
      $date = $row["regDate"];
      $day = substr($date, 8, 2);
      $month = substr($date, 5, 2);
      $year = substr($date, 0, 4);

      // Set session values including email
      $_SESSION["email"] = $row["email"];
      $_SESSION["firstName"] = $row["firstName"];
      $_SESSION["lastName"] = $row["lastName"];
    }

    // Assign email to $email
    $email = $_SESSION["email"];
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];

    // Check if the user is logged in
    if (isset($_SESSION["userID"])) {
      $userID = $_SESSION["userID"];

      // Retrieve card details from the database
      $qCard = "SELECT cardNum, cardExpire FROM cards WHERE userID='$userID'";
      $rCard = mysqli_query($link, $qCard);

      if ($rCard) {
        $cardRow = mysqli_fetch_assoc($rCard);
        if ($cardRow) {
          // Card details found, update variables
          $cardNum = $cardRow['cardNum'];
          $cardExpire = $cardRow['cardExpire'];
        } else {
          // No card details found, set default values
          $cardNum = 0000000000000000;
          $cardExpire = 0000;
        }
      } else {
        // Handle query error
        echo "Error fetching card details: " . mysqli_error($link);
      }
    }
  } else {
    echo "No user details";
  }
} else {
  // Redirect to the login page if the user is not logged in
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
  <title>Account Page</title>
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
                    <a class="nav-link active" href="account.php">
                        <?php echo $firstName . ' ' . $lastName ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
  <br>

  <center>
    <h1>Account Page</h1>
  </center>
  <br>

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title"style="color:black;">User Information</h5>
            <p class="card-text" style="color:black;">
              <?php
              //  echo "User ID: " . $userID . "<br>";
              echo "Name: " . $firstName . " " . $lastName . "<br>";
              echo "Email: " . $email . "<br>";
              echo "Registration Date: " . $day . '/' . $month . '/' . $year . "<br>";
              ?>
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title" style="color:black;">Card Information</h5>
            <p class="card-text" style="color:black;">
              <?php
              //  echo "User ID: " . $userID . "<br>";
              echo "Card Holder: " . $firstName . " " . $lastName . "<br>";
              $last4Digits = substr($cardNum, -4);
              echo "Card Number: **** **** **** " . $last4Digits . "<br>";
              echo "Card Expiry Date: " . $cardExpire . "<br>";
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <center>
    <div class="card" style="width: 18rem; margin: 100px;">
      <div class="card-body">
        <h5 class="card-title">User Dashboard</h5>
        <br>
        <a href="accountDetails.php" class="btn btn-secondary">Change Account Details</a>
        <br>
        <br>
        <a href="addCard.php" class="btn btn-secondary">Add Payment Method</a>
        <br>
        <br>
        <a href="updateCard.php" class="btn btn-secondary">Update Payment Method</a>
        <br>
        <br>
        <a href="deleteCard.php" class="btn btn-secondary">Remove Payment Method</a>
      </div>
    </div>
  </center>

</body>

</html>