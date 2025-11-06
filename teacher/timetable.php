<?php
    session_start();
    $id_ulanyjy=$_SESSION['id'];
    include '..//dbconnection.php';
    $query=mysqli_query($con, "SELECT * FROM synag_tapgyr");
    while ($row=mysqli_fetch_array($query)){
        if ($row['gornush']=='1'){
            $adaty_yy=$row['yarymyyllyk'];
            $adaty_aj=$row['aralyk_jemleme'];
            $adaty_ss=$row['sorag_sany'];
        }
        if ($row['gornush']=='2'){
            $bakalawr_yy=$row['yarymyyllyk'];
            $bakalawr_aj=$row['aralyk_jemleme'];
            $bakalawr_ss=$row['sorag_sany'];
        }
        if ($row['gornush']=='3'){
            $pod_yy=$row['yarymyyllyk'];
            $pod_aj=$row['aralyk_jemleme'];
            $pod_ss=$row['sorag_sany'];
        }
    }
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
            <div class="container-fluid">
                    <ul class="nav nav-pills nav-justified" role="tablist" style="font-size: 20px; padding-left:100px;">
                        <li class="active"><a href="#Sanawjy" role="tab" data-toggle="tab">Sanawjy</a></li>
                        <li><a href="#Maydalawjy" role="tab" data-toggle="tab">Maýdalawjy</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="Sanawjy">
                            <table class="table table-bordered">
                                <thead style="background-color: #76CA40; color: white;" class="text-center">
                                    <td></td>
                                    <td><h3><b>Düşenbe</b></h3></td>
                                    <td><h3><b>Sişenbe</b></h3></td>
                                    <td><h3><b>Çarşenbe</b></h3></td>
                                    <td><h3><b>Penşenbe</b></h3></td>
                                    <td><h3><b>Anna</b></h3></td>
                                    <td><h3><b>Şenbe</b></h3></td>
                                </thead>
                                <tbody>
                                    <?php
                                        for ($jubut=1; $jubut<=3; $jubut++){?>
                                            <tr>
                                                <td><h4><?php echo $jubut; ?>-nji jübüt</h4></td>
                                            <?php
                                            for ($gun=1; $gun<=6; $gun++){
                                                $query_reje=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady, ders_gornushi.ady AS ders_gor_ady, umumy_reje.gun, umumy_reje.jubut, otaglar.nomer, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM ders_atlary, mugallymlar, ders_gornushi, umumy_reje, toparchalar, ders_maglumat, otaglar, ulanyjylar, hunarler WHERE umumy_reje.ders_id=ders_maglumat.id AND umumy_reje.toparcha_id=toparchalar.id AND umumy_reje.otag=otaglar.id AND ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.mug_id=mugallymlar.id AND ders_maglumat.gornushi=ders_gornushi.id AND mugallymlar.ulanyjy_id=ulanyjylar.id AND hunarler.id=toparchalar.hunar AND ulanyjylar.id='$id_ulanyjy' AND umumy_reje.gun='$gun' AND umumy_reje.jubut='$jubut' AND umumy_reje.s_m='1' ORDER BY toparchalar.id, umumy_reje.gun");

                                                if (mysqli_num_rows($query_reje)>0){
                                                    $toparchalar="";
                                                    while ($row_reje=mysqli_fetch_array($query_reje)){
                                                        $ders_ady=$row_reje['ders_ady'];
                                                        $ders_gor_ady=$row_reje['ders_gor_ady'];
                                                        $otag=$row_reje['nomer'];
                                                        $toparchalar=$toparchalar." ".$row_reje['gysga_ady']." ".$row_reje['yyl']."0".$row_reje['toparcha'];
                                                    }
                                                    ?>
                                                        <td class="text-center">
                                                            <p class="text-uppercase"><?php echo $ders_ady; ?></p>
                                                            <p><b><?php echo $toparchalar; ?></b></p>
                                                            <p class="text-muted">(<?php echo $ders_gor_ady; ?>) <?php echo $otag; ?></p>
                                                        </td>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <td></td>
                                                <?php
                                            }
                                            }
                                            ?>
                                        </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="Maydalawjy">
                            <table class="table table-bordered">
                                <thead style="background-color: #76CA40; color: white;" class="text-center">
                                    <td></td>
                                    <td><h3><b>Düşenbe</b></h3></td>
                                    <td><h3><b>Sişenbe</b></h3></td>
                                    <td><h3><b>Çarşenbe</b></h3></td>
                                    <td><h3><b>Penşenbe</b></h3></td>
                                    <td><h3><b>Anna</b></h3></td>
                                    <td><h3><b>Şenbe</b></h3></td>
                                </thead>
                                <tbody>
                                    <?php
                                        for ($jubut=1; $jubut<=3; $jubut++){?>
                                            <tr>
                                                <td><h4><?php echo $jubut; ?>-nji jübüt</h4></td>
                                            <?php
                                            for ($gun=1; $gun<=6; $gun++){
                                                $query_reje=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady, ders_gornushi.ady AS ders_gor_ady, umumy_reje.gun, umumy_reje.jubut, otaglar.nomer, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM ders_atlary, mugallymlar, ders_gornushi, umumy_reje, toparchalar, ders_maglumat, otaglar, ulanyjylar, hunarler WHERE umumy_reje.ders_id=ders_maglumat.id AND umumy_reje.toparcha_id=toparchalar.id AND umumy_reje.otag=otaglar.id AND ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.mug_id=mugallymlar.id AND ders_maglumat.gornushi=ders_gornushi.id AND mugallymlar.ulanyjy_id=ulanyjylar.id AND hunarler.id=toparchalar.hunar AND ulanyjylar.id='$id_ulanyjy' AND umumy_reje.gun='$gun' AND umumy_reje.jubut='$jubut' AND umumy_reje.s_m='2' ORDER BY toparchalar.id, umumy_reje.gun");

                                                if (mysqli_num_rows($query_reje)>0){
                                                    $toparchalar="";
                                                    while ($row_reje=mysqli_fetch_array($query_reje)){
                                                        $ders_ady=$row_reje['ders_ady'];
                                                        $ders_gor_ady=$row_reje['ders_gor_ady'];
                                                        $otag=$row_reje['nomer'];
                                                        $toparchalar=$toparchalar." ".$row_reje['gysga_ady']." ".$row_reje['yyl']."0".$row_reje['toparcha'];
                                                    }
                                                    ?>
                                                        <td class="text-center">
                                                            <p class="text-uppercase"><?php echo $ders_ady; ?></p>
                                                            <p><b><?php echo $toparchalar; ?></b></p>
                                                            <p class="text-muted">(<?php echo $ders_gor_ady; ?>) <?php echo $otag; ?></p>
                                                        </td>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <td></td>
                                                <?php
                                            }
                                            }
                                            ?>
                                        </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
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

</html>
