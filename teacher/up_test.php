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
    <?php include 'navbar.php'; ?>       
        
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
                $query_1=mysqli_query($con, "SELECT ders_ady, ders_ady_id, yyl, ders_id FROM synag_sapaklar WHERE ulanyjy_id='$id_ulanyjy' AND hunar_gornushi='1' GROUP BY ders_ady_id, yyl");
                $totalrows = mysqli_num_rows($query_1);
                if ($totalrows>0){                    
                    ?>
                    <div class="card" style="margin: 15px; background-color: #EAECEE; box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="card-header" style="background-color: #FCF5BA;">
                            <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; font-family: Georgia; padding: 7px;">
                            Hünärler üçin</h3>
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
                                    <?php $query_2=mysqli_query($con, "SELECT * FROM synag_sapaklar WHERE ders_ady_id='$ders_ady_id' AND yyl='$yyl' AND hunar_gornushi='1' AND ulanyjy_id='$id_ulanyjy'");
                                        echo "(";
                                        while ($row_2=mysqli_fetch_array($query_2)) {
                                            $ders_id1=$row_2['ders_id'];
                                            $query_renk=mysqli_query($con, "SELECT testler.sorag FROM testler,testler_degishlilik WHERE testler_degishlilik.ders_id='$ders_id1' AND testler.aralyk_jem='$adaty_aj' AND testler.id=testler_degishlilik.test_id");
                                            $totalrows=mysqli_num_rows($query_renk);

                                            $file_name="pdfler/".$adaty_aj."_".$row_2['ders_id'].".pdf";?>
                                            <span style='color: <?php if ((!file_exists($file_name))&&($totalrows<$adaty_ss)) echo "red"; else echo "green";?>;'> 
                                                <?php echo $row_2['hunar_ady']." ".$row_2['yyl']."0".$row_2['toparcha']?> </span> <?php

                                            $hunar_ady=$row_2['hunar_ady'];
                                            $yyl=$row_2['yyl'];
                                        }
                                        echo ")";
                                        ?>
                                            </h4>
                                        </div>

                        <div id="sapak<?php echo $ders_id; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form method="post" action="excel_upload.php" enctype="multipart/form-data">
                                    <input type="hidden" name="hunar_ady" value="<?php echo $hunar_ady; ?> ">
                                    <input type="hidden" name="sapak_ady" value="<?php echo $ders_ady;?>">
                                    <input type="hidden" name="yyl" value="<?php echo $yyl;?>">
                                    <input type="hidden" name="sorag_sany" value="<?php echo $adaty_ss;?>">
                                    <input type="hidden" name="aralyk_jemleme" value="<?php echo $adaty_aj;?>">
                                    <input type="hidden" name="id_ulanyjy" value="<?php echo $id_ulanyjy;?>">
                                    
                                    <div class='form-group row'>
                                        <div class="col-lg-1"><div style="padding: 5px; padding-left: 30px; font-size: 20px; background-color: #32ce36; color: white; border-radius: 5px;">TEST</div></div>

                                        <div class='col-md-2'> <input type='file' name='uploadfile' class='form-control' id="file_excel<?php echo $ders_id; ?>" class="file_name"> </div>

                                        <div class="col-md-5"  id="check_excel<?php echo $ders_id; ?>">
                                            <?php $query_3=mysqli_query($con, "SELECT * FROM synag_sapaklar WHERE ders_ady_id='$ders_ady_id'AND yyl='$yyl' AND hunar_gornushi='1' AND ulanyjy_id='$id_ulanyjy'");
                                                while ($row_3=mysqli_fetch_array($query_3)) {
                                                    $ders_id1=$row_3['ders_id'];
                                                    $query_4=mysqli_query($con, "SELECT * FROM testler_degishlilik WHERE ders_id='$ders_id1'");
                                                    $totalrows=mysqli_num_rows($query_4);

                                                    $file_name="pdfler/".$adaty_aj."_".$row_3['ders_id'].".pdf";

                                                    if((!file_exists($file_name))&&($totalrows<$adaty_ss)){ ?>
                                                        <label style="font-size: 18px; color: black; padding-top: 6px; padding-left: 5px; padding-right: 3px;"> <?php echo $row_3['hunar_ady'].$row_3['yyl']."0".$row_3['toparcha']." "; ?> </label><input type="checkbox" name="id_toparchalar[]" value="<?php echo $row_3['toparcha_id']; ?>">
                                                    <?php }
                                                }
                                            ?>
                                        </div>

                                        <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-success class_excel' value='Tassyklamak' id="excel<?php echo $ders_id; ?>"></div>
                                    </div>
                                </form>
                                            
                                <form class="" method="post" action="pdf_upload.php" enctype="multipart/form-data">
                                    <input type="hidden" name="hunar_ady" value="<?php echo $hunar_ady;?>">
                                    <input type="hidden" name="sapak_ady" value="<?php echo $ders_ady;?>">
                                    <input type="hidden" name="yyl" value="<?php echo $yyl;?>">
                                    <input type="hidden" name="sorag_sany" value="<?php echo $adaty_ss;?>">
                                    <input type="hidden" name="aralyk_jemleme" value="<?php echo $adaty_aj;?>">
                                    <input type="hidden" name="id_ulanyjy" value="<?php echo $id_ulanyjy;?>">

                                    <div class='form-group row'>
                                        <div class="col-lg-1"><div style="padding: 5px; padding-left: 30px; font-size: 20px; background-color: #32ce36; color: white; border-radius: 5px;">PDF</div></div>
                                        <div class='col-md-2'> <input type='file' name='pdffile' class='form-control' id="file_pdf<?php echo $ders_id; ?>" class="file_name_pdf"> </div>
                                        <div class="col-md-5"  id="check_pdf<?php echo $ders_id; ?>">
                                            <?php $query_3=mysqli_query($con, "SELECT * FROM synag_sapaklar WHERE ders_ady_id='$ders_ady_id'AND yyl='$yyl' AND hunar_gornushi='1' AND ulanyjy_id='$id_ulanyjy'");
                                                while ($row_3=mysqli_fetch_array($query_3)) {
                                                    $ders_id1=$row_3['ders_id'];
                                                    $query_4=mysqli_query($con, "SELECT * FROM testler_degishlilik WHERE ders_id='$ders_id1'");
                                                    $totalrows=mysqli_num_rows($query_4);

                                                    $file_name="pdfler/".$adaty_aj."_".$row_3['ders_id'].".pdf";

                                                    if((!file_exists($file_name))&&($totalrows<$adaty_ss)){ ?>
                                                        <label style="font-size: 18px; color: black; padding-top: 6px; padding-left: 5px; padding-right: 3px;"> <?php echo $row_3['hunar_ady'].$row_3['yyl']."0".$row_3['toparcha']." "; ?> </label><input type="checkbox" name="id_toparchalar[]" value="<?php echo $row_3['toparcha_id']; ?>">
                                                    <?php }
                                                }
                                            ?>
                                        </div>
                                        <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-success class_pdf' value='Tassyklamak' id="pdf<?php echo $ders_id; ?>" ></div>
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
                $query_1=mysqli_query($con, "SELECT ders_ady, ders_ady_id, yyl, ders_id FROM synag_sapaklar WHERE ulanyjy_id='$id_ulanyjy' AND hunar_gornushi='2' GROUP BY ders_ady_id, yyl");
                $totalrows = mysqli_num_rows($query_1);
                if ($totalrows>0){                    
                    ?>
                    <br>
                    <div class="card" style="margin: 15px; background-color: #EAECEE; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="card-header" style="background-color: #FCF5BA;">
                            <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; font-family: Georgia; padding: 7px;">
                            Bakalawr  üçin</h3>
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
                                    <?php $query_2=mysqli_query($con, "SELECT * FROM synag_sapaklar WHERE ders_ady_id='$ders_ady_id' AND yyl='$yyl' AND hunar_gornushi='2' AND ulanyjy_id='$id_ulanyjy'");

                                        echo "(";
                                        while ($row_2=mysqli_fetch_array($query_2)) {
                                        	
                                        	$hunar_ady=$row_2['hunar_ady'];
                                        	$yyl=$row_2['yyl'];
                                            $ders_id1=$row_2['ders_id'];
                                            $query_renk=mysqli_query($con, "SELECT testler.sorag FROM testler,testler_degishlilik WHERE testler_degishlilik.ders_id='$ders_id1' AND testler.aralyk_jem='$bakalawr_aj' AND testler.id=testler_degishlilik.test_id");
                                            $totalrows=mysqli_num_rows($query_renk);

                                            $file_name="pdfler/".$bakalawr_aj."_".$row_2['ders_id'].".pdf";?>
                                            <span style='color: <?php if ((!file_exists($file_name))&&($totalrows<$bakalawr_ss)) echo "red"; else echo "green";?>;'> 
                                                <?php echo $row_2['hunar_ady']." ".$row_2['yyl']."0".$row_2['toparcha']?> </span> <?php
                                        }
                                        echo ")";
                                        ?>
                                            </h4>
                                        </div>

                        <div id="sapak<?php echo $ders_id; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form method="post" action="excel_upload.php" enctype="multipart/form-data">
                                    <input type="hidden" name="hunar_ady" value="<?php echo $hunar_ady;?>">
                                    <input type="hidden" name="sapak_ady" value="<?php echo $ders_ady;?>">
                                    <input type="hidden" name="yyl" value="<?php echo $yyl;?>">
                                    <input type="hidden" name="sorag_sany" value="<?php echo $bakalawr_ss;?>">
                                    <input type="hidden" name="aralyk_jemleme" value="<?php echo $bakalawr_aj;?>">
                                    <input type="hidden" name="id_ulanyjy" value="<?php echo $id_ulanyjy;?>">
                                    
                                    <div class='form-group row'>
                                        <div class="col-lg-1"><div style="padding: 5px; padding-left: 30px; font-size: 20px; background-color: #32ce36; color: white; border-radius: 5px;">TEST</div></div>

                                        <div class='col-md-2'> <input type='file' name='uploadfile' class='form-control' id="file_excel<?php echo $ders_id; ?>" class="file_name"> </div>

                                        <div class="col-md-5"  id="check_excel<?php echo $ders_id; ?>">
                                            <?php $query_3=mysqli_query($con, "SELECT * FROM synag_sapaklar WHERE ders_ady_id='$ders_ady_id'AND yyl='$yyl' AND hunar_gornushi='2' AND ulanyjy_id='$id_ulanyjy'");
                                                while ($row_3=mysqli_fetch_array($query_3)) {
                                                    $ders_id1=$row_3['ders_id'];
                                                    $query_4=mysqli_query($con, "SELECT * FROM testler_degishlilik WHERE ders_id='$ders_id1'");
                                                    $totalrows=mysqli_num_rows($query_4);

                                                    $file_name="pdfler/".$bakalawr_aj."_".$row_3['ders_id'].".pdf";

                                                    if((!file_exists($file_name))&&($totalrows<$bakalawr_ss)){ ?>
                                                        <label style="font-size: 18px; color: black; padding-top: 6px; padding-left: 5px; padding-right: 3px;"> <?php echo $row_3['hunar_ady'].$row_3['yyl']."0".$row_3['toparcha']." "; ?> </label><input type="checkbox" name="id_toparchalar[]" value="<?php echo $row_3['toparcha_id']; ?>">
                                                    <?php }
                                                }
                                            ?>
                                        </div>

                                        <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-success class_excel' value='Tassyklamak' id="excel<?php echo $ders_id; ?>"></div>
                                    </div>
                                </form>
                                            
                                <form  class="" method="post" action="pdf_upload.php" enctype="multipart/form-data">
                                    <input type="hidden" name="hunar_ady" value="<?php echo $hunar_ady;?>">
                                    <input type="hidden" name="sapak_ady" value="<?php echo $ders_ady;?>">
                                    <input type="hidden" name="yyl" value="<?php echo $yyl;?>">
                                    <input type="hidden" name="sorag_sany" value="<?php echo $bakalawr_ss;?>">
                                    <input type="hidden" name="aralyk_jemleme" value="<?php echo $bakalawr_aj;?>">
                                    <input type="hidden" name="id_ulanyjy" value="<?php echo $id_ulanyjy;?>">

                                    <div class='form-group row'>
                                        <div class="col-lg-1"><div style="padding: 5px; padding-left: 30px; font-size: 20px; background-color: #32ce36; color: white; border-radius: 5px;">PDF</div></div>
                                        <div class='col-md-2'> <input type='file' name='pdffile' class='form-control' id="file_pdf<?php echo $ders_id; ?>" class="file_name_pdf"> </div>
                                        <div class="col-md-5"  id="check_pdf<?php echo $ders_id; ?>">
                                            <?php $query_3=mysqli_query($con, "SELECT * FROM synag_sapaklar WHERE ders_ady_id='$ders_ady_id'AND yyl='$yyl' AND hunar_gornushi='2' AND ulanyjy_id='$id_ulanyjy'");
                                                while ($row_3=mysqli_fetch_array($query_3)) {
                                                    $ders_id1=$row_3['ders_id'];
                                                    $query_4=mysqli_query($con, "SELECT * FROM testler_degishlilik WHERE ders_id='$ders_id1'");
                                                    $totalrows=mysqli_num_rows($query_4);

                                                    $file_name="pdfler/".$bakalawr_aj."_".$row_3['ders_id'].".pdf";

                                                    if((!file_exists($file_name))&&($totalrows<$bakalawr_ss)){ ?>
                                                        <label style="font-size: 18px; color: black; padding-top: 6px; padding-left: 5px; padding-right: 3px;"> <?php echo $row_3['hunar_ady'].$row_3['yyl']."0".$row_3['toparcha']." "; ?> </label><input type="checkbox" name="id_toparchalar[]" value="<?php echo $row_3['toparcha_id']; ?>">
                                                    <?php }
                                                }
                                            ?>
                                        </div>
                                        <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-success class_pdf' value='Tassyklamak' id="pdf<?php echo $ders_id; ?>" ></div>
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
                $query_1=mysqli_query($con, "SELECT ders_ady, ders_ady_id, yyl, ders_id FROM synag_sapaklar WHERE ulanyjy_id='$id_ulanyjy' AND hunar_gornushi='3' GROUP BY ders_ady_id, yyl");
                $totalrows = mysqli_num_rows($query_1);
                if ($totalrows>0){                    
                    ?>
                    <br>
                    <div class="card" style="margin: 15px; background-color: #EAECEE; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="card-header" style="background-color: #FCF5BA;">
                            <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; font-family: Georgia; padding: 7px;">
                            Dil öwreniş bölüminiň talyplary üçin</h3>
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
                                    <?php $query_2=mysqli_query($con, "SELECT * FROM synag_sapaklar WHERE ders_ady_id='$ders_ady_id' AND yyl='$yyl' AND hunar_gornushi='3' AND ulanyjy_id='$id_ulanyjy'");

                                        echo "(";
                                        while ($row_2=mysqli_fetch_array($query_2)) {
                                            
                                            $hunar_ady=$row_2['hunar_ady'];
                                            $yyl=$row_2['yyl'];
                                            $ders_id1=$row_2['ders_id'];
                                            $query_renk=mysqli_query($con, "SELECT testler.sorag FROM testler,testler_degishlilik WHERE testler_degishlilik.ders_id='$ders_id1' AND testler.aralyk_jem='$bakalawr_aj' AND testler.id=testler_degishlilik.test_id");
                                            $totalrows=mysqli_num_rows($query_renk);

                                            $file_name="pdfler/".$bakalawr_aj."_".$row_2['ders_id'].".pdf";?>
                                            <span style='color: <?php if ((!file_exists($file_name))&&($totalrows<$bakalawr_ss)) echo "red"; else echo "green";?>;'> 
                                                <?php echo $row_2['hunar_ady']." ".$row_2['yyl']."0".$row_2['toparcha']?> </span> <?php
                                        }
                                        echo ")";
                                        ?>
                                            </h4>
                                        </div>

                        <div id="sapak<?php echo $ders_id; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form method="post" action="excel_upload.php" enctype="multipart/form-data">
                                    <input type="hidden" name="hunar_ady" value="<?php echo $hunar_ady;?>">
                                    <input type="hidden" name="sapak_ady" value="<?php echo $ders_ady;?>">
                                    <input type="hidden" name="yyl" value="<?php echo $yyl;?>">
                                    <input type="hidden" name="sorag_sany" value="<?php echo $bakalawr_ss;?>">
                                    <input type="hidden" name="aralyk_jemleme" value="<?php echo $bakalawr_aj;?>">
                                    <input type="hidden" name="id_ulanyjy" value="<?php echo $id_ulanyjy;?>">
                                    
                                    <div class='form-group row'>
                                        <div class="col-lg-1"><div style="padding: 5px; padding-left: 30px; font-size: 20px; background-color: #32ce36; color: white; border-radius: 5px;">TEST</div></div>

                                        <div class='col-md-2'> <input type='file' name='uploadfile' class='form-control' id="file_excel<?php echo $ders_id; ?>" class="file_name"> </div>

                                        <div class="col-md-5"  id="check_excel<?php echo $ders_id; ?>">
                                            <?php $query_3=mysqli_query($con, "SELECT * FROM synag_sapaklar WHERE ders_ady_id='$ders_ady_id'AND yyl='$yyl' AND hunar_gornushi='3' AND ulanyjy_id='$id_ulanyjy'");
                                                while ($row_3=mysqli_fetch_array($query_3)) {
                                                    $ders_id1=$row_3['ders_id'];
                                                    $query_4=mysqli_query($con, "SELECT * FROM testler_degishlilik WHERE ders_id='$ders_id1'");
                                                    $totalrows=mysqli_num_rows($query_4);

                                                    $file_name="pdfler/".$bakalawr_aj."_".$row_3['ders_id'].".pdf";

                                                    if((!file_exists($file_name))&&($totalrows<$bakalawr_ss)){ ?>
                                                        <label style="font-size: 18px; color: black; padding-top: 6px; padding-left: 5px; padding-right: 3px;"> <?php echo $row_3['hunar_ady'].$row_3['yyl']."0".$row_3['toparcha']." "; ?> </label><input type="checkbox" name="id_toparchalar[]" value="<?php echo $row_3['toparcha_id']; ?>">
                                                    <?php }
                                                }
                                            ?>
                                        </div>

                                        <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-success class_excel' value='Tassyklamak' id="excel<?php echo $ders_id; ?>"></div>
                                    </div>
                                </form>
                                            
                                <form  class="" method="post" action="pdf_upload.php" enctype="multipart/form-data">
                                    <input type="hidden" name="hunar_ady" value="<?php echo $hunar_ady;?>">
                                    <input type="hidden" name="sapak_ady" value="<?php echo $ders_ady;?>">
                                    <input type="hidden" name="yyl" value="<?php echo $yyl;?>">
                                    <input type="hidden" name="sorag_sany" value="<?php echo $bakalawr_ss;?>">
                                    <input type="hidden" name="aralyk_jemleme" value="<?php echo $bakalawr_aj;?>">
                                    <input type="hidden" name="id_ulanyjy" value="<?php echo $id_ulanyjy;?>">

                                    <div class='form-group row'>
                                        <div class="col-lg-1"><div style="padding: 5px; padding-left: 30px; font-size: 20px; background-color: #32ce36; color: white; border-radius: 5px;">PDF</div></div>
                                        <div class='col-md-2'> <input type='file' name='pdffile' class='form-control' id="file_pdf<?php echo $ders_id; ?>" class="file_name_pdf"> </div>
                                        <div class="col-md-5"  id="check_pdf<?php echo $ders_id; ?>">
                                            <?php $query_3=mysqli_query($con, "SELECT * FROM synag_sapaklar WHERE ders_ady_id='$ders_ady_id'AND yyl='$yyl' AND hunar_gornushi='2' AND ulanyjy_id='$id_ulanyjy'");
                                                while ($row_3=mysqli_fetch_array($query_3)) {
                                                    $ders_id1=$row_3['ders_id'];
                                                    $query_4=mysqli_query($con, "SELECT * FROM testler_degishlilik WHERE ders_id='$ders_id1'");
                                                    $totalrows=mysqli_num_rows($query_4);

                                                    $file_name="pdfler/".$bakalawr_aj."_".$row_3['ders_id'].".pdf";

                                                    if((!file_exists($file_name))&&($totalrows<$bakalawr_ss)){ ?>
                                                        <label style="font-size: 18px; color: black; padding-top: 6px; padding-left: 5px; padding-right: 3px;"> <?php echo $row_3['hunar_ady'].$row_3['yyl']."0".$row_3['toparcha']." "; ?> </label><input type="checkbox" name="id_toparchalar[]" value="<?php echo $row_3['toparcha_id']; ?>">
                                                    <?php }
                                                }
                                            ?>
                                        </div>
                                        <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-success class_pdf' value='Tassyklamak' id="pdf<?php echo $ders_id; ?>" ></div>
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
            <br>
            <div class="card" style="background-color: #EAECEE; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="card-header" style="background-color: #FCF5BA;">
                    <h3 class="card-title bg-primary text-white" style="background-color: #EFA61B; font-family: Georgia; padding: 7px;">
                    Ortaça baha</h3>
                </div>
                <?php
                include '../dbconnection.php';
                $query_ob=mysqli_query($con, "SELECT ders_atlary.ady, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, toparchalar.id AS toparcha_id, ders_maglumat.id AS ders_id FROM toparchalar, hunarler, ders_atlary, ders_maglumat, mugallymlar WHERE toparchalar.hunar=hunarler.id AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.mug_id=mugallymlar.id AND ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.ara_syn_deg='1' AND hunarler.gornushi='1' AND mugallymlar.ulanyjy_id='$id_ulanyjy'");
                $totalrows = mysqli_num_rows($query_ob);
                if ($totalrows>0){                    
                    ?>
                    <div class="card" style="margin: 15px; background-color: #EAECEE; box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="card-header" style="background-color: #FCF5BA;">
                            <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; font-family: Georgia; padding: 7px;">
                            Adaty hünärler üçin</h3>
                        </div>

                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="panel-group" id="ortacha_baha" style="margin-top: 10px;">
                                    
                                <?php while ($row_ob=mysqli_fetch_array($query_ob)) {
                                    $ders_ady=$row_ob['ady'];
                                    $hunar_ady=$row_ob['gysga_ady'];
                                    $yyl=$row_ob['yyl'];
                                    $toparcha=$row_ob['toparcha'];
                                    $toparcha_id=$row_ob['toparcha_id'];
                                    $ders_id=$row_ob['ders_id'];
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#ortacha_baha" href="#ob<?php echo $ders_id ?>" style="font-size: 20px;"> <?php echo $ders_ady;?></a>
                                            <span class="text-muted"> 
                                                <?php echo "(".$hunar_ady." ".$yyl."0".$toparcha.")"; ?> </span>
                                            </h4>
                                        </div>

                                        <div id="ob<?php echo $ders_id; ?>" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <table class="table_zhurnal" id="e-zhurnal<?php echo $ders_id;?>">
                                                    <thead>
                                                        <th>Familiýasy, ady</th>
                                                        <th><div class="zhurnal_rotate">I aralyk jemleme</div></th>
                                                        <th><div class="zhurnal_rotate">II aralyk jemleme</div></th>
                                                        <th><div class="zhurnal_rotate">III aralyk jemleme</div></th>
                                                        <th><div class="zhurnal_rotate">IV aralyk jemleme</div></th>
                                                        <th><div class="zhurnal_rotate">Synag</div></th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $query_talyp=mysqli_query($con, "SELECT * FROM talyplar WHERE toparcha='$toparcha_id'");
                                                            while ($row_talyp=mysqli_fetch_array($query_talyp)) {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo $row_talyp['familiyasy']." ".$row_talyp['ady']; ?>
                                                                    </td>
                                                                    <?php
                                                                        $talyp_id=$row_talyp['id'];
                                                                        for ($i=1; $i<=5; $i++){
                                                                            $query_baha=mysqli_query($con, "SELECT baha FROM ortacha_baha WHERE ders_id='$ders_id' AND talyp_id='$talyp_id' AND aralyk_jemleme='$i'");
                                                                            $san_baha=mysqli_num_rows($query_baha);
                                                                            if ($san_baha>0){                                                                        
                                                                                while ($row_baha=mysqli_fetch_array($query_baha)){
                                                                                    $baha=$row_baha['baha'];
                                                                                    ?><td><?php echo $baha; ?></td><?php
                                                                                }
                                                                            } 
                                                                            else {
                                                                                ?>
                                                                                    <td>-</td>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                        <tr>
                                                            <td></td>
                                                            <?php
                                                            for ($i=1; $i<=5; $i++){?>
                                                                    <td>
                                                                        <button data-toggle="modal" data-target="#addModal" class="edit_data" data-id="<?php echo $ders_id; ?>" id="<?php echo $i; ?>"><i class="fas fa-edit"></i>
                                                                        </button>
                                                                    </td>
                                                                <?php
                                                            }
                                                                ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
                <br>
            </div>
        </div>
    
</div>
<div id="addModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ortaça baha girizmek</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <input type="hidden" name="ders_id" id="ders_id" value="">
                    <input type="hidden" name="aralyk_jemleme" id="aralyk_jemleme" value="">
                    <div class="talyplar">
                        <!--talyplaryn sanawy ajaxdan gelyar-->    
                    </div>
                    
                    <input type="submit" name="insert" id="insert" value="Tassyklamak" class="btn btn-success" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ýapmak</button>
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
        /*$(document).ready (function(){
            $("#Tassyklamak").bind("click", function(){
                var upload = $('#file_name').val();
                alert(upload);

                $.ajax({
                    url: "excel_upload.php",
                    type: "POST",
                    data: ({upload, upload}),
                    dataType: "html",
                    success: function (data){
                        $("#soraglar").html(data);
                    }
                });
            });
        });*/
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.class_pdf').click(function() {
                var id=$(this).attr("id");
                id=id.substring(3, id.length);
                //alert(id);

              checked = $("#check_pdf"+id+" input[type=checkbox]:checked").length;
              if(!checked) {
                alert("Toparçalara bellik goýulmandyr!");
                return false;
              }
              var vidFileLength = $("#file_pdf"+id)[0].files.length;
                if(vidFileLength === 0){
                    alert("PDF faýly saýlanmandyr!");
                    return false;
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.class_excel').click(function() {
                var id=$(this).attr("id");
                id=id.substring(5, id.length);
                //alert(id);

              checked = $("#check_excel"+id+" input[type=checkbox]:checked").length;
              if(!checked) {
                alert("Toparçalara bellik goýulmandyr!");
                return false;
              }
              var vidFileLength = $("#file_excel"+id)[0].files.length;
                if(vidFileLength === 0){
                    alert("Excel faýly saýlanmandyr!");
                    return false;
                }
            });
        });
    </script>
    <script type="text/javascript">
        var ders_id;
        $(document).on('click', '.edit_data', function(){
            $('#insert_form')[0].reset();
            $('#insert').val("Üýtgetmek");
            var aralyk_jemleme= $(this).attr("id");
            var ders_id=$(this).attr("data-id");
            
            $("#ders_id").val(ders_id);
            $("#aralyk_jemleme").val(aralyk_jemleme);
            
            $.ajax({
                url: "orta_baha_get_talyp.php",
                method: "POST",
                data:{ders_id:ders_id, aralyk_jemleme:aralyk_jemleme},
                dataType: "html",
                success:function(data){
                    $('.talyplar').html(data);
                }
            });
        });
        $('#insert_form').on("submit", function(event){
            var ders_id = $("#ders_id").val();
            event.preventDefault();
            $.ajax({  
                url:"insert_orta_baha.php",  
                method:"POST",
                data:$('#insert_form').serialize(),
                beforeSend:function(){
                    $('#insert').val("Goşulýar");
                },
                success:function(data){
                    //alert(data);
                    $('#insert_form')[0].reset();
                    $('#addModal').modal('hide');
                    $('#e-zhurnal'+ders_id).html(data);
                }
            });
        });
    </script>
</html>
