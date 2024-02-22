<?php
session_start();
// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $e = $_GET['email'];

    // Connect to the database
    require("connectSQL.php");

    // Initalise an error array
    $errors = array();


    if (empty($_POST["pass"])) {
        $errors[] = 'Enter a new password';
    } else {
        $p = mysqli_real_escape_string($link, trim($_POST["pass"]));
    }

    $sql = "UPDATE users SET pass=SHA2('$p', 256)  WHERE email='$e'";
    $r = @mysqli_query($link, $sql);

    if ($r) {
        header("Location: login.html");
    } else {
        echo "Error updating record:" . $link->error;
    }

    mysqli_close($link);
   

}
?>

<!DOCTYPE html>
<html>

<Head>
    <title>Update password</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
    
</Head>

<body>
    <br>
    <h2>Update password</h2>
    <br>

    <div class="container">
        <form action="updatePassword.php<?php echo isset($_GET['email']) ? '?email='.$_GET['email'] : ''; ?>" method="post">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <label for="pass" class="form-label">Enter new password:</label>
                    <input type="password" class="form-control" id="pass" name="pass" required value="<?php if (isset($_POST["pass"])) echo $_POST["pass"]; ?>"><br>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="account.php" class="btn btn-secondary">Back</a>
                </div>
        </form>
</body>

</html>