<?php

require_once "connection.php";

if(isset($_REQUEST['btn_insert']))
{
    try
    {
        $name	= $_REQUEST['txt_name'];	//textbox name "txt_name"
        $dname = $_REQUEST['dName'];




        if(empty($name)){
            $errorMsg="Please Enter Name";
        }

        if($dname == 0) {
            $errorMsg= $errorMsg . " Please select a department";
        }



        if(!isset($errorMsg))
        {


            $insert_stmt=$db->prepare('INSERT INTO course(cname, depid) VALUES(:fname, :dptid)'); //sql insert query
            $insert_stmt->bindParam(':fname',$name);
            $insert_stmt->bindParam(':dptid',$dname);


            if($insert_stmt->execute())
            {
                $insertMsg="Added Successfully !!!"; //execute query success message
                //header("refresh:3;course-index.php"); //refresh 3 second and redirect to course-index.php page
            }
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

?>

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
        <h4><b>Add Courses<b></h4>



        <?php
        if(isset($errorMsg))
        {
            ?>
            <div class="alert alert-danger">
                <strong>WRONG ! <?php echo $errorMsg; ?></strong><br>
            </div>
            <?php
        }
        if(isset($insertMsg)){
            ?>
            <div class="alert alert-success">
                <strong>SUCCESS ! <?php echo $insertMsg; ?></strong><br>
            </div>
            <?php
        }
        ?>

        <form method="post" class="form-horizontal" enctype="multipart/form-data">



            <p>
                <select class="w3-input w3-border" name="dName">
                    <option value="0">Select Department</option>
                    <option value="1">Faculty of Computing</option>
                    <option value="2">Faculty of Engineering</option>
                    <option value="3">Faculty of Business</option>
                </select></p>






            <div class="form-group">

                <p><input class="w3-input w3-border" type="text" placeholder="Course Name" name="txt_name" required></p>

            </div>





            <br>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <input type="submit"  name="btn_insert" class="btn btn-success w3-button w3-block w3-black " value="Insert">

                </div>
            </div>

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