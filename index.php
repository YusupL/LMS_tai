<?php

date_default_timezone_set("Asia/Ashgabat"); 
session_start();
error_reporting(0);
include('dbconnection.php');
include('admin/functions.php');
if(isset($_POST['logn']))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$mac=GetMac();
		$login=$_POST['lognam'];
		$pass=shifr($_POST['pass']);
		$gwagt=date("H:i:s");
		$query=mysqli_query($con, "SELECT * FROM ulanyjylar WHERE login='$login' AND parol='$pass'");
		mysqli_query($con, "UPDATE ulanyjylar SET isonline=1, ip='$ip', mac='$mac', gwagt='$gwagt' WHERE login='$login' AND parol='$pass'");
		$ret=mysqli_fetch_array($query);
		if($ret>0){
			$_SESSION['id']=$ret['id'];
			$id_ulanyjy=$_SESSION['id'];

			//updated code DDashkynov
			$_SESSION['ulanyjy_tipi']=$ret['ulanyjy_tipi']; //student or teacher
			//bir wagty iki kisi login etmez yaly
			$session_token=bin2hex(random_bytes(32));
			$_SESSION['session_token']=$session_token;
			mysqli_query($con,"UPDATE ulanyjylar SET session_token='$session_token' WHERE id='$id_ulanyjy'");

			//user_girishe maglumat goshmak uchin
			$wagt=date('Y-m-d H:i:s');
			mysqli_query($con, "INSERT INTO user_girish (id_ulanyjy, wagt) VALUES ('$id_ulanyjy', '$wagt')");
			//

			if($ret['ulanyjy_tipi']=='1'){
				//Sessiya aralyk jemleme barada maglumat yazmak
				$query_talyp=mysqli_query($con, "SELECT id FROM talyplar WHERE ulanyjy_id='$id_ulanyjy'");
			    while ($row_talyp=mysqli_fetch_array($query_talyp)) {
			        $id_talyp=$row_talyp['id'];
			    }
			    $_SESSION['id_talyp']=$id_talyp;

			    $query_gornush=mysqli_query($con, "SELECT hunarler.gornushi FROM hunarler WHERE id IN (SELECT toparchalar.hunar FROM toparchalar WHERE toparchalar.id IN (SELECT talyplar.toparcha FROM talyplar WHERE talyplar.ulanyjy_id='$id_ulanyjy'))");
			    while ($row_gornush=mysqli_fetch_array($query_gornush)) {
			        $gornush=$row_gornush['gornushi'];
			    }

			    $query=mysqli_query($con, "SELECT * FROM synag_tapgyr WHERE gornush='$gornush'");
			    while ($row=mysqli_fetch_array($query)){
			        $yy=$row['yarymyyllyk'];
			        $aj=$row['aralyk_jemleme'];
			        $ss=$row['sorag_sany'];
			    }
			    $_SESSION['yy']=$yy;
			    $_SESSION['aj']=$aj;
			    $_SESSION['ss']=$ss;

				//header('location:student/main_page.php');
				header('location:student1/');
			}
			else if($ret['ulanyjy_tipi']=='2'){
				header('location:teacher1/');
			}
			else if($ret['ulanyjy_tipi']=='3'){
				header('location:obolum/');
			}
			else if($ret['ulanyjy_tipi']=='4'){
				header('location:admin/users.php');
			}
			else {
				$msg="Girizilen maglumatlar ýalňyş!";
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ulgama giriş</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST">
					<span class="login100-form-title">
						Ulgama girmek
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Ulanyjynyň adyny giriziň!">
						<input class="input100" type="text" name="lognam" placeholder="Ulanyjynyň ady">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Açar sözi giriziň!">						
						<input class="input100" type="password" name="pass" id="pass" placeholder="Açar söz">	
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>					
						<span class="focus-input100"></span>						
						
					</div>
					
					<div class="container-login100-form-btn p-t-13 p-b-50">
						<button type="submit" class="login100-form-btn" name="logn">
							Ulgama girmek
						</button>
					</div>					
				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
<!--===============================================================================================-->
</body>
</html>