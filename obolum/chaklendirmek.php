<?php
	include "../dbconnection.php";

	if (isset($_POST['talyp_id'])){
		$talyp_id=$_POST['talyp_id'];
		$aj=$_POST['aj'];
		$toparcha=$_POST['toparcha'];
		$dsql=mysqli_query($con,"SELECT ders_maglumat.id AS id FROM ders_maglumat, ders_atlary, ders_potok WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.ara_syn_deg='1' AND ders_potok.toparcha_id='$toparcha' AND ders_potok.ders_maglumat_id=ders_maglumat.id");
		
		$query=mysqli_query($con, "SELECT * FROM chaklendirme WHERE talyp_id=$talyp_id AND aralyk_jemleme=$aj");
		$row_num=mysqli_num_rows($query);
echo "salam";
		if ($row_num>0){
			$query=mysqli_query($con, "DELETE FROM chaklendirme WHERE talyp_id='$talyp_id' AND aralyk_jemleme='$aj'");
		} 
		else if ($row_num==0) {
			
			while($rders=mysqli_fetch_array($dsql)){
			$dersler=$rders['id'];
			$query=mysqli_query($con, "INSERT INTO chaklendirme (talyp_id, ders_id, aralyk_jemleme) VALUES 
			('$talyp_id', '$dersler', '$aj')");
			}
		}
	}
?>