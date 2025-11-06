<?php
	if (isset($_POST['jogap_achar_taz'])){
		$sorag_sany=$_POST['ss'];
		$ders_id=$_POST['ders_id'];
		$aralyk_jemleme=$_POST['aj'];

		$jogap_achar="";

		for ($i=1; $i <= $sorag_sany; $i++) { 
			$jogap_achar.=$_POST['jogap'.($i)];
		}

		include_once '../dbconnection.php';
		include '../admin/functions.php';
		$jogap_achar=shifr_kichi($jogap_achar);

		$query=mysqli_query($con, "UPDATE testler_pdf SET jogap='$jogap_achar', yuklenen_wagty=now() WHERE ders_id='$ders_id' AND aralyk_jemleme='$aralyk_jemleme'");

	}
	sleep(1);
	
	header('location: test_setting.php');
?>