<?php
	if (isset($_POST['sub'])){
		include "../dbconnection.php";

		$sorag_tb=$_POST['sorag_tb'];
		$id_test=$_POST['id_test'];

		$radio1=$_POST['radio1'];
		$radio2=$_POST['radio2'];
		$radio3=$_POST['radio3'];
		$radio4=$_POST['radio4'];
		$radio5=$_POST['radio5'];


		//soragy yuklemek
		if ($radio1=='stekst') $sorag=$_POST['stekst'];
		if ($radio1=='sfayl') {
			if (isset($_FILES['sfayl']) && $_FILES['sfayl']['error'] === UPLOAD_ERR_OK){
		        // get details of the uploaded file
		        $fileTmpPath = $_FILES['sfayl']['tmp_name'];
		        $fileName = $_FILES['sfayl']['name'];
		        $fileSize = $_FILES['sfayl']['size'];
		        $fileType = $_FILES['sfayl']['type'];
		        $fileNameCmps = explode(".", $fileName);
		        $fileExtension = strtolower(end($fileNameCmps));

		        // sanitize file-name
		        $newFileName = $id_test."_".$sorag_tb.'_sorag.'.$fileExtension;

		        $sorag="<img src=\"test-surat/".$newFileName."\">";

		        // check if file has one of the following extensions
		        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

		        if (in_array($fileExtension, $allowedfileExtensions)){
		          // directory in which the uploaded file will be moved
		          $uploadFileDir = 'test-surat/';
		          $dest_path = $uploadFileDir . $newFileName;

		          if(move_uploaded_file($fileTmpPath, $dest_path)){
		            $message ='File is successfully uploaded.';
		          }
		          else{
		            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		          }
		        }
		        else{
		          $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
		        }
		    }
	      	else{
				$message = 'There is some error in the file upload. Please check the following error.<br>';
		        $message .= 'Error:' . $_FILES['sfayl']['error'];
		    }
		}

		//dogry jogap yuklemek
		if ($radio2=='djt') $dj=$_POST['djt'];
		if ($radio2=='djf') {
			if (isset($_FILES['djf']) && $_FILES['djf']['error'] === UPLOAD_ERR_OK){
		        // get details of the uploaded file
		        $fileTmpPath = $_FILES['djf']['tmp_name'];
		        $fileName = $_FILES['djf']['name'];
		        $fileSize = $_FILES['djf']['size'];
		        $fileType = $_FILES['djf']['type'];
		        $fileNameCmps = explode(".", $fileName);
		        $fileExtension = strtolower(end($fileNameCmps));

		        // sanitize file-name
		        $newFileName = $id_test."_".$sorag_tb.'_dj.'.$fileExtension;

		        $dj="<img src=\"test-surat/".$newFileName."\">";

		        // check if file has one of the following extensions
		        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

		        if (in_array($fileExtension, $allowedfileExtensions)){
		          // directory in which the uploaded file will be moved
		          $uploadFileDir = 'test-surat/';
		          $dest_path = $uploadFileDir . $newFileName;

		          if(move_uploaded_file($fileTmpPath, $dest_path)){
		            $message ='File is successfully uploaded.';
		          }
		          else{
		            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		          }
		        }
		        else{
		          $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
		        }
		    }
	      	else{
				$message = 'There is some error in the file upload. Please check the following error.<br>';
		        $message .= 'Error:' . $_FILES['djf']['error'];
		    }
		}

		//yalnsyh jogap1 yuklemek
		if ($radio3=='yj1t') $yj1=$_POST['yj1t'];
		if ($radio3=='yj1f') {
			if (isset($_FILES['yj1f']) && $_FILES['yj1f']['error'] === UPLOAD_ERR_OK){
		        // get details of the uploaded file
		        $fileTmpPath = $_FILES['yj1f']['tmp_name'];
		        $fileName = $_FILES['yj1f']['name'];
		        $fileSize = $_FILES['yj1f']['size'];
		        $fileType = $_FILES['yj1f']['type'];
		        $fileNameCmps = explode(".", $fileName);
		        $fileExtension = strtolower(end($fileNameCmps));

		        // sanitize file-name
		        $newFileName = $id_test."_".$sorag_tb.'_yj1.'.$fileExtension;

		        $yj1="<img src=\"test-surat/".$newFileName."\">";

		        // check if file has one of the following extensions
		        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

		        if (in_array($fileExtension, $allowedfileExtensions)){
		          // directory in which the uploaded file will be moved
		          $uploadFileDir = 'test-surat/';
		          $dest_path = $uploadFileDir . $newFileName;

		          if(move_uploaded_file($fileTmpPath, $dest_path)){
		            $message ='File is successfully uploaded.';
		          }
		          else{
		            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		          }
		        }
		        else{
		          $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
		        }
		    }
	      	else{
				$message = 'There is some error in the file upload. Please check the following error.<br>';
		        $message .= 'Error:' . $_FILES['yj1f']['error'];
		    }
		}

		//yalnsyh jogap2 yuklemek
		if ($radio4=='yj2t') $yj2=$_POST['yj2t'];
		if ($radio4=='yj2f') {
			if (isset($_FILES['yj2f']) && $_FILES['yj2f']['error'] === UPLOAD_ERR_OK){
		        // get details of the uploaded file
		        $fileTmpPath = $_FILES['yj2f']['tmp_name'];
		        $fileName = $_FILES['yj2f']['name'];
		        $fileSize = $_FILES['yj2f']['size'];
		        $fileType = $_FILES['yj2f']['type'];
		        $fileNameCmps = explode(".", $fileName);
		        $fileExtension = strtolower(end($fileNameCmps));

		        // sanitize file-name
		        $newFileName = $id_test."_".$sorag_tb.'_yj2.'.$fileExtension;

		        $yj2="<img src=\"test-surat/".$newFileName."\">";

		        // check if file has one of the following extensions
		        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

		        if (in_array($fileExtension, $allowedfileExtensions)){
		          // directory in which the uploaded file will be moved
		          $uploadFileDir = 'test-surat/';
		          $dest_path = $uploadFileDir . $newFileName;

		          if(move_uploaded_file($fileTmpPath, $dest_path)){
		            $message ='File is successfully uploaded.';
		          }
		          else{
		            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		          }
		        }
		        else{
		          $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
		        }
		    }
	      	else{
				$message = 'There is some error in the file upload. Please check the following error.<br>';
		        $message .= 'Error:' . $_FILES['yj2f']['error'];
		    }
		}

		//yalnsyh jogap3 yuklemek
		if ($radio5=='yj3t') $yj3=$_POST['yj3t'];
		if ($radio5=='yj3f') {
			if (isset($_FILES['yj3f']) && $_FILES['yj3f']['error'] === UPLOAD_ERR_OK){
		        // get details of the uploaded file
		        $fileTmpPath = $_FILES['yj3f']['tmp_name'];
		        $fileName = $_FILES['yj3f']['name'];
		        $fileSize = $_FILES['yj3f']['size'];
		        $fileType = $_FILES['yj3f']['type'];
		        $fileNameCmps = explode(".", $fileName);
		        $fileExtension = strtolower(end($fileNameCmps));

		        // sanitize file-name
		        $newFileName = $id_test."_".$sorag_tb.'_yj3.'.$fileExtension;

		        $yj3="<img src=\"test-surat/".$newFileName."\">";

		        // check if file has one of the following extensions
		        $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

		        if (in_array($fileExtension, $allowedfileExtensions)){
		          // directory in which the uploaded file will be moved
		          $uploadFileDir = 'test-surat/';
		          $dest_path = $uploadFileDir . $newFileName;

		          if(move_uploaded_file($fileTmpPath, $dest_path)){
		            $message ='File is successfully uploaded.';
		          }
		          else{
		            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		          }
		        }
		        else{
		          $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
		        }
		    }
	      	else{
				$message = 'There is some error in the file upload. Please check the following error.<br>';
		        $message .= 'Error:' . $_FILES['yj3f']['error'];
		    }
		}

		//echo $sorag." ".$dj." ".$yj1." ".$yj2." ".$yj3." ";

		//mysqli_query($con, "INSERT INTO synag_test_jogap (id_test, sorag_tb, sorag, jogap1, jogap2, jogap3, jogap4) VALUES ('$id_test', '$sorag_tb', '$sorag', '$dj', '$yj1', '$yj2','$yj3') ");
		header("location: general.php");

	}
?>