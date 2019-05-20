<?php
session_start();
$_SESSION['sid'] = null;
header('location: login.php');
?>