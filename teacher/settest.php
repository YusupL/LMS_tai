<?php
    include '../dbconnection.php';
    session_start();
    $id_ulanyjy=$_SESSION['id'];
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
        
        <div class="container-fluid">
            <br>
            <div class="card" style="background-color: #EAECEE; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="card-header" style="background-color: #FCF5BA;">
                    <h3 class="card-title bg-primary text-white" style="background-color: #EFA61B; font-family: Georgia; padding: 7px;">Test ýüklemek</h3>
                </div>
                <div class="card-body">
            <!--Adaty hunar uchin test yuklemek-->
            <?php
                include '../dbconnection.php';
                $query_1=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady, ders_maglumat.ders_id AS ders_ady_id, toparchalar.yyl, ders_maglumat.id AS ders_id FROM mugallymlar, ders_atlary, ders_maglumat, toparchalar, hunarler WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.toparcha_id=toparchalar.id AND mugallymlar.id=ders_maglumat.mug_id AND hunarler.id=toparchalar.hunar AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND hunarler.gornushi='1' AND (ders_maglumat.synag_degish='1' OR ders_maglumat.ara_syn_deg='1') GROUP BY ders_atlary.id, toparchalar.yyl");
                $totalrows = mysqli_num_rows($query_1);
                if ($totalrows>0){                    
                    ?>
                    <div class="card" style="margin: 15px; background-color: #EAECEE; box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="card-header" style="background-color: #FCF5BA;">
                            <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; font-family: Georgia; padding: 7px;">Hünärler üçin</h3>
                        </div>

                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="panel-group" id="sapak" style="margin-top: 10px;">                                    
                                <?php while ($row_1=mysqli_fetch_array($query_1)) {

                                    $ders_ady_id=$row_1['ders_ady_id'];
                                    $ders_id=$row_1['ders_id'];
                                    $ders_ady=$row_1['ders_ady'];
                                    $yyl=$row_1['yyl'];
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#sapak" href="#sapak<?php echo $ders_id ?>" style="font-size: 20px;"> <?php echo $ders_ady;?></a>
                                    <?php $query_2=mysqli_query($con, "SELECT hunarler.gysga_ady AS hunar_ady, toparchalar.yyl, toparchalar.toparcha, ders_maglumat.id AS ders_id FROM hunarler, toparchalar, ders_maglumat, mugallymlar WHERE hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.mug_id=mugallymlar.id AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND ders_maglumat.ders_id='$ders_ady_id' AND toparchalar.yyl='$yyl' AND hunarler.gornushi='1' AND (ders_maglumat.synag_degish='1' OR ders_maglumat.ara_syn_deg='1')");
                                        echo "(";
                                        $ders_id_ler="";
                                        while ($row_2=mysqli_fetch_array($query_2)) {
                                            $ders_id1=$row_2['ders_id'];
                                            
                                            $ders_id_ler.=$ders_id1."-";
                                            
                                            $query_renk=mysqli_query($con, "SELECT testler.sorag FROM testler, testler_degishlilik WHERE testler_degishlilik.ders_id='$ders_id1' AND testler.aralyk_jem='$adaty_aj' AND testler.id=testler_degishlilik.test_id");
                                            $totalrows=mysqli_num_rows($query_renk);

                                            $file_name="pdfler/".$adaty_aj."_".$row_2['ders_id'].".pdf";?>
                                            <span style='color: green;'> 
                                                <?php echo $row_2['hunar_ady']." ".$row_2['yyl']."0".$row_2['toparcha']?> </span> <?php
                                            $hunar_ady=$row_2['hunar_ady'];
                                            $yyl=$row_2['yyl'];
                                        }
                                        echo ")";
                                        $qsorsan=mysqli_query($con, "SELECT id FROM synag_test_regis WHERE mugal_ulan_id='$id_ulanyjy' AND ders_magl_id='$ders_id_ler' AND ar_jem='$adaty_aj'");
                                        if (mysqli_num_rows($qsorsan)>0){
                                            $rsorsan=mysqli_fetch_array($qsorsan);
                                            $testid=$rsorsan['id'];
                                            $sorsan=mysqli_num_rows(mysqli_query($con, "SELECT id FROM synag_test_jogap WHERE id_test='$testid'"));
                                        }
                                        else{
                                            $sorsan=0;
                                        }
                                        ?>
                                            </h4>
                                        </div>

                        <div id="sapak<?php echo $ders_id; ?>" class="panel-collapse collapse">
                            <div class="panel-body">  
                                <form class="" method="post" action="edittest.php" enctype="multipart/form-data">
                                    <input type="hidden" name="hunar_ady" value="<?php echo $hunar_ady;?>">
                                    <input type="hidden" name="sapak_ady" value="<?php echo $ders_ady;?>">
                                    <input type="hidden" name="yyl" value="<?php echo $yyl;?>">
                                    <input type="hidden" name="sorag_sany" value="<?php echo $adaty_ss;?>">
                                    <input type="hidden" name="aralyk_jemleme" value="<?php echo $adaty_aj;?>">
                                    <input type="hidden" name="id_ulanyjy" value="<?php echo $id_ulanyjy;?>">
                                    <input type="hidden" name="ders_id_ler" value="<?php echo $ders_id_ler;?>">

                                    <div class='form-group row'>
                                        <div class="col-md-8">
                                            <div style="padding: 5px; padding-left: 30px; font-size: 20px; background-color: #32ce36; color: white; border-radius: 5px;"><?php if ($sorsan>=$adaty_ss){echo "Ähli soraglar girizilen!";} else {echo $adaty_ss." soragdan ".$sorsan." sorag girizilen";} ?>
                                            </div>
                                        </div> 
                                            <?php $query_3=mysqli_query($con, "SELECT toparchalar.id AS toparcha_id FROM toparchalar, ders_maglumat, mugallymlar, hunarler WHERE hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.mug_id=mugallymlar.id AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND hunarler.gornushi='1' AND toparchalar.yyl='$yyl' AND ders_maglumat.ders_id='$ders_ady_id' AND (ders_maglumat.synag_degish='1' OR ders_maglumat.ara_syn_deg='1')");
                                                while ($row_3=mysqli_fetch_array($query_3)) {
                                                    $ders_id1=$row_3['ders_id'];
                                            ?>                                                      
                                                    <input type="hidden" name="id_toparchalar[]" value="<?php echo $row_3['toparcha_id']; ?>">
                                                    
                                                <?php }
                                            ?>
                                        <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-success class_pdf' value='Sazlamak'></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                        <?php
                    }?>
                    </div></div></div></div>
                    <?php
                }
            ?>
            <!--Bakalawr hunar uchin test yuklemek-->
            <?php
                include '../dbconnection.php';
                $query_1=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady, ders_maglumat.ders_id AS ders_ady_id, toparchalar.yyl, ders_maglumat.id AS ders_id FROM mugallymlar, ders_atlary, ders_maglumat, toparchalar, hunarler WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.toparcha_id=toparchalar.id AND mugallymlar.id=ders_maglumat.mug_id AND hunarler.id=toparchalar.hunar AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND hunarler.gornushi='2' AND (ders_maglumat.synag_degish='1' OR ders_maglumat.ara_syn_deg='1') GROUP BY ders_atlary.id, toparchalar.yyl");
                $totalrows = mysqli_num_rows($query_1);
                if ($totalrows>0){                    
                    ?>
                    <div class="card" style="margin: 15px; background-color: #EAECEE; box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="card-header" style="background-color: #FCF5BA;">
                            <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; font-family: Georgia; padding: 7px;">Bakalawr üçin</h3>
                        </div>

                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="panel-group" id="sapak" style="margin-top: 10px;">                                    
                                <?php while ($row_1=mysqli_fetch_array($query_1)) {

                                    $ders_ady_id=$row_1['ders_ady_id'];
                                    $ders_id=$row_1['ders_id'];
                                    $ders_ady=$row_1['ders_ady'];
                                    $yyl=$row_1['yyl'];
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#sapak" href="#sapak<?php echo $ders_id ?>" style="font-size: 20px;"> <?php echo $ders_ady;?></a>
                                    <?php $query_2=mysqli_query($con, "SELECT hunarler.gysga_ady AS hunar_ady, toparchalar.yyl, toparchalar.toparcha, ders_maglumat.id AS ders_id FROM hunarler, toparchalar, ders_maglumat, mugallymlar WHERE hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.mug_id=mugallymlar.id AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND ders_maglumat.ders_id='$ders_ady_id' AND toparchalar.yyl='$yyl' AND hunarler.gornushi='2' AND (ders_maglumat.synag_degish='1' OR ders_maglumat.ara_syn_deg='1')");
                                        echo "(";
                                        $ders_id_ler="";
                                        while ($row_2=mysqli_fetch_array($query_2)) {
                                            $ders_id1=$row_2['ders_id'];
                                            
                                            $ders_id_ler.=$ders_id1."-";
                                            
                                            $query_renk=mysqli_query($con, "SELECT testler.sorag FROM testler, testler_degishlilik WHERE testler_degishlilik.ders_id='$ders_id1' AND testler.aralyk_jem='$bakalawr_aj' AND testler.id=testler_degishlilik.test_id");
                                            $totalrows=mysqli_num_rows($query_renk);?>
                                            <span style='color: green;'> 
                                                <?php echo $row_2['hunar_ady']." ".$row_2['yyl']."0".$row_2['toparcha']?> </span> <?php
                                            $hunar_ady=$row_2['hunar_ady'];
                                            $yyl=$row_2['yyl'];
                                        }
                                        echo ")";
                                        $qsorsan=mysqli_query($con, "SELECT id FROM synag_test_regis WHERE mugal_ulan_id='$id_ulanyjy' AND ders_magl_id='$ders_id_ler'");
                                        if (mysqli_num_rows($qsorsan)>0){
                                            $rsorsan=mysqli_fetch_array($qsorsan);
                                            $testid=$rsorsan['id'];
                                            $sorsan=mysqli_num_rows(mysqli_query($con, "SELECT id FROM synag_test_jogap WHERE id_test='$testid'"));
                                        }
                                        else{
                                            $sorsan=0;
                                        }
                                        ?>
                                            </h4>
                                        </div>

                        <div id="sapak<?php echo $ders_id; ?>" class="panel-collapse collapse">
                            <div class="panel-body">  
                                <form class="" method="post" action="edittest.php" enctype="multipart/form-data">
                                    <input type="hidden" name="hunar_ady" value="<?php echo $hunar_ady;?>">
                                    <input type="hidden" name="sapak_ady" value="<?php echo $ders_ady;?>">
                                    <input type="hidden" name="yyl" value="<?php echo $yyl;?>">
                                    <input type="hidden" name="sorag_sany" value="<?php echo $bakalawr_ss;?>">
                                    <input type="hidden" name="aralyk_jemleme" value="<?php echo $bakalawr_aj;?>">
                                    <input type="hidden" name="id_ulanyjy" value="<?php echo $id_ulanyjy;?>">
                                    <input type="hidden" name="ders_id_ler" value="<?php echo $ders_id_ler;?>">

                                    <div class='form-group row'>
                                        <div class="col-md-8">
                                            <div style="padding: 5px; padding-left: 30px; font-size: 20px; background-color: #32ce36; color: white; border-radius: 5px;"><?php if ($sorsan>=$bakalawr_ss){echo "Ähli soraglar girizilen!";} else {echo $bakalawr_ss." soragdan ".$sorsan." sorag girizilen";} ?>
                                            </div>
                                        </div>                                  
                                        
                                            <?php $query_3=mysqli_query($con, "SELECT toparchalar.id AS toparcha_id FROM toparchalar, ders_maglumat, mugallymlar, hunarler WHERE hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.mug_id=mugallymlar.id AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND hunarler.gornushi='2' AND toparchalar.yyl='$yyl' AND ders_maglumat.ders_id='$ders_ady_id' AND (ders_maglumat.synag_degish='1' OR ders_maglumat.ara_syn_deg='1')");
                                                while ($row_3=mysqli_fetch_array($query_3)) {
                                                    $ders_id1=$row_3['ders_id'];
                                            ?>                                                      
                                                    <input type="hidden" name="id_toparchalar[]" value="<?php echo $row_3['toparcha_id']; ?>">
                                                    
                                                <?php }
                                            ?>
                                        <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-success class_pdf' value='Sazlamak'></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                        <?php
                    }?>
                    </div></div></div></div>
                    <?php
                }
            ?>  

            <!--Podkurs hunar uchin test yuklemek-->
            <?php
                include '../dbconnection.php';
                $query_1=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady, ders_maglumat.ders_id AS ders_ady_id, toparchalar.yyl, ders_maglumat.id AS ders_id FROM mugallymlar, ders_atlary, ders_maglumat, toparchalar, hunarler WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.toparcha_id=toparchalar.id AND mugallymlar.id=ders_maglumat.mug_id AND hunarler.id=toparchalar.hunar AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND hunarler.gornushi='3' AND ders_maglumat.synag_degish='1' GROUP BY ders_atlary.id, toparchalar.yyl");
                $totalrows = mysqli_num_rows($query_1);
                if ($totalrows>0){                    
                    ?>
                    <div class="card" style="margin: 15px; background-color: #EAECEE; box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="card-header" style="background-color: #FCF5BA;">
                            <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; font-family: Georgia; padding: 7px;">Bakalawr üçin</h3>
                        </div>

                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="panel-group" id="sapak" style="margin-top: 10px;">                                    
                                <?php while ($row_1=mysqli_fetch_array($query_1)) {

                                    $ders_ady_id=$row_1['ders_ady_id'];
                                    $ders_id=$row_1['ders_id'];
                                    $ders_ady=$row_1['ders_ady'];
                                    $yyl=$row_1['yyl'];
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#sapak" href="#sapak<?php echo $ders_id ?>" style="font-size: 20px;"> <?php echo $ders_ady;?></a>
                                    <?php $query_2=mysqli_query($con, "SELECT hunarler.gysga_ady AS hunar_ady, toparchalar.yyl, toparchalar.toparcha, ders_maglumat.id AS ders_id FROM hunarler, toparchalar, ders_maglumat, mugallymlar WHERE hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.mug_id=mugallymlar.id AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND ders_maglumat.ders_id='$ders_ady_id' AND toparchalar.yyl='$yyl' AND hunarler.gornushi='3' AND ders_maglumat.synag_degish='1'");
                                        echo "(";
                                        $ders_id_ler="";
                                        while ($row_2=mysqli_fetch_array($query_2)) {
                                            $ders_id1=$row_2['ders_id'];
                                            
                                            $ders_id_ler.=$ders_id1."-";
                                            
                                            $query_renk=mysqli_query($con, "SELECT testler.sorag FROM testler, testler_degishlilik WHERE testler_degishlilik.ders_id='$ders_id1' AND testler.aralyk_jem='$pod_aj' AND testler.id=testler_degishlilik.test_id");
                                            $totalrows=mysqli_num_rows($query_renk);?>
                                            <span style='color: green;'> 
                                                <?php echo $row_2['hunar_ady']." ".$row_2['yyl']."0".$row_2['toparcha']?> </span> <?php
                                            $hunar_ady=$row_2['hunar_ady'];
                                            $yyl=$row_2['yyl'];
                                        }
                                        echo ")";
                                        $qsorsan=mysqli_query($con, "SELECT id FROM synag_test_regis WHERE mugal_ulan_id='$id_ulanyjy' AND ders_magl_id='$ders_id_ler'");
                                        if (mysqli_num_rows($qsorsan)>0){
                                            $rsorsan=mysqli_fetch_array($qsorsan);
                                            $testid=$rsorsan['id'];
                                            $sorsan=mysqli_num_rows(mysqli_query($con, "SELECT id FROM synag_test_jogap WHERE id_test='$testid'"));
                                        }
                                        else{
                                            $sorsan=0;
                                        }
                                        ?>
                                            </h4>
                                        </div>

                        <div id="sapak<?php echo $ders_id; ?>" class="panel-collapse collapse">
                            <div class="panel-body">  
                                <form class="" method="post" action="edittest.php" enctype="multipart/form-data">
                                    <input type="hidden" name="hunar_ady" value="<?php echo $hunar_ady;?>">
                                    <input type="hidden" name="sapak_ady" value="<?php echo $ders_ady;?>">
                                    <input type="hidden" name="yyl" value="<?php echo $yyl;?>">
                                    <input type="hidden" name="sorag_sany" value="<?php echo $pod_ss;?>">
                                    <input type="hidden" name="aralyk_jemleme" value="<?php echo $pod_aj;?>">
                                    <input type="hidden" name="id_ulanyjy" value="<?php echo $id_ulanyjy;?>">
                                    <input type="hidden" name="ders_id_ler" value="<?php echo $ders_id_ler;?>">

                                    <div class='form-group row'>
                                        <div class="col-md-8">
                                            <div style="padding: 5px; padding-left: 30px; font-size: 20px; background-color: #32ce36; color: white; border-radius: 5px;"><?php if ($sorsan>=$pod_ss){echo "Ähli soraglar girizilen!";} else {echo $pod_ss." soragdan ".$sorsan." sorag girizilen";} ?>
                                            </div>
                                        </div>                                        
                                        
                                            <?php $query_3=mysqli_query($con, "SELECT toparchalar.id AS toparcha_id FROM toparchalar, ders_maglumat, mugallymlar, hunarler WHERE hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.mug_id=mugallymlar.id AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND hunarler.gornushi='3' AND toparchalar.yyl='$yyl' AND ders_maglumat.ders_id='$ders_ady_id' AND ders_maglumat.synag_degish='1'");
                                                while ($row_3=mysqli_fetch_array($query_3)) {
                                                    $ders_id1=$row_3['ders_id'];
                                            ?>                                                      
                                                    <input type="hidden" name="id_toparchalar[]" value="<?php echo $row_3['toparcha_id']; ?>">
                                                    
                                                <?php }
                                            ?>
                                        <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-success class_pdf' value='Sazlamak'></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                        <?php
                    }?>
                    </div></div></div></div>
                    <?php
                }
            ?>
            <br>
        	</div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            
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
