<?php  
 //fetch.php  
 include "dbcon.php";

 if(isset($_POST["id"]))  
 {  
      $query = "SELECT ders_maglumat.id AS id, ders_maglumat.ders_id AS ders_ady_id, ders_maglumat.gornushi AS ders_gornushi, ders_maglumat.mug_id AS mug_faa, hunarler.gysga_ady AS hunar_ady, toparchalar.yyl AS yyl, toparchalar.toparcha AS toparcha, ders_maglumat.sagat_sany AS sagat_sany, ara_syn_deg AS arjem, synag_degish AS synagd FROM hunarler, toparchalar, mugallymlar, ders_maglumat, ders_atlary, ders_gornushi WHERE hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND mugallymlar.id=ders_maglumat.mug_id AND ders_maglumat.gornushi=ders_gornushi.id AND ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.id='".$_POST["id"]."'";  
      $result = mysqli_query($con, $query);  
      $row = mysqli_fetch_array($result);
      echo json_encode($row);  
 }  
 ?>