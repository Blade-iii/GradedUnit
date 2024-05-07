<?php
// Start the session
session_start();

$id = htmlspecialchars($_SESSION["userID"]);
$firstName = htmlspecialchars($_SESSION["firstName"]);
$lastName = htmlspecialchars($_SESSION["lastName"]);

// Connects to the database
require("connectSQL.php");

// Query to check if the user exists in companyinfo table and has less than 100 points
$sql1 = "SELECT * FROM companyinfo WHERE userID='$id' AND points < 100";
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

if (!empty($_POST["userCsv"])) {
    if ($row2["cardCsv"] == $_POST["userCsv"]) {
        // Retrieve selected points from the form
        $selectedPoints = $_POST["points"];
        $row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC);
        $companyID = $row1['companyID'];

        $sql = "INSERT INTO companyinfo (userID, companyID, points) 
        VALUES ('$id', '$companyID', '$selectedPoints') 
        ON DUPLICATE KEY UPDATE points = VALUES(points)";


        if (mysqli_query($link, $sql)) {
            // If insertion is successful, redirect to account page
            header("Location: account.php");
            exit();
        } else {
            // If an error occurs, display an error message
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    } else {
        // CSV does not match
        $validationMessage = "CSV does not match.";
    }
} else {
    // CSV input is empty
    $validationMessage = "Please enter a CSV in the form.";
}

// Check if the user exists in the companyinfo database
if (mysqli_num_rows($r1) > 0) {
    $row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC);
    $companyID = $row1['companyID'];
    // If the user has exactly 100 points redirect them to home.php
    if ($row1["points"] == 100) {
        header("Location: home.php");
        exit();
    } else {
       
    }
} else {
    // If the user is not found in the companyinfo database, redirect them to account.php
    echo '<script>alert("Please submit points to the calculator on the Add points Button.");</script>';
    echo '<script>setTimeout(function(){ window.location.href = "account.php"; }, 0);</script>';
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

  <title>Cart</title>
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
                <li class="nav-item active">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
  <br>

  <br>
  <center>
    <h2>Cart</h2>
  </center>
  <br>

  <?php
// Calculate total points needed to reach 100
$totalPointsNeeded = max(0, 100 - $row1["points"]); 

// Calculate total
$total = $totalPointsNeeded * 10; 

// Make sure the total points cannot exceed 100
$maxPoints = min(100, $totalPointsNeeded); 
?>

<center>
    <form action="cart.php" method="post">
        <h3>You have <?php echo $row1["points"]; ?> points. You can purchase more points for £10 each.</h3>
        <h3>The total to pay is £<span id="total"><?php echo $total; ?></span>.</h3>
        <label for="points">Select the number of points to purchase:</label>
        <!-- Dropdown menu for selecting the quantity of points -->
        <select id="points" name="points" required onchange="updateTotal()">
            <?php 
            // Loop to generate options in intervals of 10 points
            for ($i = 10; $i <= $maxPoints; $i += 10) { 
                ?>
                <!-- Option for interval of 10 -->
                <option value="<?php echo $i; ?>"><?php echo $i; ?> points</option>
            <?php } ?>
            <?php if ($totalPointsNeeded > 10) { ?>
                <!-- Additional option for remaining points if greater than 10 -->
                <option value="<?php echo $totalPointsNeeded; ?>"><?php echo $totalPointsNeeded; ?> points</option>
            <?php } ?>
        </select>
        <br><br>
        <label for="userCsv" class="form-label">CSV:</label>
        <input type="text" class="form-control" id="userCsv" name="userCsv" style="width: 200px;" required> <br> 
        <!-- Display validation message if any -->
        <span class="text-danger"><?php echo isset($validationMessage) ? $validationMessage : ''; ?></span>
        <br><br>
        <button type="submit" class="btn btn-primary">Pay</button>
        <a href="account.php" class="btn btn-secondary">back</a> <br><br>
    </form>
</center>

<!-- JavaScript function to update the total cost-->
<script>
    function updateTotal() {
        // Get the selected quantity of points from the dropdown menu
        var points = document.getElementById('points').value;
        // Calculate the total cost based on the selected quantity
        var total = points * 10;
        // Update the displayed total 
        document.getElementById('total').textContent = total;
    }
</script>
<footer>
    <center>
       <p><a href="contact.php">Contact us</a></p>
       <p><a href="copyright.php">Copyright</a></p>
       <p><a href="termsofuse.php">Terms of use</a></p>
       <p><a href="home.php">2024 Sustain Energ</a></p>
    </center>
</footer>

</body>

</html>
