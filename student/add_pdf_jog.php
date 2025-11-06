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
		//echo $id_talyp." ".$ders_id." ".$jogap." ".$bashlan_wagt." ".$gutaran_wagt." ".$sene." ".$aralyk_jemleme;
		
		mysqli_query($con, "INSERT INTO bellenen_jogap_pdf (talyp_id, ders_id, bellenen_jogap, bashlan_wagty, gutaran_wagty, sene, ip, aralyk_jemleme) VALUES 
			('$id_talyp', '$ders_id', '$jogap', '$bashlan_wagt', '$gutaran_wagt', '$sene', '','$aralyk_jemleme')
			");
		//header('location: exams.php');
	}

?>