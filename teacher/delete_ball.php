<?php
	include '../dbconnection.php';

	$id = 0;
	if(isset($_POST['id'])){
	   $id = mysqli_real_escape_string($con,$_POST['id']);
	}
	if($id > 0){
		mysqli_query($con, "DELETE FROM ballar WHERE id='$id'");
	}

	echo 1;
	exit;

?>