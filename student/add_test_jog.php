<?php
	include "../dbconnection.php";
	date_default_timezone_set("Asia/Ashgabat");
    $gutaran_wagt=date("H:i:s");
    $sene=date("Y-m-d");

	if (isset($_POST['jogap'])){
		$jogap=$_POST['jogap'];
		$id_talyp=$_POST['id_talyp'];
		$aralyk_jemleme=$_POST['aralyk_jemleme'];
		$bashlan_wagt=$_POST['bashlan_wagt'];
		$ders_id=$_POST['ders_id'];
		$t_s=$_POST['t_s'];
		$b_j=$_POST['b_j'];

		
		mysqli_query($con, "INSERT INTO bellenen_jogap_test (talyp_id, ders_id, totan_sorag, bolmaly_jogap, bellenen_jogap, bashlan_wagty, gutaran_wagty, sene, aralyk_jemleme) VALUES ('$id_talyp', '$ders_id', '$t_s', '$b_j', '$jogap', '$bashlan_wagt', '$gutaran_wagt', '$sene', '$aralyk_jemleme')
			");
	}

?>