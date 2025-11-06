<?php    
    include '../dbconnection.php';
	  session_start();
    $test=$_POST['test'];
    $gor=$_POST['gor'];
    $radio1=$_POST['radio1'];
    if ($radio1=='tekst') $mag=$_POST['tekst'];
    if ($radio1=='fayl') {
      if (isset($_FILES['fayl']) && $_FILES['fayl']['error'] === UPLOAD_ERR_OK){
            // get details of the uploaded file
            $fileTmpPath = $_FILES['fayl']['tmp_name'];
            $fileName = $_FILES['fayl']['name'];
            $fileSize = $_FILES['fayl']['size'];
            $fileType = $_FILES['fayl']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // sanitize file-name
            $newFileName = md5($test."_".$gor).".".$fileExtension;

            $mag="<img class=\"img-fluid pad\" src=\"../test-surat/".$newFileName."\">";

            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

            if (in_array($fileExtension, $allowedfileExtensions)){
              // directory in which the uploaded file will be moved
              $uploadFileDir = '../test-surat/';
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
            $message .= 'Error:' . $_FILES['fayl']['error'];
        }
    }
    $query1=mysqli_query($con, "UPDATE synag_test_jogap SET $gor='$mag' WHERE id=$test");
    $query=mysqli_query($con, "SELECT $gor FROM synag_test_jogap WHERE id=$test");
    $row=mysqli_fetch_array($query);
    $tekst=$row[$gor];
    if ($gor=="sorag"){
      $tekst="<b>".$row[$gor]."</b>";
    }    
    echo json_encode($tekst);
?>