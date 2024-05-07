<!DOCTYPE html>
<html>
<!-- <style>
    body{
        background-color: black !important;
        color: red;
    } 

    label{
        color: red;
    }
    h2{
        color: red;
    }
    
    </style> -->

<Head>
    <title>Register</title>
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
        <h2>Register</h2>
    </center>
    <br>

    <div class="container">
        <form action="create.php" method="post">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <label for="firstName" class="form-label">First name:</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required value="<?php if (isset($_POST["firstName"])) echo $_POST["firstName"]; ?> "> <br>
                    
                    <label for="lastName">Last name:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required value="<?php if (isset($_POST["lastName"])) echo $_POST["lastName"]; ?> "> <br>
                    
                    <label for="company">Company Name:</label>
                    <input type="text" class="form-control" id="company" name="company" required value="<?php if (isset($_POST["company"])) echo $_POST["company"]; ?>"><br>
                    
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" required value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>"><br>
                  
                    <label for="pass1">Enter password:</label>
                    <input type="password" class="form-control" id="pass1" name="pass1" required value="<?php if (isset($_POST["pass1"])) echo $_POST["pass1"]; ?>"> <br>
                   
                    <label for="pass2">Enter your password again:</label>
                    <input type="password" class="form-control" id="pass2" name="pass2" required value="<?php if (isset($_POST["pass2"])) echo $_POST["pass2"]; ?>"> <br>
                   
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

    // Check for name
    if (empty($_POST["firstName"])) {
        $errors[] = "Enter your first name";
    } else {
        $fn = mysqli_real_escape_string($link, trim($_POST["firstName"]));
    }

    if (empty($_POST["lastName"])) {
        $errors[] = "Enter your last name";
    } else {
        $ln = mysqli_real_escape_string($link, trim($_POST["lastName"]));
    }

    // Check for email
    if (empty($_POST["email"])) {
        $errors[] = "Enter email";
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST["email"]));
    }

  // Check for email
  if (empty($_POST["company"])) {
    $errors[] = "Enter Company";
} else {
    $c = mysqli_real_escape_string($link, trim($_POST["company"]));
}

    # Check for a password and matching input passwords.
    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors[] = 'Passwords do not match.';
        } else {
            $p = mysqli_real_escape_string($link, trim($_POST['pass1']));
        }
    } else {
        $errors[] = 'Enter your password.';
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

    # Check if email address already registered.
    if (empty($errors)) {
        $q = "SELECT userID FROM users WHERE email='$e'";
        $r = @mysqli_query($link, $q);
        if (mysqli_num_rows($r) != 0) $errors[] = 'Email address already registered. Sign In Now';
    }


    # On success register user inserting into 'users' database table.
    if (empty($errors)) {
        $status = "inactive";
        $q = "INSERT INTO users (firstName, lastName, email, pass, otp, regDate, companyName, accountStatus) 
        VALUES ('$fn', '$ln', '$e', SHA2('$p', 256), $otp, NOW(), '$c', '$status')";
        $r = @mysqli_query($link, $q);
        if ($r) {
            header("Location: login.html");
        }


        // close database connection
        mysqli_close($link);
        exit();
    } else {
        echo "<p>The following errors occurred:</p>";
        foreach ($errors as $msg)
            echo "$msg<br>";



        echo "<p>Please try again</p>";
        mysqli_close($link);
    }
    
}
?>