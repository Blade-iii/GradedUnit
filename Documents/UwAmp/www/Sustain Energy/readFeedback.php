<?php
// Start the session
session_start();

// Connects to database
require("connectSQL.php");

$firstName = htmlspecialchars($_SESSION["firstName"]);
$lastName = htmlspecialchars($_SESSION["lastName"]);
$userID = $_SESSION["userID"];
// Query statement using inner join to show feedback with the users first and last name
$sql2 = "SELECT feedback.*, users.firstName, users.lastName 
         FROM feedback 
         INNER JOIN users ON feedback.userID = users.userID";

$r2 = mysqli_query($link, $sql2);

// Check for errors
if (!$r2) {
    echo "Error: " . mysqli_error($link);
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>

  <title>Reviews</title>
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
                    <a class="nav-link" href="information.php">Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="partners.php">Partners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="contact.php">Contact us</a>
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
  <h1>Feedback</h1>
  </center>
  <br>
  <?php
  // if there are no feedback given it will display the error message
if (mysqli_num_rows($r2) > 0) {
    echo '<div class="container"><div class="row">';
} else {
    echo '<center>
    <p>No feedback. Leave some feedback to see it!</p>
    <a href="feedback.php" class="btn btn-primary">Leave Feedback</a>
    </center>';
}
// While loop that goes throw the row array which contains all the reviews to display all the reviews with their content and their authors
while ($row2 = mysqli_fetch_array($r2,MYSQL_ASSOC)) {
    // Display in html for displaying all the review cards
    echo '
        <div class="col-xs-12 col-sm-6 col-md-4">
            <div class="card mb-3">
                <div class="card-body d-flex flex-column"">
                    <h5 class="card-title">' . $row2['reviewTitle'] . '</h5>
                    <p class="card-text" style="color:black; text-align:left;">' . $row2['reviewText'] . '</p>
                    <p class="card-text" style="color:black;">Review Author: ' . $row2['firstName'] . ' ' . $row2['lastName'] . '</p>
                </div>
            </div>
        </div>';
}

if (mysqli_num_rows($r2) > 0) {
    echo '</div></div>';
}
?>

<footer>
    <center>
       <p><a href="contact.php">Contact us</a></p>
       <p><a href="copyright.php">Copyright</a></p>
       <p><a href="termsofuse.php">Terms of use</a></p>
       <p><a href="home.php">2024 Sustain Energy</a></p>
    </center>
</footer>
