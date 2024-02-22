<?php
// Start the session
session_start();

// Connects to database
require("connectSQL.php");

// Check if the user's name is set in the session
if (isset($_SESSION["firstName"]) && ($_SESSION["lastName"])) {
  
  // Display the user's name
  $firstName = htmlspecialchars($_SESSION["firstName"]);
  $lastName = htmlspecialchars($_SESSION["lastName"]);
} else {
  include("login.html");
}
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
  <script src="script.js"></script>
  <title>Information Page</title>
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
                    <a class="nav-link" href="account.php">
                        <?php echo $firstName . ' ' . $lastName ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="information.php">Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br>


  <br>
    <h2> Information Page</h2>
  <br>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card" >
          <div class="card-body">
            <h5 class="card-title">Mission Statement</h5>
            <p class="card-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur consectetur pulvinar egestas. Vestibulum et risus nisi. Quisque accumsan purus quis ante dictum, facilisis malesuada elit malesuada. Nam cursus sit amet lorem eget interdum. Etiam non nunc mollis, ultrices dui quis, consectetur orci. In vitae vestibulum nibh. Maecenas sagittis ligula vitae est sagittis, mattis pellentesque mauris pellentesque. Morbi in lobortis tortor. Quisque ac tortor aliquet, semper sapien a, finibus nibh. Nam eleifend, lectus id viverra placerat, nisi mi luctus eros, nec tempus metus metus vel erat. Nunc eu turpis sapien.

            Morbi cursus, metus non malesuada pulvinar, arcu orci varius arcu, vel tincidunt massa tellus vitae urna. Nulla id tincidunt magna. Cras ut semper sapien. Fusce tincidunt semper nisl, id dictum augue blandit et. Donec vel pretium massa. Maecenas quis turpis a ex rhoncus ultrices ac ac orci. Nullam bibendum scelerisque nunc, a gravida diam convallis a. Aliquam cursus luctus nibh, vel venenatis nisl maximus et.

            Duis posuere nisl ac posuere dapibus. Curabitur fringilla sit amet nibh non mollis. Donec eros sapien, placerat facilisis mollis pulvinar, facilisis in nisl. Nulla sit amet nisi metus. Duis ut facilisis enim. Phasellus mollis euismod ornare. Donec varius magna vel turpis sollicitudin viverra vel ut urna. Vestibulum quis massa nec diam vestibulum finibus non eget arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium auctor sapien, sit amet ultrices nibh ullamcorper at. Aenean vehicula est purus, quis interdum quam pharetra id. Sed malesuada massa felis, eget efficitur lacus facilisis aliquam.
            </p>
          </div>
        </div>
    </div>


        <div class="col-md-6">
        <div class="card" >
          <div class="card-body">
            <h5 class="card-title">Partners Statement</h5>
            <p class="card-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur consectetur pulvinar egestas. Vestibulum et risus nisi. Quisque accumsan purus quis ante dictum, facilisis malesuada elit malesuada. Nam cursus sit amet lorem eget interdum. Etiam non nunc mollis, ultrices dui quis, consectetur orci. In vitae vestibulum nibh. Maecenas sagittis ligula vitae est sagittis, mattis pellentesque mauris pellentesque. Morbi in lobortis tortor. Quisque ac tortor aliquet, semper sapien a, finibus nibh. Nam eleifend, lectus id viverra placerat, nisi mi luctus eros, nec tempus metus metus vel erat. Nunc eu turpis sapien.

            Morbi cursus, metus non malesuada pulvinar, arcu orci varius arcu, vel tincidunt massa tellus vitae urna. Nulla id tincidunt magna. Cras ut semper sapien. Fusce tincidunt semper nisl, id dictum augue blandit et. Donec vel pretium massa. Maecenas quis turpis a ex rhoncus ultrices ac ac orci. Nullam bibendum scelerisque nunc, a gravida diam convallis a. Aliquam cursus luctus nibh, vel venenatis nisl maximus et.

            Duis posuere nisl ac posuere dapibus. Curabitur fringilla sit amet nibh non mollis. Donec eros sapien, placerat facilisis mollis pulvinar, facilisis in nisl. Nulla sit amet nisi metus. Duis ut facilisis enim. Phasellus mollis euismod ornare. Donec varius magna vel turpis sollicitudin viverra vel ut urna. Vestibulum quis massa nec diam vestibulum finibus non eget arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas pretium auctor sapien, sit amet ultrices nibh ullamcorper at. Aenean vehicula est purus, quis interdum quam pharetra id. Sed malesuada massa felis, eget efficitur lacus facilisis aliquam.
            </p>
          </div>
        </div>
        </div>





      </div>
</div>
 
<footer>
    <center>
   <p>Contact us</p>
   <p>Privacy & Cookies</p>
   <p>Copyright</p>
   <p>Terms of use</p>
   <p>2024 Sustain Energy</p>
    </center>
</footer>
</body>

</html>