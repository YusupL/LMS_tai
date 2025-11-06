<?php
	include "dbcon.php";
	$id=$_POST['id'];
	$mug_id=$_POST['mug_id'];

	$query=mysqli_query($con, "SELECT * FROM toparchalar WHERE id='$id'");
	$row_num=mysqli_num_rows($query);
	mysqli_query($con, "UPDATE toparchalar SET halypa_mug='$mug_id' WHERE id='$id'");
?>