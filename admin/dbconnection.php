<?php
	$ip = $_SERVER['REMOTE_ADDR'];
	$mac=shell_exec("arp -a ".$ip);
	$mac_string = shell_exec("arp -a $ip");
	$mac_array = explode("\n",$mac_string);
	$string = $mac_array[3];
	$spos=strpos($string, "-");
	$mac=substr($string, $spos-2, 17);
	// if(($ip=='192.168.125.125') || ($mac=='f4-30-b9-a0-cd-f2')){
	// 	$con=mysqli_connect("localhost", "root", "root2021", "portal");
	// 	if(mysqli_connect_errno()){
	// 		echo "Connection Fail".mysqli_connect_error();
	// 	}
	// }	
?>
