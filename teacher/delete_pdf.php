<?php
	$id = $_POST['id'];
	
	if (!unlink($id)) {
		echo 0;
		exit;
	} else {
		echo 1;
		exit;
	}
	sleep(2);
?>