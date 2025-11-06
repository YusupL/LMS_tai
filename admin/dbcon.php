<?php	
	$ip = $_SERVER['REMOTE_ADDR'];
	$mac=shell_exec("arp -a ".$ip);
	$mac_string = shell_exec("arp -a $ip");
	$mac_array = explode("\n",$mac_string);
	$string = $mac_array[3];
	$spos=strpos($string, "-");
	$mac=substr($string, $spos-2, 17);
	if($mac=='00-e0-4f-1d-3a-1f') {
		$con=mysqli_connect("127.0.0.1", "root", "", "portal");
		if(mysqli_connect_errno()){
			echo "Connection Fail".mysqli_connect_error();
		}
	 } else {
	 	header("location: ../index.php");
	 }
?>

