
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # Open database connection
    require("connectSQL.php");

    # Get connection,load and validate functions.
    require("login_tools.php");

    # Check login
    list($check, $data) = validate($link, $_POST["email"], $_POST["pass"]);

    # On success set session data and display logged in page.
    if ($check) {
        # Access session
        session_start();
        $_SESSION["userID"] = $data["userID"];
        $_SESSION["firstName"] = $data["firstName"];
        $_SESSION["lastName"] = $data["lastName"];
        $_SESSION["email"] = $data["email"];
        $userID = $_SESSION["userID"];
        load("home.php");

    }
    # Or on failure set errors.
    else {
        $errors = $data;
      
    }
    # Close database connection
    mysqli_close($link);
}

# Continue to display login page on failure
include("login.html");

if (!empty($errors)) {
    echo "<br><center><p>The following errors occurred:</p></center>";
    foreach ($errors as $msg) {
        echo "<center>$msg</center>";
    }
    echo "<center><p>Please try again</p></center>";
}



?>