<?php
	$id_toparcha=$_POST['toparcha'];
	include "dbcon.php";

	if (isset($_POST['sub'.$id_toparcha])){
		$id_toparcha=substr($id_toparcha, 0, strlen($id_toparcha)-1);
		$ders_idler=$_POST['ders_idler'];

		$idler=explode("-", $ders_idler);

		for ($i=0; $i<count($idler)-1; $i++){
			$ballar[$i]=$_POST['bal'.$idler[$i]];

			$query=mysqli_query($con, "SELECT count(*) FROM bal_kes WHERE ders_id='$idler[$i]'");
			while ($row=mysqli_fetch_array($query)){
				if ($row[0]==0){
					mysqli_query($con, "INSERT INTO bal_kes (ders_id, baly) VALUES
							('$idler[$i]', '$ballar[$i]')
					");
				}
				mysqli_query($con, "UPDATE bal_kes SET baly='$ballar[$i]' WHERE ders_id='$idler[$i]'
					");
			}
		}
	}
	header("location: bal_kes.php");
?>