<?php
$message=''; 
	if (isset($_POST['knop'])){
		
		    if (isset($_FILES['pdffile']) && $_FILES['pdffile']['error'] === UPLOAD_ERR_OK)
	      	{        
		        
		        // sanitize file-name
		        
		        	$fileTmpPath = $_FILES['pdffile']['tmp_name'];
			        $fileName = $_FILES['pdffile']['name'];		        
			        $fileNameCmps = explode(".", $fileName);
		        	$fileExtension = strtolower(end($fileNameCmps)); 
		        	$newFileName = '10.'.$fileExtension;
		        	// check if file has one of the following extensions
		        	$allowedfileExtensions = array('pdf');
		        	if (in_array($fileExtension, $allowedfileExtensions))
		        	{
		          // directory in which the uploaded file will be moved
						$uploadFileDir = 'pdfler/';
						$dest_path = $uploadFileDir . $newFileName;

						if(move_uploaded_file($fileTmpPath, $dest_path)) 
		          		{
		            		$message ='File is successfully uploaded.';
		          		}
		          		else 
		          		{
		            		$message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
		          		}
	        		}
		        	else
			        {
			          $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
			        }
		        }
	      	else
			{
				$message = 'There is some error in the file upload. Please check the following error.<br>';
				$message .= 'Error:' . $_FILES['pdffile']['error'];
			}

			$file = $dest_path = $uploadFileDir . $newFileName;
			$newfile = 'pdfler/11.pdf';

			if (!copy($file, $newfile)) {
			    echo "не удалось скопировать $file...\n";
			}
    	
	}
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Pdf-test</title>
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		<input type='file' name='pdffile'>
		<button type="submit" name="knop">Bass</button>
	</form>
	<p><?php echo $message; ?></p>
</body>
</html> 