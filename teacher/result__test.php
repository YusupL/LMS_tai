<?php
    include '../admin/functions.php';
    include '../dbconnection.php';
    session_start();
    $id_ulanyjy=$_SESSION['id'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Test netije</title>

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
                <div class="panel-group" id="sapak" style="margin-top: 10px;">
                    <?php
                        include '../dbconnection.php';
                        $query_result=mysqli_query($con, "SELECT ders_atlary.ady, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, toparchalar.id AS toparcha_id, ders_maglumat.id AS ders_id, hunarler.gornushi AS hunar_gornush FROM toparchalar, hunarler, ders_atlary, ders_maglumat, mugallymlar WHERE toparchalar.hunar=hunarler.id AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.mug_id=mugallymlar.id AND ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.ara_syn_deg='1' AND (hunarler.gornushi='1' OR hunarler.gornushi='2' OR hunarler.gornushi='3')  AND mugallymlar.ulanyjy_id='$id_ulanyjy'");
                        $totalrows = mysqli_num_rows($query_result);
                        if ($totalrows>0){
                        while ($row_result=mysqli_fetch_array($query_result)) {
                            $toparcha_id=$row_result['toparcha_id'];
                            $ders_id=$row_result['ders_id'];
                            $hunar_gornush=$row_result['hunar_gornush'];
                            //echo $toparcha_id;
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#sapak" href="#sapak<?php echo $row_result['ders_id']; ?>">
                                    <?php echo $row_result['ady']; ?> <span class="text-muted"> (<?php echo $row_result['gysga_ady'].$row_result['yyl']."0".$row_result['toparcha']; ?>)</span>
                                </a>
                            </h4>
                        </div>
                        <div id="sapak<?php echo $row_result['ders_id'];?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="container-fluid">
                                    <table class="grade_table">
                                        <thead>
                                            <tr class="grade_table_header">
                                                <td style="border-radius: 15px 0 0 0;" class="column1">Familiýasy, Ady</td>
                                                <td class="column2">Baha</td>
                                                <td class="column2">Netije</td>
                                                <td style="border-radius: 0 15px 0 0;" class="column3">Jogaplar</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query_top_gor=mysqli_query($con, "SELECT * FROM synag_tapgyr WHERE synag_tapgyr.gornush IN (SELECT hunarler.gornushi FROm hunarler WHERE hunarler.id IN (SELECT toparchalar.hunar FROM toparchalar WHERE toparchalar.id='$toparcha_id'))");
                                                $row_top_gor=mysqli_fetch_array($query_top_gor);
                                                $yarymyyllyk=$row_top_gor['yarymyyllyk'];
                                                $aralyk_jemleme=$row_top_gor['aralyk_jemleme'];
                                                $sorag_sany=$row_top_gor['sorag_sany'];
                                                $query_talyplar=mysqli_query($con, "SELECT talyplar.id AS talyp_id, talyplar.familiyasy, talyplar.ady, ortacha_baha.baha AS baha FROM talyplar LEFT JOIN ortacha_baha ON talyplar.id=ortacha_baha.talyp_id AND ortacha_baha.ders_id='$ders_id' AND ortacha_baha.aralyk_jemleme='$aralyk_jemleme' WHERE talyplar.toparcha='$toparcha_id'");
                                                while ($row_talyplar=mysqli_fetch_array($query_talyplar)) {
                                                
                                                $talyp_id=$row_talyplar['talyp_id'];
                                                $ortacha_baha=$row_talyplar['baha'];

                                                $bellenen_jogap="";
                                                $bolmaly_jogap="";
                                                $query_test=mysqli_query($con, "SELECT bolmaly_jogap, bellenen_jogap FROM bellenen_jogap_test WHERE talyp_id='$talyp_id' AND ders_id='$ders_id' AND aralyk_jemleme='$aralyk_jemleme'");
                                                $row_num_test=mysqli_num_rows($query_test);
                                                if ($row_num_test>0){
                                                    $row_test=mysqli_fetch_array($query_test);
                                                    $bolmaly_jogap=$row_test['bolmaly_jogap'];
                                                    $bellenen_jogap=$row_test['bellenen_jogap'];
                                                }
                                                else{
                                                    $query_pdf=mysqli_query($con, "SELECT bellenen_jogap FROM bellenen_jogap_pdf WHERE talyp_id='$talyp_id' AND ders_id='$ders_id' AND aralyk_jemleme='$aralyk_jemleme'");
                                                    $row_num_pdf=mysqli_num_rows($query_pdf);
                                                    if ($row_num_pdf>0){
                                                        $row_pdf=mysqli_fetch_array($query_pdf);
                                                        $bellenen_jogap=$row_pdf['bellenen_jogap'];
                                                        $query_pdf_jogap=mysqli_query($con, "SELECT jogap FROM testler_pdf WHERE ders_id='$ders_id' AND aralyk_jemleme='$aralyk_jemleme'");
                                                        $row_pdf_jogap=mysqli_fetch_array($query_pdf_jogap);
                                                        $bolmaly_jogap=deshifr_kichi($row_pdf_jogap['jogap']);
                                                    }
                                                }
                                                $d=0; $test_baha=0;

                                                if ($bellenen_jogap!=""){
                                                    if ($hunar_gornush=='1'){
                                                        for ($i=0; $i<$sorag_sany; $i++){
                                                            if ($bellenen_jogap[$i]==$bolmaly_jogap[$i]) $d++;
                                                        }
                                                        $test_baha=round(5*$d/$sorag_sany, 2);
                                                    }
                                                    else if ($hunar_gornush=='2'){
                                                        //1-22 23-40 41-54
                                                        for ($i=0; $i<$sorag_sany; $i++){
                                                            if (($bellenen_jogap[$i]==$bolmaly_jogap[$i])&&($i<45)) $d+=0.5;
                                                            if (($bellenen_jogap[$i]==$bolmaly_jogap[$i])&&($i<81)&&($i>=45)) $d++;
                                                            if (($bellenen_jogap[$i]==$bolmaly_jogap[$i])&&($i<109)&&($i>=81)) $d+=1.5;
                                                        }
                                                        $test_baha=$d;
                                                    }
                                                    else if ($hunar_gornush=='3'){
                                                        //1-22 23-40 41-54
                                                        for ($i=0; $i<$sorag_sany; $i++){
                                                            if (($bellenen_jogap[$i]==$bolmaly_jogap[$i])&&($i<30)) $d+=0.5;
                                                            if (($bellenen_jogap[$i]==$bolmaly_jogap[$i])&&($i<40)&&($i>=30)) $d+=1;
                                                            if (($bellenen_jogap[$i]==$bolmaly_jogap[$i])&&($i<50)&&($i>=40)) $d+=1.5;
                                                        }
                                                        $test_baha=$d;
                                                    }
                                                }
                                                if ($ortacha_baha!=0) $ob=($ortacha_baha+$test_baha)/2; else $ob=$test_baha;
                                                $ob=round($ob, 2);
                                            ?>
                                            <tr class="grade_table_body">
                                                <td class="column1"><?php echo $row_talyplar['familiyasy']." ".$row_talyplar['ady'];    ?></td>
                                                <td class="column2"><?php echo $ob." / ".$ortacha_baha." / ".$test_baha; ?></td>
                                                <td class="column2"><?php echo $test_baha; ?> <span class="text-muted">(<?php echo $d." / ".$sorag_sany; ?>)</span></td>
                                                <td class="column3">
                                                    <?php if ($bellenen_jogap!=""){ ?>
                                                        <table class="dogry_yalnysh">
                                                            <tr><?php for ($i=0; $i<$sorag_sany; $i++) {?> <td><?php echo $i+1; ?></td><?php } ?></tr>
                                                            <tr><?php for ($i=0; $i<$sorag_sany; $i++) {?> <td><?php echo $bolmaly_jogap[$i]; ?></td><?php } ?></tr>
                                                            <tr><?php for ($i=0; $i<$sorag_sany; $i++) {?> <td <?php if ($bolmaly_jogap[$i]!=$bellenen_jogap[$i]) { echo "style='color: red;'"; } ?> ><?php echo $bellenen_jogap[$i]; ?></td><?php } ?></tr>
                                                        </table>
                                                    <?php } ?>
                                                </td>
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
                    <?php
                }
            }
                    ?>
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
