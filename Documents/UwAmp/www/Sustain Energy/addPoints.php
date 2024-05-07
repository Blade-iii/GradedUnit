<?php
session_start();

  // Connects to database
  require("connectSQL.php");

      // Check if the user is logged in
      if (isset($_SESSION["userID"])) {
        $userID = $_SESSION["userID"];

        // Query selects everything from users where the userID matches
        $sql2 = "SELECT * from users WHERE userID = '$userID'";
        $r2 = mysqli_query($link, $sql2);
        $row = mysqli_fetch_array($r2, MYSQLI_ASSOC);

        // Query selects everything from companyinfo where the userID matches
        $sql1 = "SELECT * from companyinfo WHERE userID = '$userID'";
        $r1 = mysqli_query($link, $sql1);
        $row2= mysqli_fetch_array($r1, MYSQLI_ASSOC);

        if ($row["accountStatus"] !== "active") {
            echo '<script>alert("Activate account please.");</script>';
            echo '<script>setTimeout(function(){ window.location.href = "account.php"; }, 0);</script>';
        }
        if ($row2["points"]>0){
            if ($row2["points"] > 0) {
                echo '<script>alert("You cannot submit more points at this time.");</script>';
                echo '<script>setTimeout(function(){ window.location.href = "account.php"; }, 0);</script>';
            }
            
        }
    }

// Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Store the value of the selected radio button in a variable for each question
    $Q1 = isset($_POST['Q1']) ? $_POST['Q1'] : null;
    $Q2 = isset($_POST['Q2']) ? $_POST['Q2'] : null;
    $Q3 = isset($_POST['Q3']) ? $_POST['Q3'] : null;
    $Q4 = isset($_POST['Q4']) ? $_POST['Q4'] : null;
    $Q5 = isset($_POST['Q5']) ? $_POST['Q5'] : null;
    $Q6 = isset($_POST['Q6']) ? $_POST['Q6'] : null;
    $Q7 = isset($_POST['Q7']) ? $_POST['Q7'] : null;
    $Q8 = isset($_POST['Q8']) ? $_POST['Q8'] : null;
    $Q9 = isset($_POST['Q9']) ? $_POST['Q9'] : null;
    $Q10 = isset($_POST['Q10']) ? $_POST['Q10'] : null;

    // Check if at least one option is selected for each question
    if (!isset($Q1) || !isset($Q2) || !isset($Q3) || !isset($Q4) || !isset($Q5) ||
        !isset($Q6) || !isset($Q7) || !isset($Q8) || !isset($Q9) || !isset($Q10)) {
        $errors[] = "Please select an option for each question.";
    }

   // Calculate total points from the users response
    $total = (isset($_POST['Q1']) ? $_POST['Q1'] : 0) + 
    (isset($_POST['Q2']) ? $_POST['Q2'] : 0) + 
    (isset($_POST['Q3']) ? $_POST['Q3'] : 0) +
    (isset($_POST['Q4']) ? $_POST['Q4'] : 0) + 
    (isset($_POST['Q5']) ? $_POST['Q5'] : 0) + 
    (isset($_POST['Q6']) ? $_POST['Q6'] : 0) +
    (isset($_POST['Q7']) ? $_POST['Q7'] : 0) + 
    (isset($_POST['Q8']) ? $_POST['Q8'] : 0) + 
    (isset($_POST['Q9']) ? $_POST['Q9'] : 0) +
    (isset($_POST['Q10']) ? $_POST['Q10'] : 0);

    // Assign the award given based on their total
    if ($total >= 70) {
        $award = "Gold";
    } elseif ($total >= 50) {
        $award = "Silver";
    } else {
        $award = "Bronze";
    }
    

    // On success register user inserting into companyinfo
    if (empty($errors)) {
        $q = "INSERT INTO companyinfo (userID, points, award, regDate) 
              VALUES ('$userID', '$total', '$award', NOW())";
        $r = mysqli_query($link, $q);
        if ($r) {
            header("Location: account.php");
        }
        // Close database connection
        mysqli_close($link);
        exit();
    } else {
        echo "<p>The following errors occurred:</p>";
        foreach ($errors as $msg) {
            echo "$msg<br>";
        }
        echo "<p>Please try again</p>";
        mysqli_close($link);
    }
}

?>
<!DOCTYPE html>
<html>
<Head>
    <title>Add Points</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</Head>

<body>
<br>
    <center>
        <h2>Submit points</h2>
    </center>
    <br>

    <div class="container">
    <form action="addPoints.php" method="post">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <p>Q1) Does the company implement Carbon Emissions Reduction practices?</p>
                <label for="Q1Green" class="form-label">Green(10)</label>
                <input type="radio" id="Q1Green" name="Q1" value="10"><br>
                <label for="Q1Amber" class="form-label">Amber(5)</label>
                <input type="radio" id="Q1Amber" name="Q1" value="5"><br>
                <label for="Q1Red" class="form-label">Red(0)</label>
                <input type="radio" id="Q1Red" name="Q1" value="0"><br>
                <br>

                <p>Q2) Does the company implement Waste Reduction practices?</p>
                <label for="Q2Green" class="form-label">Green(10)</label>
                <input type="radio" id="Q2Green" name="Q2" value="10"><br>
                <label for="Q2Amber" class="form-label">Amber(5)</label>
                <input type="radio" id="Q2Amber" name="Q2" value="5"><br>
                <label for="Q2Red" class="form-label">Red(0)</label>
                <input type="radio" id="Q2Red" name="Q2" value="0"><br>
                <br>

                <p>Q3) Does the company implement Water Conservation practices?</p>
                <label for="Q3Green" class="form-label">Green(10)</label>
                <input type="radio" id="Q3Green" name="Q3" value="10"><br>
                <label for="Q3Amber" class="form-label">Amber(5)</label>
                <input type="radio" id="Q3Amber" name="Q3" value="5"><br>
                <label for="Q3Red" class="form-label">Red(0)</label>
                <input type="radio" id="Q3Red" name="Q3" value="0"><br>
                <br>

                <p>Q4) Does the company implement Renewable Energy Usage?</p>
                <label for="Q4Green" class="form-label">Green(10)</label>
                <input type="radio" id="Q4Green" name="Q4" value="10"><br>
                <label for="Q4Amber" class="form-label">Amber(5)</label>
                <input type="radio" id="Q4Amber" name="Q4" value="5"><br>
                <label for="Q4Red" class="form-label">Red(0)</label>
                <input type="radio" id="Q4Red" name="Q4" value="0"><br>
                <br>

                <p>Q5) Does the company adhere Environmental Compliance?</p>
                <label for="Q5Green" class="form-label">Green(10)</label>
                <input type="radio" id="Q5Green" name="Q5" value="10"><br>
                <label for="Q5Amber" class="form-label">Amber(5)</label>
                <input type="radio" id="Q5Amber" name="Q5" value="5"><br>
                <label for="Q5Red" class="form-label">Red(0)</label>
                <input type="radio" id="Q5Red" name="Q5" value="0"><br>
                <br>

                <p>Q6) Does the company implement Employee Sustainbility Education?</p>
                <label for="Q6Green" class="form-label">Green(10)</label>
                <input type="radio" id="Q6Green" name="Q6" value="10"><br>
                <label for="Q6Amber" class="form-label">Amber(5)</label>
                <input type="radio" id="Q6Amber" name="Q6" value="5"><br>
                <label for="Q6Red" class="form-label">Red(0)</label>
                <input type="radio" id="Q6Red" name="Q6" value="0"><br>
                <br>

                <p>Q7) Does the company take part in Community Engagement?</p>
                <label for="Q7Green" class="form-label">Green(10)</label>
                <input type="radio" id="Q7Green" name="Q7" value="10"><br>
                <label for="Q7Amber" class="form-label">Amber(5)</label>
                <input type="radio" id="Q7Amber" name="Q7" value="5"><br>
                <label for="Q7Red" class="form-label">Red(0)</label>
                <input type="radio" id="Q7Red" name="Q7" value="0"><br>
                <br>

                <p>Q8) Does the company implement Transportation Sustainability?</p>
                <label for="Q8Green" class="form-label">Green(10)</label>
                <input type="radio" id="Q8Green" name="Q8" value="10"><br>
                <label for="Q8Amber" class="form-label">Amber(5)</label>
                <input type="radio" id="Q8Amber" name="Q8" value="5"><br>
                <label for="Q8Red" class="form-label">Red(0)</label>
                <input type="radio" id="Q8Red" name="Q8" value="0"><br>
                <br>

                <p>Q9) Does the company implement Biodiversity preservation?</p>
                <label for="Q9Green" class="form-label">Green(10)</label>
                <input type="radio" id="Q9Green" name="Q9" value="10"><br>
                <label for="Q9Amber" class="form-label">Amber(5)</label>
                <input type="radio" id="Q9Amber" name="Q9" value="5"><br>
                <label for="Q9Red" class="form-label">Red(0)</label>
                <input type="radio" id="Q9Red" name="Q9" value="0"><br>
                <br>

                <p>Q10) Does the company implement Biodiversity preservation?</p>
                <label for="Q10Green" class="form-label">Green(10)</label>
                <input type="radio" id="Q10Green" name="Q10" value="10"><br>
                <label for="Q10Amber" class="form-label">Amber(5)</label>
                <input type="radio" id="Q10Amber" name="Q10" value="5"><br>
                <label for="Q10Red" class="form-label">Red(0)</label>
                <input type="radio" id="Q10Red" name="Q10" value="0"><br>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="account.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>


</body>

</html>


