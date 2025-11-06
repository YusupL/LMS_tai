<?php
	$hepde=$_POST['hepde'];
	$ders_id=$_POST['ders_id'];
	$talyp_id=$_POST['talyp_id'];
	$bal=$_POST['bal'];

	include '../dbconnection.php';

	$query=mysqli_query($con, "SELECT COUNT(*) FROM hepde_bal WHERE hepde='$hepde' AND ders_id='$ders_id' AND talyp_id='$talyp_id'");
	while ($row=mysqli_fetch_array($query)) {
		if ($row[0]>0){
			mysqli_query($con, "UPDATE hepde_bal SET talyp_id='$talyp_id', ders_id='$ders_id', hepde='$hepde', bal='$bal' WHERE hepde='$hepde' AND ders_id='$ders_id' AND talyp_id='$talyp_id'");
		} else
		mysqli_query($con, "INSERT INTO hepde_bal (talyp_id, ders_id, hepde, bal) VALUES
								('$talyp_id', '$ders_id', '$hepde', '$bal')
		");
	}
	header('location: points.php');
?>