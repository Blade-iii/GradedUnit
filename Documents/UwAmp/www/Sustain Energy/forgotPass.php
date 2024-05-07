<!DOCTYPE html>
<html>
<Head>
    <title>Forgot Password</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</Head>

<body>
<br>
    <center>
        <h2>Forgot Password</h2>
    </center>
    <br>

<!-- Form for the user to input their email and one time password to gain access to resent their password-->
    <div class="container">
        <form action="forgotPass.php" method="post">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" required value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>"><br>
                   
                    <label for="otp">Enter your one-time password:</label>
                <input type="password"  class="form-control" id="otp" name="otp" required maxlength="3" value="<?php if (isset($_POST["otp"])) echo $_POST["otp"]; ?>"> <br>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="index.html" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>
</body>

</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Connects to database
    require("connectSQL.php");

    // Sets up an error array
    $errors = array();

    // Check for email
    if (empty($_POST["email"])) {
        $errors[] = "Enter email";
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST["email"]));
    }

    // Check for otp
    if (empty($_POST["otp"])) {
        $errors[] = "Enter one time password";
    } else {
        if (!is_numeric($_POST["otp"])) {
            $errors[] = "OTP must be a number ";
        } else {
            $otp = (int)$_POST["otp"];
        }
    }   


if(empty($errors)){
    // To grab all the users with the associated email that the user inputed.
    $q = "SELECT * FROM users WHERE email='$e'";
    $result = mysqli_query($link,$q);
}
if($result) {
    $row = mysqli_fetch_array($result);
    if($row) {
        // If the otp matches then they will be redirected to the update password if it does not match error is displayed
        if($row['otp'] == $otp) {
            header("Location: updatePassword.php?email=$e");
            exit(); 
        } else {
            $errors[] = "Wrong OTP";
        }
    } else {
        $errors[] = "That email has not been found";
    }
} else {
    $errors[] = "An error has occurred.";
}
    // Display errors
    if (!empty($errors)) {
        echo "<p>The following errors occurred:</p>";
        foreach ($errors as $msg) {
            echo "$msg<br>";
        }
    }
}
?>
    

