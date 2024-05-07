<?php
session_start(); // Start the session
date_default_timezone_set('Europe/London'); // Set the default timez
// Connects to database
require("connectSQL.php");

$userID = $_SESSION["userID"];

  /// Query selects everything from companyinfo where the userID matches
  $sql1 = "SELECT * from companyinfo WHERE userID = '$userID'";
  $r1 = mysqli_query($link, $sql1);
  $row = mysqli_fetch_array($r1, MYSQLI_ASSOC);

  if (mysqli_num_rows($r1) == 0) {
    // Redirect to account.php if user is not found
    echo '<script>alert("Please add points to view award.");</script>';
    echo '<script>setTimeout(function(){ window.location.href = "account.php"; }, 0);</script>';
  }

    // Query selects everything from users where the userID matches
    $sql2 = "SELECT *  from users WHERE userID = '$userID'";
    $r2 = mysqli_query($link, $sql2);
    $row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC);
   
    // Assigns the regDate from database into a variable and then formats the date into UK format
    $regDate = $row["regDate"];
    $formattedDate = date('d/m/y', strtotime($regDate));

    if ($row2["accountStatus"] !== "active") {
      echo '<script>alert("Please activate your account.");</script>';
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
  <title>Award Page</title>
</head>

<body>


<br>


  <br>
    <h2> Award Page</h2>
  <br>
<!-- Card for users recieving an award which will display their company name, their company award level and points gained and the date of award -->
<?php 

if ($row['award']=="Bronze") {
  echo'<style>
  .award-card {
    border: 10px solid #CD7F32; 
    background-color: #fff; 
    border-radius: 20px; 
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 20px; 
  }
</style>';
}
if ($row['award']=="Silver") {
  echo'<style>
  .award-card {
    border: 10px solid #C0C0C0; 
    background-color: #fff; 
    border-radius: 20px; 
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 20px; 
  }
</style>';
}
if ($row['award']=="Gold") {
  echo'<style>
  .award-card {
    border: 10px solid #ffd700; 
    background-color: #fff; 
    border-radius: 20px; 
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 20px; 
  }
</style>';
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 d-flex justify-content-center">
            <div class="card award-card" style="width: 60rem;">
                <div class="card-body">
                    <h5 class="card-title">Congratulations on achieving the <?php echo $row["award"]?> award! </h5>
                    <p class="card-text">
                        We extend our heartfelt congratulations to <?php echo $row2["companyName"] ?> for their unwavering commitment to environmental sustainability. By implementing a range of green measures within their company, such as carbon emissions reduction, waste reduction, renewable energy usage, and biodiversity preservation, <?php echo $row2["companyName"] ?>. Their dedication to sustainability not only benefits the environment but also sets a standard for other businesses to follow. We applaud their efforts and look forward to witnessing their continued success in creating eco-friendlier future for us all.
                        <br>
                        <strong>Points Gained :</strong> <?php echo $row["points"]?>
                        <br>
                        <strong>Award date:</strong> <?php echo $formattedDate?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<center>
    <br>
<a href="#" class="btn btn-primary">Download award</a>
<a href="account.php" class="btn btn-secondary">Back</a>
</center>


        
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


