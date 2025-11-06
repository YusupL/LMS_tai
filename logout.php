<?php
	include 'dbconnection.php';
	session_start();
	$id=$_SESSION['id'];
	// mysqli_query($con, "UPDATE ulanyjylar SET isonline=0 WHERE id='$id'");
	mysqli_query($con, "UPDATE ulanyjylar SET isonline=0, session_token='' WHERE id='$id'");
	session_destroy();
	header('location:index.php');
?>