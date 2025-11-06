<?php  
 //fetch.php  
 include "dbcon.php";
 include 'functions.php';

 if(isset($_POST["id"]))  
 {  
      $query = "SELECT ulanyjylar.id AS id, mugallymlar.ady AS ady, mugallymlar.familiyasy AS familiyasy, mugallymlar.atasynyn_ady AS atasynyn_ady, ulanyjylar.login AS login, ulanyjylar.parol AS parol, kafedralar.ady AS kafedra, kafedralar.id AS id_kafedra FROM mugallymlar, kafedralar, ulanyjylar WHERE ulanyjylar.id=mugallymlar.ulanyjy_id AND mugallymlar.kafedra=kafedralar.id AND ulanyjylar.id='".$_POST["id"]."'";  
      $result = mysqli_query($con, $query);  
      $row = mysqli_fetch_array($result);
      $row['parol']=deshifr($row['parol']);
      echo json_encode($row);  
 }  
 ?>