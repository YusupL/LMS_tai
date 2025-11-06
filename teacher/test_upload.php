<?php
if (isset($_POST['submit'])){
    $id_toparchalar=$_POST['id_toparchalar'];
    $count_id_t=count($id_toparchalar);
    
    $id_ulanyjy=$_POST['id_ulanyjy'];
    $hunar_ady=$_POST['hunar_ady'];
    $sapak_ady=$_POST['sapak_ady'];
    $yyl=$_POST['yyl'];
    $sorag_sany=$_POST['sorag_sany'];
    $aralyk_jemleme=$_POST['aralyk_jemleme'];

    include "../dbconnection.php";
    for ($i=0; $i<$count_id_t; $i++){
        $toparcha_id=$id_toparchalar[$i];
        $query=mysqli_query($con, "SELECT * FROM synag_sapaklar WHERE ulanyjy_id='$id_ulanyjy' AND ders_ady='$sapak_ady' AND toparcha_id='$toparcha_id'");
        while ($row=mysqli_fetch_array($query)) {
            $id_dersler[$i]=$row['ders_id'];
        }
    }
    $count_id_d=count($id_dersler);  
    
    }      
        
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Test ýüklemek</title>

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

    <div class="container-fluid">
        <h2 style="text-align: center;"><?php echo $sapak_ady; ?> dersinden pdf faýly we jogap açarlary</h2>
        <br>
        <div class="col-lg-5">
            <div class="container-fluid">
                <table class="setting_test_table">
                        <tr>
                            <th style="width: 85%;">Jogap açarlary</th>
                        </tr>
                        <tr>
                            <td>
                                
                                <form method="POST" action="jogap_achar_yuklemek.php">
                                    <div class="row">
                                        <div class="jogap_achar_selektor">
                                        <?php
                                            for ($i=0; $i < $sorag_sany; $i++) { ?> 
                                                <div class="jogap_achar_selektor">  
                                                    <?php echo $i+1;?> <select  class="form-control" name="jogap<?php echo ($i+1); ?>">
                                                        <option>a</option>
                                                        <option>b</option>
                                                        <option>c</option>
                                                        <option>d</option>
                                            </select>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="sorag_sany" value="<?php echo $sorag_sany; ?>">
                                    <?php 
                                        for ($i=0; $i<$count_id_d; $i++){
                                            ?> 
                                                <input type="hidden" name="id_dersler[]" value="<?php echo $id_dersler[$i]; ?>">
                                            <?php
                                        }
                                    ?>
                                    <input type="hidden" name="hunar_ady" value="<?php echo $hunar_ady; ?>">
                                    <input type="hidden" name="yyl" value="<?php echo $yyl; ?>">
                                    <input type="hidden" name="aralyk_jemleme" value="<?php echo $aralyk_jemleme; ?>">
                                    
                                    <br><div><button class="btn btn-info" name="sub_a">Tassyklamak</button></div>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        <div class="col-lg-7"><iframe  style="width: 100%; height: 800px;" name="" id="" src='<?php echo "pdfler/".$aralyk_jemleme."_".$id_dersler[0].".pdf" ?>'></iframe></div>
    </div>
</body>
<!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
</html>
