<?php  
 //fetch.php  
 include '../dbconnection.php';
 include '../admin/functions.php';

 if(isset($_POST["id"]))  
 {  
      $query = "SELECT testler.id, testler.sorag, testler.jogap1, testler.jogap2, testler.jogap3, testler.jogap4 FROM testler WHERE id='".$_POST["id"]."'";  
      $result = mysqli_query($con, $query);  
      $row = mysqli_fetch_array($result);
      $row['sorag']=deshifr_kichi($row['sorag']);
      $row['jogap1']=deshifr_kichi($row['jogap1']);
      $row['jogap2']=deshifr_kichi($row['jogap2']);
      $row['jogap3']=deshifr_kichi($row['jogap3']);
      $row['jogap4']=deshifr_kichi($row['jogap4']);

      echo json_encode($row);  
 }  
 ?>