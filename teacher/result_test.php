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
                            $hun_gor=$row_result['hunar_gornush'];
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

                                                $m_jogap="";
                                                $t_jogap="";
                                                $query_test=mysqli_query($con, "SELECT * FROM bellenen_jogap_test WHERE talyp_id='$talyp_id' AND ders_id='$ders_id' AND aralyk_jemleme='$aralyk_jemleme'");
                                                $row_num_test=mysqli_num_rows($query_test);
                                                $d=0; $y=0; $baha=0; $ball=0;
                                                if ($row_num_test>0){
                                                    $row_test=mysqli_fetch_array($query_test);
                                                        $m_jogap=deshifr_kichi($row_test['bolmaly_jogap']);
                                                        $t_jogap=$row_test['bellenen_jogap'];  
                                                        $baly=$row_test['baly'];
                                                                                                            
                                                    $ssa=strlen($m_jogap);
                                                    if(($hun_gor==1)){
                                                      $d=0;
                                                      $y=0;
                                                      for ($j=0; $j<strlen($m_jogap); $j++){
                                                        if ($m_jogap[$j]==$t_jogap[$j]) $d++; else $y++;
                                                      }  
                                                      $baha=$d/$ssa*5;
                                                      $baha=round($baha, 2);
                                                    }
                                                    if (($hun_gor==2)||($hun_gor==3)){
                                                      $barr=explode("-", $baly);
                                                      for ($j=0; $j<strlen($m_jogap); $j++){
                                                        if ($m_jogap[$j]==$t_jogap[$j]){
                                                          $ball+=$barr[$j];
                                                          $d++;                                                          
                                                        }
                                                      } 
                                                    }
                                                }                                                
                                                if ($ortacha_baha!=0) $ob=($ortacha_baha+$baha)/2; else $ob=$baha;
                                                $ob=round($ob, 2);
                                            ?>
                                            <tr class="grade_table_body">
                                                <td class="column1"><?php echo $row_talyplar['familiyasy']." ".$row_talyplar['ady'];    ?></td>
                                                <td class="column2"><?php if ($hun_gor==1) {echo $ob." / ".$ortacha_baha." / ".$baha; }else if (($hun_gor==2)||($hun_gor==3)){echo $ball;} ?></td>
                                                <td class="column2"><?php if ($hun_gor==1) {echo $baha;} ?> <span class="text-muted">(<?php echo $d." / ".$sorag_sany; ?>)</span></td>
                                                <td class="column3">
                                                    <?php if ($t_jogap!=""){ ?>
                                                        <table class="dogry_yalnysh">
                                                            <tr><?php for ($i=0; $i<$ssa; $i++) {?> <td><?php echo $i+1; ?></td><?php } ?></tr>
                                                            <tr><?php for ($i=0; $i<$ssa; $i++) {?> <td><?php echo $m_jogap[$i]; ?></td><?php } ?></tr>
                                                            <tr><?php for ($i=0; $i<$ssa; $i++) {?> <td <?php if ($m_jogap[$i]!=$t_jogap[$i]) { echo "style='color: red;'"; } ?> ><?php echo $t_jogap[$i]; ?></td><?php } ?></tr>
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