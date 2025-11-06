<?php
	include "dbcon.php";
	$id=$_POST['id'];
	$bashlanyan=$_POST['bashlanyan'];
	$gutaryan=$_POST['gutaryan'];
	$ders_id=$_POST['ders_id'];

	$bash=strtotime($bashlanyan);
	$bash=date("Y-m-d H:i:s", $bash);

	$gutar=strtotime($gutaryan);
	$gutar=date("Y-m-d H:i:s", $gutar);

	$query=mysqli_query($con, "SELECT * FROM synag_reje WHERE toparcha_id='$id'");
	$row_num=mysqli_num_rows($query);
	//echo $row_num;
	if ($row_num>0){
		mysqli_query($con, "UPDATE synag_reje SET bashlayan_wagty='$bash', gutaryan_wagty='$gutar', ders_id='$ders_id' WHERE toparcha_id='$id'");
	} else 
	{
		mysqli_query($con, "INSERT INTO synag_reje (toparcha_id, bashlayan_wagty, gutaryan_wagty, ders_id) VALUES
				('$id', '$bash', '$gutar', '$ders_id') 
			");
	}
?>