<?php
if(isset($_POST["Username"]) && isset($_POST["Password"])) {
    $LoginUsername = $_POST["Username"];
    $LoginPassword = $_POST["Password"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "itpm_lms_1";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

        $sql = "SELECT * FROM student WHERE username='$LoginUsername' AND password='$LoginPassword' UNION SELECT * FROM lecturer WHERE username='$LoginUsername' AND password='$LoginPassword' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                session_start();
                $_SESSION['sid'] = $row["sid"];
                $_SESSION['lid'] = $row["lid"];
                header('location: HomePageLI.php');
            }
        }
}
?>

<!DOCTYPE html>
<html>
<title>ABC Institute - Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4" id="topHeader"> <!--Configure onclick-->
    <button class="w3-bar-item w3-right w3-dark-grey w3-hover-light-grey" onclick="window.location.href = 'register.php'">Register</button>

</div>

<!-- Header -->
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center">
        <h4>YOUR PATH TO GREATNESS BEGINS HERE</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">ABC Institute</h1>
        <div class="w3-padding-32">
            <!--Redirect to login page onclick?-->
            <button class="w3-btn w3-xlarge w3-theme-dark w3-hover-teal" onclick="document.getElementById('id01').style.display='block'" style="font-weight:900;">ABC Learning Management System</button>
        </div>
    </div>
</header>

<div class="w3-row-padding">
    <div class="w3-col s12 w3-center">
        <h4>Login</h4>
        <form action="login.php" method="POST">
            <p><input class="w3-input w3-border" type="text" placeholder="Username" name="Username" required></p>
            <!--change in to password form-->

            <p><input class="w3-input w3-border" type="password" placeholder="Password" name="Password" required></p>

            <button type="submit" class="w3-button w3-block w3-black">Login</button>
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