<?php
	include "../dbconnection.php";
	date_default_timezone_set("Asia/Ashgabat");
    $gutaran_wagt=date("H:i:s");
    $sene=date("Y-m-d");

	$jogap=$_POST['jtt'];
	$id_talyp=$_POST['id_t'];
	$aralyk_jemleme=$_POST['a_j'];
	$bashlan_wagt=$_POST['b_w'];
	$ders_id=$_POST['d_id'];
	$t_s=$_POST['t_s'];
	$b_j=$_POST['b_j'];

	
	mysqli_query($con, "INSERT INTO bellenen_jogap_test (talyp_id, ders_id, totan_sorag, bolmaly_jogap, bellenen_jogap, bashlan_wagty, gutaran_wagty, sene, aralyk_jemleme) VALUES ('$id_talyp', '$ders_id', '$t_s', '$b_j', '$jogap', '$bashlan_wagt', '$gutaran_wagt', '$sene', '$aralyk_jemleme')
		");

?>