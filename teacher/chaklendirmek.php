<?php
	include "../dbconnection.php";

	if (isset($_POST['talyp_id'])){
		$talyp_id=$_POST['talyp_id'];
		$ders_id=$_POST['ders_id'];
		$aj=$_POST['aj'];
		

		$query=mysqli_query($con, "SELECT * FROM chaklendirme WHERE talyp_id='$talyp_id' AND ders_id='$ders_id' AND aralyk_jemleme='$aj'");
		$row_num=mysqli_num_rows($query);

		if ($row_num>0){
			$query=mysqli_query($con, "DELETE FROM chaklendirme WHERE talyp_id='$talyp_id' AND ders_id='$ders_id' AND aralyk_jemleme='$aj'");
		} 
		else 
			if ($row_num==0) {
			$query=mysqli_query($con, "INSERT INTO chaklendirme (talyp_id, ders_id, aralyk_jemleme) VALUES 
			('$talyp_id', '$ders_id', '$aj')");
		}
	}

?>