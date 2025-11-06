<?php 
    include "dbcon.php";
    $fak_reje=$_POST['fak_reje'];
    $yyl_reje=$_POST['yyl_reje'];

    $hunar=mysqli_query($con, "SELECT toparchalar.id AS toparcha_id, hunarler.gysga_ady AS hunar_gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar WHERE toparchalar.hunar=hunarler.id AND toparchalar.yyl='$yyl_reje' AND hunarler.fakultet='$fak_reje' ORDER BY toparchalar.id");
    while($row_hunar=mysqli_fetch_array($hunar)){?>
    <option value="<?=$row_hunar['toparcha_id']?>"><?php echo $row_hunar['hunar_gysga_ady']." ".$row_hunar['yyl']."0".$row_hunar['toparcha']; ?></option>
    <?php
    }
?>