<?php
	include "dbcon.php";

	$id = 0;
	if(isset($_POST['id'])){
	   $id = mysqli_real_escape_string($con,$_POST['id']);
	}
	if($id > 0){
		mysqli_query($con, "UPDATE ulanyjylar SET isonline='0' WHERE id='$id'");
	}

	echo 1;
	exit;

?>