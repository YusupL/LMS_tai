<?php 
    include "dbcon.php";
    $jubut=""; $gun=""; $toparcha_reje=""; $sm="";
    $jubut=$_POST['jubut'];
    $gun=$_POST['gun'];
    $toparcha_reje=$_POST['toparcha_reje'];
    $sm=$_POST['sm'];
    if ($sm=='true') $sm=1; else $sm=0;
    
    $query=mysqli_query($con, "SELECT * FROM otaglar");

    $query_otag=mysqli_query($con, "SELECT umumy_reje.otag AS otag FROM ders_atlary, ders_maglumat, ders_potok, umumy_reje WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_potok.ders_maglumat_id=ders_maglumat.id AND umumy_reje.ders_id=ders_maglumat.id AND ders_potok.toparcha_id='$toparcha_reje' AND umumy_reje.gun='$gun' AND umumy_reje.jubut='$jubut' AND umumy_reje.s_m='$sm'");
    $row_otag=mysqli_fetch_array($query_otag);
    $otag=$row_otag['otag'];
    ?>
    <option value="0">...</option>
    <?php
    while($row=mysqli_fetch_array($query)){
        if ($otag==$row['id']){
        ?>
        <option selected="selected" value="<?=$row['id']?>"> <?php echo $row['nomer']; ?></option>
        <?php
        } else {?>
        <option value="<?=$row['id']?>"> <?php echo $row['nomer']; ?></option>
        <?php
        }
    }    
?>