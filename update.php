<?php
session_start();
if(!isset($_SESSION['sid'])) {
    header('location: login.php');
}
$sId = $_SESSION['sid'];

$servername = "localhost";
$username = "root";
$password = "";
$database = "itpm_lms_1";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if(isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["EmailAddress"]) && isset($_POST["DateofBirth"]) && isset($_POST["MobileNumber"]) && isset($_POST["Username"]) && isset($_POST["Password"]) && isset($_POST["ConfirmPassword"]) &&  ($_POST["Password"] == $_POST["ConfirmPassword"])) {
    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $EmailAddress = $_POST["EmailAddress"];
    $DateofBirth = $_POST["DateofBirth"];
    $MobileNumber = $_POST["MobileNumber"];
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $ConfirmPassword = $_POST["ConfirmPassword"];

    $sql = "UPDATE student SET fname='$FirstName', lname='$LastName', email='$EmailAddress', dob='$DateofBirth', mobileno='$MobileNumber', username='$Username', password='$Password' WHERE username='$Username'";
    if ($conn->query($sql)) {
        header('location: profile.php');
    }
}

$sql = "SELECT * FROM student WHERE sid='$sId'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['sid'];
        $fName = $row['fname'];
        $lName = $row['lname'];
        $email = $row['email'];
        $dob = $row['dob'];
        $mobileno = $row['mobileno'];
        $username = $row['username'];
        $password = $row['password'];
    }
}
?>
<!DOCTYPE html>
<html>
<title>Update</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4" id="topHeader"> <!--Configure onclick-->
    <button class="w3-bar-item w3-right w3-dark-grey w3-hover-light-grey" onclick="window.location.href = 'logout.php';">Logout</button>
</div>

<!-- Header -->
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center">
        <h4>YOUR PATH TO GREATNESS BEGINS HERE</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">ABC Institute</h1>
        <div class="w3-padding-32">
            <!--Redirect to login page onclick?-->
            <button class="w3-btn w3-xlarge w3-theme-dark w3-hover-teal" onclick="window.location.href = 'HomePageLI.php'" style="font-weight:900;">ABC Learning Management System</button>
        </div>
    </div>
</header>

<div class="w3-row-padding">
    <div class="w3-col s12 w3-center">
        <h4>Update</h4>
        <form action="update.php" method="POST">
            <p><input class="w3-input w3-border" type="text" placeholder="First Name" name="FirstName" required value="<?php echo $fName; ?>"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Last Name" name="LastName" required value="<?php echo $lName; ?>"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Email Address" name="EmailAddress" required value="<?php echo $email; ?>"></p>
            <p><input class="w3-input w3-border" type="date" placeholder="Date of Bith" name="DateofBirth" required value="<?php echo $dob; ?>"></p>
            <p><input class="w3-input w3-border" type="number" placeholder="Mobile Number" name="MobileNumber" required value="<?php echo $mobileno; ?>"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Username" name="Username" required value="<?php echo $username; ?>"></p>
            <p><input class="w3-input w3-border" input type="password" placeholder="Password" name="Password" required value="<?php echo $password; ?>"></p>
            <p><input class="w3-input w3-border" input type="password" placeholder="Confirm Password" name="ConfirmPassword" required value="<?php echo $password; ?>"></p>
            <button type="submit" class="w3-button w3-block w3-black">Update</button>
        </form>
    </div>
</div>
<br><br>



<!-- Footer -->
<!--Add SM links-->
<footer class="w3-center w3-black w3-padding-64">
    <div class="w3-xlarge w3-section">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
</footer>

</body>
</html>