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

<div class="wrapper" style="margin-right: 15px;">
    
        <?php include 'navbar.php' ?>

        <div class="content">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="alert alert-success"><h3 class="title">Dersler</h3></div>
                        <div class="table-full-width">
                            <?php
                                $query=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady, ders_gornushi.ady AS sap_gor_ady, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, ders_maglumat.sagat_sany, ders_atlary.id AS ders_ady_id, ders_maglumat.id AS ders_id FROM hunarler, toparchalar, ders_maglumat, mugallymlar, ulanyjylar, ders_atlary, ders_gornushi WHERE hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.gornushi=ders_gornushi.id AND ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.mug_id=mugallymlar.id AND mugallymlar.ulanyjy_id=ulanyjylar.id AND ulanyjylar.id='$id_ulanyjy' ORDER BY toparchalar.id");
                                $totalrows = mysqli_num_rows($query);
                                if ($totalrows>0){?>
                                    <table class="table">
                                        <tbody style="font-size: 16px; font-family: Lucida Console;">
                                    <?php
                                    $tb=0;
	                                    while ($row=mysqli_fetch_array($query)) {
	                                            $ders_ady=$row['ders_ady'];
	                                            $sap_gor_ady=$row['sap_gor_ady'];
	                                            $sagat_sany=$row['sagat_sany'];
	                                            $hun_gys_ady=$row['gysga_ady'];
	                                            $yyl=$row['yyl'];
	                                            $toparcha=$row['toparcha'];
	                                            $ders_ady_id=$row['ders_ady_id'];
	                                            $ders_id=$row['ders_id'];
	                                            $hunar=" ".$row['gysga_ady'].$row['yyl']."0".$row['toparcha'];

	                                            $jem=0;
	                                            if (($sap_gor_ady=='Umumy')||($sap_gor_ady=='Söhbet')||(($sap_gor_ady=='Amaly')&&(($ders_ady_id!='14')&&($ders_ady_id!='15')&&($ders_ady_id!='16')))){
	                                                $jem=1;
	                                                $hunar=" ".$row['gysga_ady'].$row['yyl']."01"."-".$row['yyl']."02";
	                                            }

	                                            if ((($jem=='1')&&($toparcha=='1'))||($sap_gor_ady=='Tejribe')||(($sap_gor_ady=='Amaly')&&(($ders_ady_id=='14')||($ders_ady_id=='15')||($ders_ady_id=='16')))){
	                                                $tb++;
	                                            $query_gech_ders=mysqli_query($con, "SELECT count(sene) AS mukdar FROM gechilen_dersler WHERE ders_id='$ders_id'");
	                                            $row_gech_ders=mysqli_fetch_array($query_gech_ders);
	                                            $gech_ders_sany=$row_gech_ders['mukdar'];
	                                        ?>
	                                        <tr>
	                                            <td><?php echo $tb; ?></td>
	                                            <td><b><?php echo $ders_ady." "; ?></b><span class="text-muted">(<?php echo $sap_gor_ady; ?>)</span><?php echo $hunar; ?></td>
	                                            <td class="td-actions text-right">
	                                                (<?php echo 2*$gech_ders_sany; ?>/<?php echo $sagat_sany; ?>)
	                                            </td>
	                                        </tr>
	                                        <?php
	                                        }
	                                    }
                            		?>
                                </tbody>
                            </table>
                            <?php
                            }
                        ?>
                        </div>
                    </div>
                    <div class="content">
                        <div class="footer">
                            <div class="stats">
                                2020-2021-nji okuw ýyly II ýarymýyllyk
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <div class="alert alert-info"><h3 class="title"><b><?php echo $adaty_aj; ?></b>-nji(y) aralyk jemlemesi</h3></div>
                        <div class="table-full-width">
                            <table class="table" style="font-size: 17px; font-family: Lucida Console;">
                                <?php $query=mysqli_query($con, "SELECT ders_atlary.ady, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, synag_reje.bashlayan_wagty, synag_reje.gutaryan_wagty FROM ders_maglumat, mugallymlar, ders_atlary, hunarler, toparchalar LEFT JOIN synag_reje ON toparchalar.id=synag_reje.toparcha_id  WHERE hunarler.id=toparchalar.hunar AND toparchalar.id=ders_maglumat.toparcha_id AND ders_atlary.id=ders_maglumat.ders_id AND ders_maglumat.mug_id=mugallymlar.id AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND ders_maglumat.synag_degish='1' ORDER BY synag_reje.bashlayan_wagty, ders_maglumat.id");
                                ?>
                                <thead>
                                    <td>T/B</td>
                                    <td>Toparça</td>
                                    <td>Dersiň ady</td>
                                    <td>Senesi</td>
                                    <td>Wagty</td>
                                </thead>
                                <tbody>
                                    <?php 
                                    $tb=0;
                                    while ($row=mysqli_fetch_array($query)) {
                                        $tb++;
                                        $toparcha=$row['gysga_ady'].$row['yyl']."0".$row['toparcha'];
                                        $ders_ady=$row['ady'];
                                        $sene="_";
                                        $bash_wagt="_";
                                        $gut_wagt="_";
                                        if (($row['bashlayan_wagty']!="")&&($row['gutaryan_wagty']!="")){
                                            $sene=date("d.m.Y", strtotime($row['bashlayan_wagty']));
                                            $bash_wagt=date("H:i", strtotime($row['bashlayan_wagty']));
                                            $gut_wagt=date("H:i", strtotime($row['gutaryan_wagty']));
                                        }
                                         ?>
                                    <tr>
                                        <td><?php echo $tb; ?></td>
                                        <td><?php echo $toparcha; ?></td>
                                        <td><?php echo $ders_ady; ?></td>
                                        <td><?php echo $sene; ?></td>
                                        <td><?php echo $bash_wagt; ?>-<?php echo $gut_wagt; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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

</html>
