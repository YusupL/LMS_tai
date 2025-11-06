<?php
	include "dbcon.php";
	$query=mysqli_query($con, "SELECT * FROM hunarler");

	while ($row=mysqli_fetch_array($query)) {
		$hunar=$row['id'];
		
		if (($hunar!=11)&&($hunar!=17)&&($hunar!=5)&&($hunar!=6)&&($hunar!=16))
			{mysqli_query($con, "INSERT INTO toparchalar (hunar, yyl, toparcha) VALUES
									('$hunar', '5', '1')
		");

		mysqli_query($con, "INSERT INTO toparchalar (hunar, yyl, toparcha) VALUES
									('$hunar', '5', '2')
		");}
		//echo $hunar."\n";
	}
?>