<?php
# Open database connection.
require('connectSQL.php');

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = htmlspecialchars($_SESSION["userID"]);
    $sql = "DELETE FROM cards WHERE userID='$id'";

    if ($link->query($sql) === TRUE) {
        header("Location: account.php");
    } else {
        echo "Error deleting record: " . $link->error;
    }
} else {
    echo "No user ID provided.";
}
?>