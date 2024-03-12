<?php
function load($page = "home.php")
{
    # Begin URL with protocol, domain, and current directory.
    $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]);

    # Remove Trailing slashes then append page name to URL
    $url = rtrim($url, "/\\");
    $url .= "/" . $page;

    # Execute redirect then quit
    header("Location: $url");
    exit();
}

# Function to check email address and password
function validate($link, $email = "", $p = "")
{
    # Initialise errors array
    $errors = array();

    # Check email field
    if (empty($email)) {
        $errors[] = "Enter your email address.";
    } else {
        $e = mysqli_real_escape_string($link, trim($email));
    }

    # Check password field
    if (empty($p)) {
        $errors[] = "Enter your password.";
    } else {
        $p = mysqli_real_escape_string($link, trim($p));
    }

    if (empty($errors)) {
        $q = "SELECT userID, firstName, lastName FROM users WHERE email='$e' AND pass=SHA2('$p', 256)";
        $r = mysqli_query($link, $q);
        if (@mysqli_num_rows($r) == 1) {
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
            return array(true, $row);
        } else {
            $errors[] = "Email address and password not found";
        }
    }
    return array(false, $errors);
}
