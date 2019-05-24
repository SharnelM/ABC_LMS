<?php
$hostname="localhost";
$username="root";
$password="";
$databasename ="itpm_lms_1";

$connect = mysqli_connect($hostname,$username,$password,$databasename);
$query_departments = "SELECT `did`, `dName` FROM `department`";
$query_courses = "SELECT `cId`, `depId`, `lId`, `cName` FROM `course`";
$query_subjects = "SELECT `subId`, `subName`, `cId` FROM `subject`";

$departments = mysqli_query($connect , $query_departments);
$courses = mysqli_query($connect , $query_courses);
$subjects = mysqli_query($connect , $query_subjects);

$departments_array = array();
while ($dpts = mysqli_fetch_array($departments)) {
	$departments_array[] = [$dpts['did'], $dpts['dName']];
}
$courses_array = array();
while ($crs = mysqli_fetch_array($courses)) {
	$courses_array[] = [$crs['cId'], $crs['depId'], $crs['lId'], $crs['cName']];
}
$subjects_array = array();
while ($subs = mysqli_fetch_array($subjects)) {
	$subjects_array[] = [$subs['subId'], $subs['subName'], $subs['cId']];
}
?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset="UTF-8">
	    <title>Menu</title>
		<style type="text/css">
			#menu {
				margin-top:15px
			}
			#menu ul {
				list-style:none;
				position:relative;
				float:left;
				margin:0;
				padding:0
			}
			#menu ul a {
				display:block;
				color:#000;
				text-decoration:none;
				font-weight:700;
				font-size:12px;
				line-height:32px;
				padding:0 15px;
			}
			#menu ul li {
				position:relative;
				float:left;
				margin:0;
				padding:0
			}
			#menu ul li:hover {
				background:#008000;
			}
			#menu ul ul {
				display:none;
				position:absolute;
				top:100%;
				left:0;
				background:#fff;
				padding:0
			}
			#menu ul ul li {
				float:none;
			}
			#menu ul ul ul {
				top:0;
				left:100%
			}
			#menu ul li:hover > ul {
				display:block
			}
		</style>
	</head>
	<body>
		<div id="menu">
			<ul>
			<?php
				foreach ($departments_array as $dpts) {
					$did = $dpts[0];
					echo '<li>';
					echo '<a href="#">'.$dpts[1].'</a>';
					foreach ($courses_array as $crs) {
						$cid = $crs[0];
						$cdid = $crs[1];
						if($did == $cdid) {
							echo '<ul>';
							echo '<li>';
							echo '<a href="#">'.$crs[3].'</a>';
							foreach ($subjects_array as $sbs) {
								$ccid = $sbs[2];
								if($cid == $ccid) {
									echo '<ul>';
										echo '<li>';
											echo '<a href="#">'.$sbs[1].'</a>';
										echo '</li>';
									echo '</ul>';
								}
							}
							echo '</li>';
							echo '</ul>';
						}
					}
					echo '</li>';
				}
			?>
			</ul>
		</div>
	</body>
</html>