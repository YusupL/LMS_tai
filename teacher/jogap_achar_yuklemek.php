<?php
	include '../admin/functions.php';
	if (isset($_POST['sub_a'])){
		$sorag_sany=$_POST['sorag_sany'];
		$id_dersler=$_POST['id_dersler'];
		$count_id_d=count($id_dersler);

		$jogap_achar="";

		for ($i=0; $i < $sorag_sany; $i++) { 
			$jogap_achar.=$_POST['jogap'.($i+1)];
		}
		$jogap_achar=shifr_kichi($jogap_achar);

		$aralyk_jemleme=$_POST['aralyk_jemleme'];

		include_once '../dbconnection.php';

		for ($i=0; $i<$count_id_d; $i++){
			$id_ders=$id_dersler[$i];

			$query_is_jogap=mysqli_query($con, "SELECT * FROM testler_pdf WHERE ders_id='$id_ders' AND aralyk_jemleme='$aralyk_jemleme'");
			$totalrows = mysqli_num_rows($query_is_jogap);
			if ($totalrows>0){
				$query=mysqli_query($con, "UPDATE testler_pdf SET jogap='$jogap_achar', yuklenen_wagty=now() WHERE ders_id='$id_ders' AND aralyk_jemleme='$aralyk_jemleme'");
			} else {
				$query=mysqli_query($con, "INSERT INTO testler_pdf (ders_id, jogap, aralyk_jemleme, yuklenen_wagty) VALUES
										('$id_ders', '$jogap_achar', '$aralyk_jemleme', now())
				");
			}
		}

	}
	header('location: up_test.php');
?>