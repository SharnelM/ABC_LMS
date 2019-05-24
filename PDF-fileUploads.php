<html>
<title>ABC Institute</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<body>

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4" id="topHeader"> <!--Configure onclick-->
	<button class="w3-bar-item w3-right w3-dark-grey w3-hover-light-grey" onclick="w3_open();">Login</button>
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
		<h4><b>Add files<b></h4>




		<?php
		$user = "root";
		$password = "";
		$host = "localhost";
		$dbase = "itpm_lms_1";

		$connection = new mysqli($host, $user, $password, $dbase);
		if ($connection->connect_error) {
			die ('Could not connect:' . $connection->connect_error);
		}

		if(isset($_FILES['file']['name']) && isset($_POST['description']) && isset($_POST['subId'])) {
			$name = $_FILES['file']['name'];
			$tmp_name= $_FILES['file']['tmp_name'];
			$description = $_POST['description'];
			$subId = $_POST['subId'];

			if (isset($name)) {
				$path = 'Uploads/';
				if (!empty($name)){
					if (move_uploaded_file($tmp_name, $path.$name)) {
						if($connection->query("INSERT INTO file_names (description, filename, subId) VALUES ('$description', '$name', '$subId')")) {
							echo 'File successfully uploadeds!';
						}
					}
				}
			}
		}

		?>
		<form action="file-add.php" method='post' enctype="multipart/form-data">
			Subject: <select name="subId">
				<?php
					$result = $connection->query("SELECT * FROM subject");
					if ($result->num_rows > 0) {
						while($row = mysqli_fetch_array($result))
						{
							echo '<option value='.$row['subId'].'>'.$row['subName'].'</option>';
						}
					}
				?>
			</select><br><br>

			Name of File: <input type="text" name="description"/><br><br>
			<input type="file" name="file"/><br><br>
			<input type="submit" name="submit" value="Upload"/>
		</form>

		<?php
		$result = $connection->query("SELECT description, filename FROM file_names ORDER BY ID desc");
		print "<table border=1>\n";
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()){
				$files_field = $row['filename'];
				$files_show = "Uploads/$files_field";
				$descriptionvalue= $row['description'];
				print "<tr>\n";
				print "\t<td>\n";
				echo "<font face=arial size=4/>$descriptionvalue</font>";
				print "</td>\n";
				print "\t<td>\n";
				echo "<div align=center><a href='$files_show'>$files_field</a></div>";
				print "</td>\n";
				print "</tr>\n";
			}
		}
		print "</table>\n";

		mysqli_close($connection);
		?>
		</body>
