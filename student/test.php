<?php
    date_default_timezone_set("Asia/Ashgabat");
    $bashlan_wagt=date("H:i:s");

    include '../dbconnection.php';
    include '../admin/functions.php';
    session_start();
    $id_ulanyjy=$_SESSION['id'];
    $id_talyp=$_SESSION['id_talyp'];

    $ders_id=$_POST['ders_id'];

    $yy=$_SESSION['yy'];
    $aj=$_SESSION['aj'];
    $ss=$_SESSION['ss'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Synaglar</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

     <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">
    
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    
    <style type="text/css">
        .jogap{
            min-height: 45px;
        }
        .jogap label{
            font-size: 18px;
            text-transform: none;
            padding-left: 10px;
            text-decoration: none;
        }
        .card_style{
            margin: 10px; 
            border: 1px solid #AEB6BF;
        }
        .header_style{
            background-color: #EBEDEF;
            font-size: 20px;
            font-family: Consola;
            border-bottom: 1px solid #AEB6BF;
        }
        .sorag_style{
            min-height: 180px;
            font-family: Palatino;
            font-size: 20px;
            color: #033466;
            border-right: 1px solid #AEB6BF;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
    <nav class="navbar navbar-default navbar-fixed">
        <?php
        $query=mysqli_query($con, "SELECT talyplar.familiyasy AS familiyasy, talyplar.ady AS ady, talyplar.atasynyn_ady AS atasynyn_ady, hunarler.gysga_ady AS hunar, toparchalar.yyl AS yyl, toparchalar.toparcha AS toparcha FROM talyplar, hunarler, toparchalar WHERE talyplar.toparcha=toparchalar.id AND toparchalar.hunar=hunarler.id AND talyplar.ulanyjy_id='$id_ulanyjy'");
        while ($row=mysqli_fetch_array($query)) {
            $familiya=$row['familiyasy'];
            $ady=$row['ady'];
            $aady=$row['atasynyn_ady'];
            $toparcha=$row['hunar'].$row['yyl']."0".$row['toparcha'];
        }
        ?>
        <div class="row">
            <div class="col-lg-4">
                <h3><b><?php echo $familiya." ".$ady." ".$aady ?></b></h3>
            </div>
            <div class="col-lg-2">
                <h3><?php echo $toparcha; ?></h3>
            </div>
            <div class="col-lg-6">
                <h3><?php echo $_POST['ders_ady']; ?></h3>
            </div>
        </div>
    </nav>
</div>
    <div class="content">
        <div class="container-fluid">
            <?php
                if(isset($_POST['sub_ders'])){
                    //pdf faylyn bardygyny kesgitleyat
                    $filename="../teacher/pdfler/".$aj."_".$ders_id.".pdf";

                    //testi soraglarynyn barygyny kesgitleyar
                    $query_test=mysqli_query($con, "SELECT testler.sorag, testler.jogap1, testler.jogap2, testler.jogap3, testler.jogap4, testler.aralyk_jem, testler_degishlilik.ders_id FROM testler, testler_degishlilik WHERE testler_degishlilik.test_id=testler.id AND testler_degishlilik.ders_id='$ders_id' AND testler.aralyk_jem='$aj'");
                    $count_test=mysqli_num_rows($query_test);

                    if (file_exists ($filename)){ ?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-9">
                                    <iframe  style="width: 100%; height: 800px;" name="" id="" src='<?php echo $filename;?>'></iframe>
                                </div>
                                <div class="col-lg-3">
                                    <div style="height: 800px; overflow: scroll;">
                                        <?php
                                        for ($i=1; $i<=$ss; $i++){?>
                                            <div class="row" style="font-size: 20px; border-bottom: 1px solid #30B113; margin: 0; margin-bottom: 10px;">
                                                <div class="col-lg-1 text-center" id="label_<?php echo $i ?>" style="color: #30B113; padding: 0;">
                                                    <label><?php echo $i; ?></label>
                                                </div>
                                                <div class="col-lg-11">
                                                    <div class="row">
                                                        <div class="col-lg-3"><label class="checkbox-inline">
                                                            a) <input type="radio" value="a" name="sorag<?php echo $i; ?>">
                                                        </label></div>
                                                        <div class="col-lg-3"><label class="checkbox-inline">
                                                            b)<input type="radio" value="b" name="sorag<?php echo $i; ?>">
                                                        </label></div>
                                                        <div class="col-lg-3"><label class="checkbox-inline">
                                                            c) <input type="radio" value="c" name="sorag<?php echo $i; ?>">
                                                        </label></div>
                                                        <div class="col-lg-3"><label class="checkbox-inline">
                                                            d) <input type="radio" value="d" name="sorag<?php echo $i; ?>">
                                                        </label></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <input type="hidden" name="" value="<?php echo $aj; ?>" id="aj">
                                        <input type="hidden" name="" value="<?php echo $id_talyp; ?>" id="id_talyp">
                                        <input type="hidden" name="" value="<?php echo $bashlan_wagt; ?>" id="bashlan_wagt">
                                        <input type="hidden" name="" value="<?php echo $ders_id; ?>" id="ders_id">

                                        <button id="tass_jop" class="form-control btn-info" style="background-color: #9CFB22; border: 1px solid green; font-weight: bold;" type="submit" name="">Tassyklamak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php                        
                    }
                    
                    else if ($count_test>=$ss){
                        $i=0;
                        while ($row_test=mysqli_fetch_array($query_test)) {
                            $i++;
                            $ques_ans[$i][1]=deshifr_kichi($row_test['sorag']);
                            $ques_ans[$i][2]=deshifr_kichi($row_test['jogap1']);
                            $ques_ans[$i][3]=deshifr_kichi($row_test['jogap2']);
                            $ques_ans[$i][4]=deshifr_kichi($row_test['jogap3']);
                            $ques_ans[$i][5]=deshifr_kichi($row_test['jogap4']);
                        }
                        echo "<br>";
                        $ques = range(1, $ss);
                        shuffle($ques);
                        $i=0;
                        foreach ($ques as $ques_num) {
                            $i++;
                            $rand[$i][1]=$ques_num;
                            $ans = range(1, 4);
                            shuffle($ans);
                            $j=1;
                            foreach ($ans as $ans_num) {
                                $j++;
                                $rand[$i][$j]=$ans_num;
                            }
                        }
                        $b_j="";
                        $t_s="";
                        for ($i=1; $i<=$ss; $i++){
                            $sorag=$ques_ans[$rand[$i][1]][1]; $t_s.=$rand[$i][1]."-";
                            $jogap1=$ques_ans[$rand[$i][1]][$rand[$i][2]+1]; if ($rand[$i][2]==1) $b_j.='a';
                            $jogap2=$ques_ans[$rand[$i][1]][$rand[$i][3]+1]; if ($rand[$i][3]==1) $b_j.='b';
                            $jogap3=$ques_ans[$rand[$i][1]][$rand[$i][4]+1]; if ($rand[$i][4]==1) $b_j.='c';
                            $jogap4=$ques_ans[$rand[$i][1]][$rand[$i][5]+1]; if ($rand[$i][5]==1) $b_j.='d';
                            ?>
                            <div class="row card card_style">
                                <div class="card-header text-center header_style" id="sorag_<?php echo $i; ?>"><?php echo $i; ?>-nji(y) sorag</div>
                                <div class="col-lg-5 text-justify sorag_style"><?php echo $sorag; ?></div>
                                <div class="col-lg-7">
                                    <div class="jogap"><input id="<?php echo $ders_id ?>_<?php echo $i; ?>_a" type="radio" value="a" name="test_sorag<?php echo $i; ?>"><label for="<?php echo $ders_id ?>_<?php echo $i; ?>_a"><?php echo $jogap1; ?></label></div>

                                    <div class="jogap"><input id="<?php echo $ders_id ?>_<?php echo $i; ?>_b" type="radio" value="b" name="test_sorag<?php echo $i; ?>"><label for="<?php echo $ders_id ?>_<?php echo $i; ?>_b"><?php echo $jogap2; ?></label></div>

                                    <div class="jogap"><input id="<?php echo $ders_id ?>_<?php echo $i; ?>_c" type="radio" value="c" name="test_sorag<?php echo $i; ?>"><label for="<?php echo $ders_id ?>_<?php echo $i; ?>_c"><?php echo $jogap3; ?></label></div>

                                    <div class="jogap"><input id="<?php echo $ders_id ?>_<?php echo $i; ?>_d" type="radio" value="d" name="test_sorag<?php echo $i; ?>"><label for="<?php echo $ders_id ?>_<?php echo $i; ?>_d"><?php echo $jogap4;?></label></div>
                                </div>
                            </div>
                            <?php
                        }
                        //echo $t_s;
                        //echo $b_j;?>
                        <input type="hidden" name="" value="<?php echo $aj; ?>" id="aj">
                        <input type="hidden" name="" value="<?php echo $id_talyp; ?>" id="id_talyp">
                        <input type="hidden" name="" value="<?php echo $bashlan_wagt; ?>" id="bashlan_wagt">
                        <input type="hidden" name="" value="<?php echo $ders_id; ?>" id="ders_id">
                        <input type="hidden" name="" value="<?php echo $t_s; ?>" id="t_s">
                        <input type="hidden" name="" value="<?php echo $b_j; ?>" id="b_j">

                        <button id="tass_jop_pdf" class="form-control btn-info" style="background-color: #9CFB22; border: 1px solid green; font-weight: bold;" type="submit" name="">Tassyklamak</button>
                        <?php
                    }
                    else echo "Testler tapylmady";
                }
                
                else echo "basylmady";
            ?>
        </div>
    </div>
</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <script type="text/javascript">
        var jogaplar=[];
        for ($j=1; $j<=<?php echo $ss; ?>; $j++) jogaplar[$j]='0';

            $('input:radio').on('change',function() {
                var name=$(this).attr('name');
                name=name.substring(5, name.length);
                jogaplar[name]=$('input[name=sorag'+name+']:checked').val();
                //alert(jogaplar[name]);
                $("#label_"+name).css('background-color', '#30B113');
                $("#label_"+name).css('color', 'white');
                $( "input[name=sorag"+name+"]").attr( "disabled", "disabled" );
            });
        $(document).on('click', '#tass_jop', function(){
            var jogap='';
            var aralyk_jemleme=$("#aj").val();
            var id_talyp=$("#id_talyp").val();
            var ders_id=$("#ders_id").val();
            var bashlan_wagt=$("#bashlan_wagt").val();

            for ($j=1; $j<=<?php echo $ss; ?>; $j++) jogap+=jogaplar[$j];
                $.ajax({  
                    url:"add_pdf_jog.php",  
                    method:"POST",  
                    data:{jogap:jogap, aralyk_jemleme: aralyk_jemleme, id_talyp:id_talyp, bashlan_wagt:bashlan_wagt, ders_id: ders_id},
                    dataType:"html",  
                    success:function(data){
                        //alert(data);
                        window.location.href='exams.php'
                    }  
               });
          });
    </script>
    <script type="text/javascript">
        var jogaplar_test=[];
        for ($j=1; $j<=<?php echo $ss; ?>; $j++) jogaplar_test[$j]='0';

            $('input:radio').on('change',function() {
                var name=$(this).attr('name');
                name=name.substring(10, name.length);
                jogaplar_test[name]=$('input[name=test_sorag'+name+']:checked').val();
                $("#sorag_"+name).css('background-color', '#30B113');
                $("#sorag_"+name).css('color', 'white');
                $( "input[name=test_sorag"+name+"]").attr( "disabled", "disabled" );
            });

        $(document).on('click', '#tass_jop_pdf', function(){
            var jogap='';
            var aralyk_jemleme=$("#aj").val();
            var id_talyp=$("#id_talyp").val();
            var ders_id=$("#ders_id").val();
            var bashlan_wagt=$("#bashlan_wagt").val();
            var t_s=$("#t_s").val();
            var b_j=$("#b_j").val();

            for ($j=1; $j<=<?php echo $ss; ?>; $j++) jogap+=jogaplar_test[$j];
                $.ajax({  
                    url:"add_test_jog.php",  
                    method:"POST",  
                    data:{jogap:jogap, aralyk_jemleme: aralyk_jemleme, id_talyp:id_talyp, bashlan_wagt:bashlan_wagt, ders_id: ders_id, t_s:t_s, b_j:b_j},
                    dataType:"html",  
                    success:function(data){
                        window.location.href='exams.php'
                    }  
               });
          });
    </script>
</html>
