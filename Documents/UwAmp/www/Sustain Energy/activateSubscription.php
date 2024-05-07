<?php
// Start the session
session_start();

// Stores the id from the session
$id = htmlspecialchars($_SESSION["userID"]);

// Connects to the database
require("connectSQL.php");

// Query to select all the users that do not have an active subscription
$sql1 = "SELECT * FROM users WHERE userID='$id' AND accountStatus != 'active'";
$r1 = mysqli_query($link, $sql1);

// Query to select all the cards registered to the user
$sql2 = "SELECT * FROM cards where userID='$id'";
$r2 = mysqli_query($link, $sql2);

$row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC);

if (mysqli_num_rows($r2) == 0){
    echo "Error: You do not have a card registered please register a card.";
    echo '<script>alert("You dont have a card active.");</script>';
    echo '<script>setTimeout(function(){ window.location.href = "account.php"; }, 0);</script>';
}

if (mysqli_num_rows($r1) > 0) {
    
    /*
     If the user has entered a csv it then compares it to the stored csv in the database and checks 
     if it's valid if its not then the user will be met with a error and will be redirected.
     */
    if (!empty($_POST["userCsv"])) {
        if ($row2["cardCsv"] == $_POST["userCsv"]) {
            $sql3 = "UPDATE users SET accountStatus='active' WHERE userID='$id'";
            $r = @mysqli_query($link, $sql3);

            if ($r) {
                header("Location: account.php");
                exit();
            } else {
                echo "Error updating record: " . $link->error;
            }
        } else {
            $validationMessage = "CSV does not match.";
        }
    } else {
        $validationMessage = "Please enter a CSV in the form.";
    }
} else {
    echo "Error: User not found or account is already active.";
    echo '<script>alert("You have a subscription already active.");</script>';
    echo '<script>setTimeout(function(){ window.location.href = "account.php"; }, 0);</script>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</head>

<body>
      <!-- Form for the user to pay for a subscription -->
    <br>
    <div class="container">
        <form action="activateSubscription.php" method="post">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <h1>Confirm CSV and Pay </h1><br>
                    <h2>Total for Subscription is: £99.99 </h2><br>
                    <label for="userCsv" class="form-label">CSV:</label>
                    <input type="text" class="form-control" id="userCsv" name="userCsv" required> <br>
                    <center>
                        <button type="submit" class="btn btn-primary">Pay</button>
                        <a href="home.php" class="btn btn-secondary">Continue Shopping</a> <br><br>
                        <span class="text-danger"><?php echo isset($validationMessage) ? $validationMessage : ''; ?></span>
                    </center>
                </div>
            </div>
        </form>
    </div>
</body>

</html>