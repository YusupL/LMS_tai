<?php
    session_start();
    $ulanyjy_id=$_SESSION['id'];
    include '../dbconnection.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Baş sahypa</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


  
    <link href="assets/css/main.css" rel="stylesheet" />


     <!--     Fonts and icons     -->
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">
    
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
       
        <?php include 'navbar.php' ?>

        <div class="content">
            <div class="col-md-12">
                <div class="card">
                    <?php
                        $query=mysqli_query($con, "SELECT ders_maglumat.id AS ders_id, hunarler.id AS hunar_id, hunarler.gysga_ady, hunarler.gornushi as talyp_gornush, toparchalar.id, toparchalar.yyl, toparchalar.toparcha, ders_atlary.ady AS ders_ady, ders_maglumat.gornushi, ders_maglumat.sagat_sany, mugallymlar.ady, mugallymlar.familiyasy, mugallymlar.atasynyn_ady, ders_gornushi.ady AS ders_gor_ady FROM hunarler, toparchalar, mugallymlar, ders_atlary, ders_maglumat, ulanyjylar, ders_gornushi WHERE toparchalar.hunar=hunarler.id AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.mug_id=mugallymlar.id and ders_maglumat.ders_id=ders_atlary.id AND mugallymlar.ulanyjy_id=ulanyjylar.id AND ders_maglumat.gornushi=ders_gornushi.id AND ulanyjylar.id='$ulanyjy_id' AND (hunarler.gornushi='2' OR hunarler.gornushi='3')");

                        while ($row=mysqli_fetch_array($query)) {
                            $toparcha=$row['toparcha'];
                            $hunar_id=$row['hunar_id'];

                            if ((($row['gornushi']=='1') ||($row['gornushi']=='4')) &&($row['toparcha']==1)){
                                ?> <div class="header">
                                        <div class="alert alert-success"><h3 class="title"><b> <?php echo $row['gysga_ady']." ".$row['yyl']."01-".$row['yyl']."02" ?> </b> toparçalarynyň <b> <?php echo $row['ders_ady'];?> </b> dersinden ballary </h3></div>
                                        <div class="top_table"> <?php echo $row['ders_gor_ady']; ?> </div>
                                            <table class="table_zhurnal">
                                                <thead>
                                                    <th>Familiýasy, ady</th>
                                                    <?php
                                                        $sagat_sany=$row['sagat_sany'];
                                                        for ($i=1; $i<=$sagat_sany/2; $i++){
                                                            echo "<th><div class='zhurnal_rotate'>".$i."-nji(y) sapak</div></th>";
                                                        }
                                                    ?>
                                                    <th>Jemi</th>
                                                    <?php if (($row['ders_ady']!="Bedenterbiýe")&&($row['gornushi']=='1'))  {?>
                                                        <th><div class='zhurnal_rotate'>Özbaşdak iş</div></th>
                                                    <?php } ?>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $gysga_ady=$row['gysga_ady'];
                                                        $yyl=$row['yyl'];
                                                        $query_talyplar=mysqli_query($con, "SELECT talyplar.id, talyplar.ady, talyplar.familiyasy, talyplar.atasynyn_ady FROM talyplar, hunarler, toparchalar WHERE hunarler.gysga_ady='$gysga_ady' AND toparchalar.yyl='$yyl' AND talyplar.toparcha=toparchalar.id AND hunarler.id=toparchalar.hunar");
                                                            
                                                            $ders_id=$row['ders_id'];
                                                            $query_baly=mysqli_query($con, "SELECT * FROM bal_kes WHERE ders_id='$ders_id'");
                                                            while ($row_baly=mysqli_fetch_array($query_baly)) {
                                                                $baly=$row_baly['baly'];
                                                            }
                                                            $her_bal=$baly/$sagat_sany*2;

                                                        while ($row_talyp=mysqli_fetch_array($query_talyplar)) {
                                                            $talyp_id=$row_talyp['id'];
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $row_talyp['familiyasy']." ".$row_talyp['ady'];?>
                                                                </td>
                                                                    <?php
                                                                        for ($i=1; $i<=$sagat_sany/2; $i++){ ?>
                                                                            <td>
                                                                                <select class="change_point" id="point-<?php echo $ders_id."-".$talyp_id."-".$i; ?>">
                                                                                    <?php
                                                                                        $baly=0;
                                                                                        $query_sany=mysqli_query($con, "SELECT * FROM hepde_bal WHERE hepde='$i' AND ders_id='$ders_id' AND talyp_id='$talyp_id'");
                                                                                        while ($row_sany=mysqli_fetch_array($query_sany)) {
                                                                                            $baly=$row_sany['bal'];
                                                                                        }
                                                                                    ?>
                                                                                    <?php for ($j=0; $j<=$her_bal; $j=$j+0.5) {?>
                                                                                        <option value="<?php echo $j; ?>" <?php if ($j==$baly) echo "selected"?> ><?php echo $j;?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </td> <?php
                                                                        }
                                                                    ?>
                                                                    <td>
                                                                    <?php
                                                                        $query_jem_hepde=mysqli_query($con, "SELECT SUM(bal) as jem_hepde FROM hepde_bal WHERE talyp_id='$talyp_id' and ders_id='$ders_id'");
                                                                        while ( $row_jem_hepde=mysqli_fetch_array($query_jem_hepde)) {
                                                                            echo $row_jem_hepde['jem_hepde'];
                                                                        }
                                                                    ?>
                                                                    </td>
                                                                    <?php if (($row['ders_ady']!="Bedenterbiýe")&&($row['gornushi']=='1')){?>
                                                                    <td>
                                                                        <select class="change_point_ozbashdak" id="point-<?php echo $ders_id."-".$talyp_id ?>">
                                                                            <?php
                                                                                $ozbashdak_bal=0;
                                                                                $query_ozbashdak_bal=mysqli_query($con, "SELECT * FROM ozbashdak_bal WHERE talyp_id='$talyp_id' AND ders_id='$ders_id'");
                                                                                while ($row_ozbashdak_bal=mysqli_fetch_array($query_ozbashdak_bal)) {
                                                                                    $ozbashdak_bal=$row_ozbashdak_bal['bal'];
                                                                                }
                                                                                for ($j=$ozbashdak_bal; $j<=16; $j++){?>
                                                                                    <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                                                                <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                    <?php } ?>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                            <?php
                            } else if (($row['gornushi']=='2')||($row['gornushi'])=='3') {?>
                            <!--amaly we tejribe sapaklar uchin-->
                            <div class="header">
                                <div class="alert alert-success"><h3 class="title"><b> <?php echo $row['gysga_ady']." ".$row['yyl']."0".$toparcha; ?> </b> toparçasynyň <b> <?php echo $ders_ady=$row['ders_ady'];?> </b> dersinden ballary </h3></div>
                                        <div class="top_table"> <?php echo $row['ders_gor_ady']; ?> </div>
                                            <table class="table_zhurnal">
                                                <thead>
                                                    <th>Familiýasy, ady</th>
                                                    <?php
                                                        $sagat_sany=$row['sagat_sany'];
                                                        for ($i=1; $i<=$sagat_sany/2; $i++){
                                                            echo "<th><div class='zhurnal_rotate'>".$i."-nji(y) sapak</div></th>";
                                                        }
                                                    ?>
                                                    <?php
                                                        $query_umumy_bardygy=mysqli_query($con, "SELECT count(*) FROM ders_maglumat WHERE ders_id IN (SELECT id FROM ders_atlary WHERE ady='$ders_ady') AND gornushi='1'");
                                                        while ($row_umumy_bardygy=mysqli_fetch_array($query_umumy_bardygy)) {
                                                            $bardygy=$row_umumy_bardygy[0];
                                                        }?>
                                                        <th>
                                                            Jemi
                                                        </th>
                                                        <?php if ($bardygy==0){
                                                                ?>
                                                                <th><div class='zhurnal_rotate'>Özbaşdak iş</div></th>
                                                            <?php
                                                            }
                                                        ?>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $gysga_ady=$row['gysga_ady'];
                                                        $yyl=$row['yyl'];
                                                        $query_talyplar=mysqli_query($con, "SELECT talyplar.id, talyplar.ady, talyplar.familiyasy, talyplar.atasynyn_ady FROM talyplar, hunarler, toparchalar WHERE hunarler.gysga_ady='$gysga_ady' AND toparchalar.yyl='$yyl' AND toparchalar.toparcha='$toparcha' AND talyplar.toparcha=toparchalar.id AND hunarler.id=toparchalar.hunar");
                                                            
                                                            $ders_id=$row['ders_id'];
                                                            if ($toparcha=='2'){
                                                                $query_2=mysqli_query($con, "SELECT id FROM ders_maglumat WHERE ders_id IN(SELECT id FROM toparchalar WHERE hunar='$hunar_id' AND yyl='$yyl' AND toparcha='1')");
                                                                while ($row_2=mysqli_fetch_array($query_2)){
                                                                    $ders_id_bal_kes=$row_2['id'];
                                                                }
                                                            } else $ders_id_bal_kes=$ders_id;


                                                            $query_baly=mysqli_query($con, "SELECT * FROM bal_kes WHERE ders_id='$ders_id_bal_kes'");
                                                            while ($row_baly=mysqli_fetch_array($query_baly)) {
                                                                $baly=$row_baly['baly'];
                                                            }
                                                            $her_bal=$baly/$sagat_sany*2;

                                                        while ($row_talyp=mysqli_fetch_array($query_talyplar)) {
                                                            $talyp_id=$row_talyp['id'];
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $row_talyp['familiyasy']." ".$row_talyp['ady'];?>
                                                                </td>
                                                                    <?php
                                                                        for ($i=1; $i<=$sagat_sany/2; $i++){ ?>
                                                                            <td>
                                                                                <select class="change_point" id="point-<?php echo $ders_id."-".$talyp_id."-".$i; ?>">
                                                                                    <?php
                                                                                        $baly=0;
                                                                                        $query_sany=mysqli_query($con, "SELECT * FROM hepde_bal WHERE hepde='$i' AND ders_id='$ders_id' AND talyp_id='$talyp_id'");
                                                                                        while ($row_sany=mysqli_fetch_array($query_sany)) {
                                                                                            $baly=$row_sany['bal'];
                                                                                        }
                                                                                    ?>
                                                                                    <?php for ($j=0; $j<=$her_bal; $j=$j+0.5) {?>
                                                                                        <option value="<?php echo $j; ?>" <?php if ($j==$baly) echo "selected"?> ><?php echo $j;?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </td> <?php
                                                                        }
                                                                    ?>

                                                                    <td>
                                                                    <?php
                                                                        $query_jem_hepde=mysqli_query($con, "SELECT SUM(bal) as jem_hepde FROM hepde_bal WHERE talyp_id='$talyp_id' and ders_id='$ders_id'");
                                                                        while ( $row_jem_hepde=mysqli_fetch_array($query_jem_hepde)) {
                                                                            echo $row_jem_hepde['jem_hepde'];
                                                                        }
                                                                    ?>
                                                                    </td>
                                                                    <?php if ($bardygy==0){
                                                                            ?>
                                                                            <td>
                                                                                <select class="change_point_ozbashdak" id="point-<?php echo $ders_id."-".$talyp_id ?>">
                                                                                    <?php
                                                                                        $ozbashdak_bal=0;
                                                                                        $query_ozbashdak_bal=mysqli_query($con, "SELECT * FROM ozbashdak_bal WHERE talyp_id='$talyp_id' AND ders_id='$ders_id'");
                                                                                        while ($row_ozbashdak_bal=mysqli_fetch_array($query_ozbashdak_bal)) {
                                                                                            $ozbashdak_bal=$row_ozbashdak_bal['bal'];
                                                                                        }
                                                                                        for ($j=$ozbashdak_bal; $j<=16; $j++){?>
                                                                                            <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                                                                        <?php } ?>
                                                                                </select>
                                                                            </td>
                                                                        <?php
                                                                        }
                                                                    ?>
                                                            </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                        <?php 
                        }
                    }
                    ?>
                    <div class="content">
                        <div class="footer">
                            <div class="stats">
                                2020-2021-nji okuw ýyly I ýarymýyllyk
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

      <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change', '.change_point', function(){  
               var id = $(this).attr("id");
               var result=id.split('-');
               var ders_id=result[1];
               var talyp_id=result[2];
               var hepde=result[3];
               var bal=$(this).val();
               $.ajax({  
                    url:"add_point.php",  
                    method:"POST",  
                    data:{hepde:hepde, ders_id:ders_id, talyp_id:talyp_id, bal:bal},
                    dataType:"html",  
                    success:function(data){
                    }  
               });
               location.reload();
          });

        $(document).on('change', '.change_point_ozbashdak', function(){  
               var id = $(this).attr("id");
               var result=id.split('-');
               var ders_id=result[1];
               var talyp_id=result[2];
               var bal=$(this).val();
               $.ajax({  
                    url:"add_point_ozbashdak.php",  
                    method:"POST",  
                    data:{ders_id:ders_id, talyp_id:talyp_id, bal:bal},
                    dataType:"html",  
                    success:function(data){
                        //alert(data);
                    }  
               });
          });
      });
    </script>
</html>
