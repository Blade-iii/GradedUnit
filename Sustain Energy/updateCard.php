<?php
session_start();
// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = htmlspecialchars($_SESSION["userID"]);

    // Connect to the database
    require("connectSQL.php");

    // Initalise an error array
    $errors = array();

    // Check for id
    if (empty($_POST["userID"])) {
        $errors[] = 'No  ID';
    } else {
        $id = mysqli_real_escape_string($link, trim($_POST["userID"]));
    }

    // Check for name
    if (empty($_POST["cardNum"])) {
        $errors[] = 'Update card number';
    } else {
        $cn = mysqli_real_escape_string($link, trim($_POST["cardNum"]));
    }

    if (empty($_POST["cardExpire"])) {
        $errors[] = 'Update card expiry date';
    } else {
        $ce = mysqli_real_escape_string($link, trim($_POST["cardExpire"]));
    }

    if (empty($_POST["cardCsv"])) {
        $errors[] = 'Update card CSV';
    } else {
        $ccsv = mysqli_real_escape_string($link, trim($_POST["cardCsv"]));
    }




    $sql = "UPDATE cards SET cardNum='$cn', cardExpire='$ce', cardCsv='$ccsv' WHERE userID='$id'";
    $r = @mysqli_query($link, $sql);

    if ($r) {
        header("Location: account.php");
    } else {
        echo "Error updating record:" . $link->error;
    }

    mysqli_close($link);
    //exit();

}
?>

<!DOCTYPE html>
<html>

<Head>
    <title>Update Card Details</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
    
</Head>

<body>
    <br>
    <h2>Update card Information</h2>
    <br>

    <div class="container">
        <form action="updateCard.php" method="post">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <label for="cardNum" class="form-label">Card Number: (1111222233334444)</label>
                    <input type="text" maxlength="16" class="form-control" id="cardNum" name="cardNum" required value="<?php if (isset($_POST["cardNum"])) echo $_POST["cardNum"]; ?>"><br>
                    <br>
                    <label for="cardExpire">Card Expiry Date: (1124)</label>
                    <input type="text" maxlength="4" class="form-control" id="cardExpire" name="cardExpire" required value="<?php if (isset($_POST["cardExpire"])) echo $_POST["cardExpire"]; ?>"><br>
                    <br>
                    <label for="cardCsv">Card CSV Number: (123)</label>
                    <input type="text" maxlength="3" class="form-control" id="cardCsv" name="cardCsv" required value="<?php if (isset($_POST["cardCsv"])) echo $_POST["cardCsv"]; ?>"><br>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="account.php" class="btn btn-secondary">Back</a>
                </div>
        </form>
</body>

</html>