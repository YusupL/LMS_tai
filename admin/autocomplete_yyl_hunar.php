<?php 
    include "dbcon.php";
    $id=$_POST['id'];

    $hunar=mysqli_query($con, "SELECT toparchalar.id AS toparcha_id, hunarler.gysga_ady AS hunar_gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM toparchalar, hunarler WHERE hunarler.id=toparchalar.hunar AND toparchalar.yyl='$id'");
    while($row_hunar=mysqli_fetch_array($hunar)){?>
    <option value="<?=$row_hunar['toparcha_id']?>"><?php echo $row_hunar['hunar_gysga_ady']." ".$row_hunar['yyl']."0".$row_hunar['toparcha']; ?></option>
    <?php
    }
?>