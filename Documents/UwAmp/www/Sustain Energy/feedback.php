
<?php
// Start the session
session_start();
// Connects to database
require("connectSQL.php");
$firstName = htmlspecialchars($_SESSION["firstName"]);
$lastName = htmlspecialchars($_SESSION["lastName"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the user is logged in
    if (isset($_SESSION["userID"])) {
        $userID = $_SESSION["userID"];

        // Sets up an error array
        $errors = array();

        // Check if the review title has been entered
        if (empty($_POST["reviewTitle"])) {
            $errors[] = "Enter your review title";
        } else {
            $rt = mysqli_real_escape_string($link, trim($_POST["reviewTitle"]));
        }

        // Check if the review body has been entered
        if (empty($_POST["reviewBody"])) {
            $errors[] = "Enter your review ";
        } else {
            $rb = mysqli_real_escape_string($link, trim($_POST["reviewBody"]));

        }

        // If no errors occur put the user responses into the feedback table
        if (empty($errors)) {

            $q = "INSERT INTO feedback (reviewTitle, reviewText, userID) 
                  VALUES ('$rt', '$rb', '$userID')";
            $r = @mysqli_query($link, $q);

            if ($r) {
                header("Location: home.php");
                //echo 'Your review is now added. <a class="alert-link" href="home.php">Home</a>';
            }

            // Close the database connection
            mysqli_close($link);
            exit();
        } else {
            echo "<p>The following errors occurred:</p>";
            foreach ($errors as $msg)
                echo "<p>$msg</p><br>";

            echo "<p>Please try again</p>";
            mysqli_close($link);
        }
    }
    else {
        // Go to home userID isnt there
        header("Location: index.html");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<Head>
    <title>Contact us</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</Head>
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
<body>
    <br>
    <h2>Contact us</h2>
    <br>

  <!-- Form for the user to input their feedback and once submitted goes to the database -->
    <div class="container">
    <form action="feedback.php" method="post">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <label for="reviewTitle" class="form-label">Enter Your Feedback Title:</label>
                    <input type="text" class="form-control" id="reviewTitle" name="reviewTitle" required value="<?php if (isset($_POST["reviewTitle"])) echo $_POST["reviewTitle"]; ?> "> <br>
                    <br>
                    <label for="reviewBody">Enter Your Feedback:</label>
                    <textarea class="form-control" id="reviewBody" name="reviewBody" required rows="5"><?php if (isset($_POST["reviewBody"])) echo $_POST["reviewBody"]; ?></textarea> <br>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="contact.php" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </form>
    </div>
<br>
<br>
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