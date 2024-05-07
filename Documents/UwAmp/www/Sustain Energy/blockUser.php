<?php

# Open database connection.
require('connectSQL.php');

// Start the session
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userID = $_GET['userID'];
    $sql1 = "UPDATE users SET accountStatus='blocked' WHERE userID='$userID'";
 
        // Execute delete queries
        if ($link->query($sql1) === TRUE) {
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