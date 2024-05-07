<?php
# Open database connection.
require('connectSQL.php');

// Start the session
session_start();

// Deactivate the account based on the userID given by using GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = htmlspecialchars($_SESSION["userID"]);
    $sql = "UPDATE users SET accountStatus='deactivated' WHERE userID='$id'";
    $sql2 = "DELETE FROM companyinfo WHERE userID = '$id'";
    //$sql2 = "UPDATE companyinfo SET points='0' WHERE userID='$id'";

    if ($link->query($sql) === TRUE) {
        header("Location: account.php");
    } else {
        echo "Error deleting record: " . $link->error;
    }
} else {
    echo "No user ID provided.";
}

if ($link->query($sql2) === TRUE) {
    header("Location: account.php");
} else {
    echo "Error deleting record: " . $link->error;
}


?>