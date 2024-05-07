<?php

# Open database connection.
require('connectSQL.php');

// Start the session
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userID = $_GET['userID'];
    $sql1 = "DELETE FROM cards WHERE userID='$userID'";
    $sql2 = "DELETE FROM feedback WHERE userID='$userID'";
    $sql3 = "DELETE FROM companyinfo WHERE userID='$userID'";
    $sql4 = "DELETE FROM users WHERE userID='$userID'";

        // Execute delete queries
        if ($link->query($sql1) === TRUE &&
            $link->query($sql2) === TRUE &&
            $link->query($sql3) === TRUE &&
            $link->query($sql4) === TRUE) {
            // Go to account if successful
            header("Location: account.php");
            exit();
        } else {
            echo "Error deleting record: " . $link->error;
        }
    } else {
        
        echo "No user ID provided.";
    }

?>