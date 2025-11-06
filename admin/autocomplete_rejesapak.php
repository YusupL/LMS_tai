<?php 
    include "dbcon.php";
    $jubut=""; $gun=""; $toparcha_reje=""; $sm="";
    $jubut=$_POST['jubut'];
    $gun=$_POST['gun'];
    $toparcha_reje=$_POST['toparcha_reje'];
    $sm=$_POST['sm'];
    if ($sm=='true') $sm=1; else $sm=0;
    
    $query=mysqli_query($con, "SELECT ders_maglumat.id AS ders_magl_id, ders_atlary.ady AS ders_ady, ders_gornushi.ady AS ders_gor_ady, mugallymlar.familiyasy, mugallymlar.ady FROM mugallymlar, ders_potok, ders_atlary, ders_maglumat, ders_gornushi WHERE mugallymlar.id=ders_maglumat.mug_id AND ders_gornushi.id=ders_maglumat.gornushi AND ders_atlary.id=ders_maglumat.ders_id AND ders_maglumat.id=ders_potok.ders_maglumat_id AND ders_potok.toparcha_id='$toparcha_reje'");

    $query_r=mysqli_query($con, "SELECT ders_maglumat.id AS ders_magl_id FROM ders_atlary, ders_maglumat, ders_potok, umumy_reje WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_potok.ders_maglumat_id=ders_maglumat.id AND umumy_reje.ders_id=ders_maglumat.id AND ders_potok.toparcha_id='$toparcha_reje' AND umumy_reje.gun='$gun' AND umumy_reje.jubut='$jubut' AND umumy_reje.s_m='$sm'");
    $row_r=mysqli_fetch_array($query_r);
    $ders_magl_id=$row_r['ders_magl_id'];

    ?>
    <option value="0">...</option>
    <?php
    while($row=mysqli_fetch_array($query)){
        if ($ders_magl_id==$row['ders_magl_id']){
        ?>
        <option selected="selected" value="<?=$row['ders_magl_id']?>"> <?php echo $row['ders_ady']." (".$row['ders_gor_ady'].") ".$row['familiyasy']." ".$row['ady']; ?></option>
        <?php
        } else {?>
        <option value="<?=$row['ders_magl_id']?>"> <?php echo $row['ders_ady']." (".$row['ders_gor_ady'].") ".$row['familiyasy']." ".$row['ady']; ?></option>
        <?php
        }
    }    
?>