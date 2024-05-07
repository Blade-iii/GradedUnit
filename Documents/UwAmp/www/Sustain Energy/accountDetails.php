<?php
session_start();
// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = htmlspecialchars($_SESSION["userID"]);
    $fn = htmlspecialchars($_SESSION["firstName"]);
    $ln = htmlspecialchars($_SESSION["lastName"]);
    $e = htmlspecialchars($_SESSION["email"]);
    $p = htmlspecialchars($_SESSION["pass"]);

    // Connect to the database
    require("connectSQL.php");

    // Initalise an error array
    $errors = array();
    
    // Check for name
    if (empty($_POST["firstName"])) {
        $errors[] = 'Update first name';
    } else {
        $fn = mysqli_real_escape_string($link, trim($_POST["firstName"]));
    }

    if (empty($_POST["lastName"])) {
        $errors[] = 'Update last name';
    } else {
        $ln = mysqli_real_escape_string($link, trim($_POST["lastName"]));
    }

    // Check for email
    if (empty($_POST["email"])) {
        $errors[] = 'Update email';
    } else {
        $e = mysqli_real_escape_string($link, trim($_POST["email"]));
    }

    // Check for password
    if (empty($_POST["pass"])) {
        $errors[] = 'Update password';
    } else {
        $p = mysqli_real_escape_string($link, trim($_POST["pass"]));
    }

    // SHA-2 hash the password
    $hashedPassword = hash('sha256', $p);

    // Update the users table with the information that the user inputs in the form
    $sql = "UPDATE users SET firstName='$fn', lastName='$ln', email='$e', pass='$hashedPassword' WHERE userID='$id'";
    $r = @mysqli_query($link, $sql);

    if ($r) {
        header("Location: account.php");
    } else {
        echo "Error updating record:" . $link->error;
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>

<Head>
    <title>Update Account Details</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</Head>

<body>
    <br>
    <h2>Update User Information</h2>
    <br>
    <!-- Form for the user to update their information -->
    <div class="container">
        <form action="accountDetails.php" method="post">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <label for="firstName" class="form-label">First name:</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $_SESSION["firstName"]; ?>" required value="<?php if (isset($_POST["firstName"])) echo $_POST["firstName"]; ?> "> <br>
                    <br>
                    <label for="lastName">Last name:</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $_SESSION["lastName"]; ?>" required value="<?php if (isset($_POST["lastName"])) echo $_POST["lastName"]; ?> "> <br>
                    <br>
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" required value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>"><br>
                    <br>
                    <label for="pass">Enter password:</label>
                    <input type="password" class="form-control" id="pass" name="pass" required value="<?php if (isset($_POST["pass"])) echo $_POST["pass"]; ?>"> <br>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="account.php" class="btn btn-secondary">Back</a>
                </div>
        </form>
</body>
</html>