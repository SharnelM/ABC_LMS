<!DOCTYPE html>
<html>
<title>ABC Institute</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4" id="topHeader"> <!--Configure onclick-->
    <button class="w3-bar-item w3-right w3-dark-grey w3-hover-light-grey" onclick="window.location.href = 'login.php';">Login</button>
</div>

<!-- Header -->
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center">
        <h4>YOUR PATH TO GREATNESS BEGINS HERE</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">ABC Institute</h1>
        <div class="w3-padding-32">

            <button class="w3-btn w3-xlarge w3-theme-dark w3-hover-teal" onclick="window.location.href = 'login.php'" style="font-weight:900;">ABC Learning Management System</button>
        </div>
    </div>
</header>

<div class="w3-row-padding w3-center w3-margin-top" id="faculties">
    <div class="w3-third">
        <div class="w3-card w3-container" style="min-height:460px">
            <h3>Computing</h3><br>
            <i class="fa fa-desktop w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
            <p>The ABC Faculty of Computing is equipped with a range of courses specialising in various arms of the IT sector.</p>
        </div>
    </div>

    <div class="w3-third">
        <div class="w3-card w3-container" style="min-height:460px">
            <h3>Engineering</h3><br>
            <i class="fa fa-cogs w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
            <p>The Faculty of Engineering of ABC Institute is the epicenter of engineering education, research, knowledge creation and distribution.</p>
        </div>
    </div>

    <div class="w3-third">
        <div class="w3-card w3-container" style="min-height:460px">
            <h3>Business</h3><br>
            <i class="fa fa-group w3-margin-bottom w3-text-theme" style="font-size:120px"></i>
            <p>The Faculty of Business within ABC Institute continues to rise up to the challenge of nurturing leaders, managers and IS professionals that can make decisions and implement actions that are right for themselves, right for their organizations and right for the wider community within which they exist.</p>
        </div>
    </div>
</div><br>

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