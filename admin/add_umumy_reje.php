<?php
	include "dbcon.php";

	$ders=$_POST['ders'];
	$otag=$_POST['otag'];
	$gun=$_POST['gun'];
	$jubut=$_POST['jubut'];
	$toparcha_id=$_POST['toparcha_id'];
	$s_m=$_POST['s_m'];

	//echo $ders." ".$otag." ".$gun." ".$jubut." ".$toparcha_id." ".$s_m." /";

	$query_yn=mysqli_query($con, "SELECT * FROM umumy_reje WHERE toparcha_id='$toparcha_id' AND gun='$gun' AND jubut='$jubut' AND s_m='$s_m' ");
	$row_num=mysqli_num_rows($query_yn);
	//echo $row_num." ";
	if ($row_num>0){
		while ($row_yn=mysqli_fetch_array($query_yn)){
			$id=$row_yn['id'];
			//echo $id."------";
		}
		mysqli_query($con, "UPDATE umumy_reje SET ders_id='$ders', toparcha_id='$toparcha_id', gun='$gun', jubut='$jubut', otag='$otag', s_m='$s_m' WHERE id='$id' ");
	} 
	if ($row_num==0) {
		//echo "----".$row_num;
		mysqli_query($con, "INSERT INTO umumy_reje (ders_id, toparcha_id, gun, jubut, otag, s_m) 
			VALUES ('$ders', '$toparcha_id', '$gun', '$jubut', '$otag', '$s_m') ");
	}
	header("location: umumy_rejeup.php");
?>