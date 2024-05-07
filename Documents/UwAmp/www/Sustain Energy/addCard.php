<!DOCTYPE html>
<html>
<Head>
    <title>Add Card</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</Head>

<body>
    <br>
    <h2>Add Card Information</h2>
    <br>
  <!-- Form for the user to add their card information -->
    <div class="container">
        <form action="addCard.php" method="post">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <label for="cardNum" class="form-label">Card Number: (1111222233334444)</label>
                    <input type="text" class="form-control" id="cardNum" name="cardNum" required
                        value="<?php if (isset($_POST["cardNum"]))
                            echo $_POST["cardNum"]; ?> "> <br>
                    <br>
                    <label for="cardExpire">Card Expiry Date: (1124)</label>
                    <input type="text" class="form-control" id="cardExpire" name="cardExpire" required
                        value="<?php if (isset($_POST["cardExpire"]))
                            echo $_POST["cardExpire"]; ?> "> <br>
                    <br>
                    <label for="cardCsv">Card CSV Number: (123)</label>
                    <input type="text" class="form-control" id="cardCsv" name="cardCsv" required
                        value="<?php if (isset($_POST["cardCsv"]))
                            echo $_POST["cardCsv"]; ?>"><br>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="account.php" class="btn btn-secondary">Back</a>
                </div>
        </form>
        <footer>
            <center>
                <p>Contact us</p>
                <p>Privacy & Cookies</p>
                <p>Copyright</p>
                <p>Terms of use</p>
                <p>2024 Sustain Energy</p>
            </center>
        </footer>
</body>
</html>
<?php
  // Start the session
  session_start();

  // Connects to database
  require("connectSQL.php");

  if (isset($_SESSION["userID"])) {

    $userID = $_SESSION["userID"];

      // Check if the user already has a card registered
   $qCheck = "SELECT COUNT(*) AS cardCount FROM cards WHERE userID = '$userID'";
   $rCheck = mysqli_query($link, $qCheck);
   $rowCheck = mysqli_fetch_assoc($rCheck);
   $cardCount = $rowCheck['cardCount'];

   if ($cardCount > 0) {
       echo '<script>alert("You already have a card registered.");</script>';
       echo '<script>setTimeout(function(){ window.location.href = "account.php"; }, 0);</script>';
   } 

} else {
    header("Location: account.php");
}
 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in
  
        // Sets up an error array
        $errors = array();

        // Check for card num
        if (empty($_POST["cardNum"])) {
            $errors[] = "Enter your card number";
        } else {
            $cn = mysqli_real_escape_string($link, trim($_POST["cardNum"]));

            // Check if cardNum has fewer than 16 digits
            if (strlen($cn) < 16) {
                $errors[] = "Card number must have at least 16 digits";
            }
        }

         // Check for csv
        if (empty($_POST["cardExpire"])) {
            $errors[] = "Enter your card expiry date";
        } else {
            $ce = mysqli_real_escape_string($link, trim($_POST["cardExpire"]));

            if (strlen($ce) < 4) {
                $errors[] = "Card expiry must have at least 4 digits";
            }
        }

        // Check for csv
        if (empty($_POST["cardCsv"])) {
            $errors[] = "Enter card CSV number";
        } else {
            $ccsv = mysqli_real_escape_string($link, trim($_POST["cardCsv"]));

            if (strlen($ccsv) < 3) {
                $errors[] = "Card expiry must have at least 3 digits";
            }
        }

       

        // On success, register user inserting into cards.
        if (empty($errors)) {
            $q = "INSERT INTO cards (userID, cardNum, cardExpire, cardCsv) 
                  VALUES ('$userID', '$cn', '$ce', '$ccsv')";
            $r = @mysqli_query($link, $q);

            if ($r) {
                echo '<br><center><p>Your card is now added.</p> <a class="alert-link" href="account.php">User Dashboard</a></center>';
            }
        } else {
            echo "<center><p>The following errors occurred:</p></center>";
            foreach ($errors as $msg) {
                echo "$msg<br>";
            }
            echo "<center><p>Please try again</p></center>";
        }

        // Close the database connection
        mysqli_close($link);
    
}
?>