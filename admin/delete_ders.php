<?php
	include "dbcon.php";

	$id = 0;
	if(isset($_POST['id'])){
	   $id = mysqli_real_escape_string($con,$_POST['id']);
	}
	if($id > 0){

	  $checkRecord = mysqli_query($con,"SELECT * FROM ders_maglumat WHERE id=".$id);
	  $totalrows = mysqli_num_rows($checkRecord);

	  if($totalrows > 0){
		$qdp=mysqli_query($con, "DELETE FROM ders_potok WHERE ders_maglumat_id='$id'");
		if($qdp){
			$query = "DELETE FROM ders_maglumat WHERE id=".$id;
			mysqli_query($con,$query);			
			echo 1;
		}
	    exit;
	  }else{
	    echo 0;
	    exit;
	  }
	}

	echo 0;
	exit;

?>