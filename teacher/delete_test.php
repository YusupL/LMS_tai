<?php
	include "../dbconnection.php";

	$id = 0;
	if(isset($_POST['id'])){
	   $id = mysqli_real_escape_string($con,$_POST['id']);
	}
	if($id > 0){

	  $checkRecord = mysqli_query($con,"SELECT * FROM testler WHERE id=".$id);
	  $totalrows = mysqli_num_rows($checkRecord);

	  if($totalrows > 0){
	    // Delete record
	    $query = "DELETE FROM testler_degishlilik WHERE test_id=".$id;
	    mysqli_query($con,$query);

	    $query = "DELETE FROM testler WHERE id=".$id;
	    mysqli_query($con,$query);
	    echo 1;
	    exit;
	  }else{
	    echo 0;
	    exit;
	  }
	}

	echo 0;
	exit;

?>