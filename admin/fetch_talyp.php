<?php  
 //fetch.php  
 include "dbcon.php";
 include 'functions.php';

 if(isset($_POST["id"]))  
 {  
      $query = "SELECT ulanyjylar.id AS id, talyplar.ady AS ady, talyplar.familiyasy AS familiyasy, talyplar.atasynyn_ady AS atasynyn_ady, hunarler.gysga_ady AS hunar, toparchalar.yyl AS yyl, toparchalar.toparcha AS toparcha, ulanyjylar.login AS login, ulanyjylar.parol AS parol FROM talyplar, hunarler, toparchalar, ulanyjylar WHERE ulanyjylar.id=talyplar.ulanyjy_id AND talyplar.toparcha=toparchalar.id AND toparchalar.hunar=hunarler.id AND ulanyjylar.id='".$_POST["id"]."'";  
      $result = mysqli_query($con, $query);  
      $row = mysqli_fetch_array($result);      
      $row['parol']=deshifr($row['parol']);
      echo json_encode($row);  
 }  
 ?>