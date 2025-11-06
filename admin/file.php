<?php 
    include '../dbcon.php';
    if (isset($_POST['sub'])){
        $tit=$_POST['titl'];
        $text=$_POST['txt'];    
        $sene=$_POST['sene'];
                
        $query=mysqli_query($con, "INSERT INTO news (ntitle, ntext,  ndate) VALUES ('$tit', '$text',  '$sene')");

        $id=mysqli_insert_id($con);

        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK){
            // get details of the uploaded file
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
    
            // sanitize file-name
            $newFileName = "img_".$id.".".$fileExtension;
    
            
    
            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg');
    
            if (in_array($fileExtension, $allowedfileExtensions)){
              // directory in which the uploaded file will be moved
              $uploadFileDir = '../assets/images/blog/';
              $dest_path = $uploadFileDir . $newFileName;
    
              if(move_uploaded_file($fileTmpPath, $dest_path)){
                $message = 'Papka yerleshdirildi <br>';
              }
              else{
                $message = 'Papka yerleshdirilmedi <br>';
              }
            }            
        }
        else{
            $message = 'Yalnyshlyk<br>';
            $message .= 'Error:' . $_FILES['file']['error'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Täzelik</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <label for="tm">Türkmen dili</label>
        <div id="tm">
            <textarea name="titl" id="titl" cols="30" rows="10"></textarea>
            <textarea name="txt" id="txt" cols="30" rows="10"></textarea>
        </div>
        
        
        <label for="sesu">Sene we suratyny ýüklemek</label>
        <div>
            <input type="date" name="sene" id="sene">
            <input type="file" name="file" id="file" accept=".jpg">
        </div>
        <input type="submit" name="sub">
    </form>
</body>
</html>