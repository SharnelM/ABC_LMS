<?php
session_start();
if(!isset($_SESSION['sid'])) {
    header('location: login.php');
} else {

    $sId = $_SESSION['sid'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "itpm_lms_1";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    if($_GET['delete'] == true) {
        $conn->query("DELETE FROM student WHERE sid=$sId");
        header('location: login.php');
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
        }
    }
}

require_once "connection.php";

if(isset($_REQUEST['delete_id']))
{
    // select image from db to delete
    $id=$_REQUEST['delete_id'];	//get delete_id and store in $id variable

    $select_stmt= $db->prepare('SELECT * FROM course WHERE cid =:id');	//sql select query
    $select_stmt->bindParam(':id',$id);
    $select_stmt->execute();
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);


    //delete an orignal record from db
    $delete_stmt = $db->prepare('DELETE FROM course WHERE cid =:id');
    $delete_stmt->bindParam(':id',$id);
    $delete_stmt->execute();

    header("Location:course-index.php");
}
?>

<!DOCTYPE html>
<html>
<title>Faculty Of Engineering</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4" id="topHeader"> <!--change the button to direct to user profile-->
    <button class="w3-bar-item w3-right w3-dark-grey w3-hover-light-grey" onclick="window.location.href = 'logout.php';">Log Out</button>
</div>

<!-- Header -->
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center">
        <h4>YOUR PATH TO GREATNESS BEGINS HERE</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">ABC Institute</h1>
        <div class="w3-padding-32">

            <button class="w3-btn w3-xlarge w3-theme-dark w3-hover-teal" onclick="window.location.href = 'HomePageLI.php'" style="font-weight:900;">ABC Learning Management System</button>
        </div>
    </div>
</header>

<!--Add A NavBar-->

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- The Grid -->
    <div class="w3-row">
        <!-- Left Column -->
        <div class="w3-col m3">
            <!-- Profile -->
            <div class="w3-card w3-round w3-white">
                <div class="w3-container">
                    <h4 class="w3-center">My Profile</h4><br>
                    <p class="w3-center"><i class="fa fa-user-circle w3-margin-bottom w3-text-theme" style="font-size:120px"></i></p>
                    <hr>
                    <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> <?php echo $fName . " " . $lName; ?></p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?php echo $email; ?></p>
                    <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo $dob; ?></p>
                    <p><i class="fa fa-phone fa-fw w3-margin-right w3-text-theme"></i> <?php echo $mobileno; ?></p>
                    <a href="update.php">Edit</a> <a href="?delete=true">Delete</a>
                </div>
            </div>
            <br>

            <!-- Accordion -->
            <div class="w3-card w3-round">
                <div class="w3-white">
                    <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
                    <div id="Demo1" class="w3-hide w3-container">
                        <p>Some text..</p>
                    </div>
                    <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
                    <div id="Demo2" class="w3-hide w3-container">
                        <p>Some other text..</p>
                    </div>
                </div>
            </div>
            <br>
        </div>

        <!-- Middle Column -->
        <div class="w3-col m7">

            <div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container w3-padding">
                            <h2 class="w3-center">Faculty of Engineering</h2><br>
                            <p class="w3-center"><i class="fa fa-cogs w3-margin-bottom w3-text-theme" style="font-size:120px"></i></p><br> <!--Add Links to respective pages-->

                            <div class="w3-row-padding">
                                <div class="w3-col s12 w3-center">
                                    <h2>Degree Programmes</h2>

                                    <div class="w3-container">
                                        <hr>

                                        <div class="w3-responsive w3-card-4">
                                            <table class="w3-table w3-striped w3-bordered">
                                                <thead>
                                                <tr class="w3-theme">
                                                    <th>Lecture Name</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $select_stmt=$db->prepare("SELECT * FROM course WHERE depId = 2");	//sql select query
                                                $select_stmt->execute();
                                                while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['cname']; ?></td>

                                                        <td><a href="course-edit.php?update_id=<?php echo $row['cId']; ?>" class="btn btn-warning">Edit</a></td>
                                                        <td><a href="?delete_id=<?php echo $row['cId']; ?>" class="btn btn-danger">Delete</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br><br>

            <div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container w3-padding">
                            <h2 class="w3-center">Add New Degree Programmes</h2><br>
                            <p class="w3-center"><i class="fa fa-plus-circle w3-margin-bottom w3-text-theme" style="font-size:120px"></i></p><br>
                            <p class="w3-center"><button class="w3-btn w3-xlarge w3-theme-dark w3-hover-teal" onclick="window.location.href = 'course-add.php'" style="font-weight:900;">Add New Degree Programme</button></p>
                        </div>
                    </div>
                </div>
            </div><br><br>

            <div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container w3-padding">
                            <h2 class="w3-center">Subjects</h2><br>
                            <p class="w3-center"><i class="fa fa-file-word-o w3-margin-bottom w3-text-theme" style="font-size:120px"></i></p><br>
                            <p class="w3-center"><button class="w3-btn w3-xlarge w3-theme-dark w3-hover-teal" onclick="window.location.href = 'subjects.php'" style="font-weight:900;">Subjects Management</button></p>
                        </div>
                    </div>
                </div>
            </div><br><br>

            <div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container w3-padding">
                            <h2 class="w3-center">Assignments</h2><br>
                            <p class="w3-center"><i class="fa fa-tasks w3-margin-bottom w3-text-theme" style="font-size:120px"></i></p><br>
                            <p class="w3-center"><button class="w3-btn w3-xlarge w3-theme-dark w3-hover-teal" onclick="window.location.href = 'subjects.php'" style="font-weight:900;">Assignments Handling</button></p>
                        </div>
                    </div>
                </div>
            </div>



            <!-- End Middle Column -->
        </div>

        <!-- Right Column -->
        <div class="w3-col m2">
            <div class="w3-card w3-round w3-white w3-center">
                <div class="w3-container">
                    <p>Notifications</p>
                    <p><strong>No New Notifications</strong></p>
                    <!--<p>Friday 15:00</p>
                    <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>-->
                </div>
            </div>
            <br>

            <div class="w3-card w3-round w3-white w3-center">
                <div class="w3-container">
                    <p>Upcoming Events</p>
                    <p><strong>No Upcoming Events</strong></p>
                    <!--<p>Friday 15:00</p>
                    <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>-->
                </div>
            </div>
            <br>

            <!-- End Right Column -->
        </div>
    </div>
</div> <br>

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


<script>
    // Accordion
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-theme-d1";
        } else {
            x.className = x.className.replace("w3-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace(" w3-theme-d1", "");
        }
    }

</script>

</body>
</html>