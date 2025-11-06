<?php  
 //fetch.php
include '../dbconnection.php';

if(isset($_POST["id"]))
{
	$query = "SELECT * FROM gechilen_dersler WHERE id='".$_POST["id"]."'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);

	$sene=$row['sene'];
	$sapak_gornush=$row['sapak_gornush'];
	$sagat_sany=$row['sagat_sany'];
	$tema_ady=$row['tema_ady'];

	/*$talyplar="";
	$bahalar="";

	$query_gech_ders=mysqli_query($con, "SELECT id FROM gechilen_dersler WHERE sene='$sene' AND sapak_gornush='$sapak_gornush' AND sagat_sany='$sagat_sany' AND tema_ady='$tema_ady'");
	while ($row_gech_ders=mysqli_fetch_array($query_gech_ders)){
		$gech_ders_id=$row_gech_ders['id'];

		$query_baha=mysqli_query($con, "SELECT * FROM sapak_bahalar WHERE gech_ders_id='$gech_ders_id'");
		while ($row_baha=mysqli_fetch_array($query_baha)) {
			$id_talyp=$row_baha['id_talyp'];
			$baha=$row_baha['baha'];

			$talyplar.=$id_talyp."-";
			$bahalar.=$baha."-";
		}
	}
	$row['talyplar']=$talyplar;
	$row['bahalar']=$bahalar;*/
	echo json_encode($row);  
 }  
 ?>