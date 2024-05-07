<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION["firstName"]) && isset($_SESSION["lastName"])) {
    // Display the users name
    $firstName = htmlspecialchars($_SESSION["firstName"]);
    $lastName = htmlspecialchars($_SESSION["lastName"]);


    require('connectSQL.php');

    // Query all users
    $sql = "SELECT * FROM users";
    $result = mysqli_query($link, $sql);

?>



    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="styles.css">
        <title>Account Page</title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sustain Energy</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Log out</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="account.php">
                                <?php echo $firstName . ' ' . $lastName ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="information.php">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="partners.php">Partners</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>

        <center>
            <h1>Admin Page</h1>
        </center>
        <br>

        <br>
    <?php
    // Check if users exist
    if (mysqli_num_rows($result) > 0) {

        echo '<div class="row justify-content-center text-center">';

        // Loop through users and display cards
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {

            if ($count % 3 === 0) {
                echo '</div>';
                echo '<div class="row justify-content-center text-center">';
            }

            echo '<div class="col-md-4">';
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['firstName'] . ' ' . $row['lastName'] . '</h5>';
            echo '<p class="card-text">Email: ' . $row['email'] . '<br> Account Status: ' . $row['accountStatus'] . '<br> Company Name: ' . $row['companyName'] . '<br> Registration Date: ' . $row['regDate'] . '</p>';

            echo '<form action="updateUser.php?userID=' . $row['userID'] . '" method="post">';
            echo '<button type="submit" class="btn btn-primary">Update</button>';
            echo '</form>';

            echo '<form action="blockUser.php?userID=' . $row['userID'] . '" method="GET">';
            echo '<input type="hidden" name="userID" value="' . $row['userID'] . '">';
            echo '<button type="submit" class="btn btn-danger">Block</button>';
            echo '</form>';


            echo '<form action="removeUser.php?userID=' . $row['userID'] . '" method="GET">';
            echo '<input type="hidden" name="userID" value="' . $row['userID'] . '">';
            echo '<button type="submit" class="btn btn-danger">Remove</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

            // Increment the count
            $count++;
        }

        // Close the last row 
        if ($count % 3 !== 0) {
            echo '</div>';
        }
    } else {
        echo '<p>No users found.</p>';
    }
}
    ?>

    <footer>
        <center>
            <p><a href="contact.php">Contact us</a></p>
            <p><a href="copyright.php">Copyright</a></p>
            <p><a href="termsofuse.php">Terms of use</a></p>
            <p><a href="home.php">2024 Sustain Energy</a></p>
        </center>
    </footer>

    </body>

    </html>