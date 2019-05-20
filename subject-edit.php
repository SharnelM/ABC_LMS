<?php

require_once "connection.php";

if(isset($_REQUEST['update_id']))
{
    try
    {
        $id = $_REQUEST['update_id'];
        $name=$_REQUEST['txt_name'];//get "update_id" from course-index.php page through anchor tag operation and store in "$id" variable
        $select_stmt = $db->prepare('SELECT * FROM subject WHERE subid =:id, subname=:name'); //sql select query
        $select_stmt->bindParam(':id',$id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        if($row==1){
            while($rs=mysqli_fetch_array($select_stmt)){
                $id=$rs[subid];
                $name=$rs[subname];
            }
        }

    }
    catch(PDOException $e)
    {
        $e->getMessage();
    }

}

if(isset($_REQUEST['btn_update']))
{
    try
    {
        $name	=$_REQUEST['txt_name'];	//textbox name "txt_name"


        if(!isset($errorMsg))
        {
            $update_stmt=$db->prepare('UPDATE subject SET subname=:name_up WHERE subid=:id'); //sql update query
            $update_stmt->bindParam(':name_up',$name);

            $update_stmt->bindParam(':id',$id);

            if($update_stmt->execute())
            {
                $updateMsg="Data Update Successfully.......";	//file update success message
                // header("refresh:3;subject-index.php");	//refresh 3 second and redirect to course-index.php page
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
    <button class="w3-bar-item w3-right w3-dark-grey w3-hover-light-grey"  onclick="window.location.href = 'logout.php';">Log Out</button>
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
        <h4><b>Update Subjects<b></b></h4>

        <?php
        if(isset($errorMsg))
        {
            ?>
            <div class="alert alert-danger">
                <strong>WRONG ! <?php echo $errorMsg; ?></strong>
            </div>
            <?php
        }
        if(isset($updateMsg)){
            ?>
            <div class="alert alert-success">
                <strong>UPDATE ! <?php echo $updateMsg; ?></strong>
            </div>
            <?php
        }
        ?>

        <form method="post" class="form-horizontal" enctype="multipart/form-data">






            <br><br>






            <div class="form-group">

                <div class="col-sm-6">
                    Subject Name:<input type="text" name="txt_name" class="form-control" value="<?php echo $name; ?>" required/>

                </div>
            </div>






            <br><br>





            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <input type="submit"  name="btn_update" class="btn btn-primary" value="Update">
                    <a href="subject-index.php" class="btn btn-danger">Cancel</a>
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