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

    <title>Çäklendirme</title>

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
                        include "../dbconnection.php";
                        $query=mysqli_query($con, "SELECT ulanyjy_id, ders_id, ders_ady, toparcha_id, hunar_ady, yyl, toparcha, hunar_gornushi FROM synag_sapaklar WHERE ulanyjy_id='$ulanyjy_id'");
                        while ($row=mysqli_fetch_array($query)) {?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#sapak" href="#sapak_<?php echo $row['ders_id']; ?>">
                                            <?php echo $row['ders_ady']; ?> <span class="text-muted"> (<?php echo $row['hunar_ady'].$row['yyl']."0".$row['toparcha']; ?>)</span></a>
                                    </h4>
                                </div>
                                <div id="sapak_<?php echo $row['ders_id']; ?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <?php 
                                            $gornush=$row['hunar_gornushi'];
                                            $query_gornush=mysqli_query($con, "SELECT * FROM synag_tapgyr WHERE gornush='$gornush'");
                                            while ($row_gornush=mysqli_fetch_array($query_gornush)) {
                                                $yy=$row_gornush['yarymyyllyk'];
                                                $aj=$row_gornush['aralyk_jemleme'];
                                                $ss=$row_gornush['sorag_sany'];
                                            }
                                        ?>
                                        <div class="container-fluid">
                                            <table class="table_restrictions">
                                                <thead>
                                                    <tr>
                                                        <th>№</th>        
                                                        <th>Familiýasy, ady</th>
                                                        <th><?php echo $aj; ?>-nji aralyk jemleme</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                    $toparcha_id=$row['toparcha_id'];
                                                    $query_talyp=mysqli_query($con, "SELECT * FROM talyplar WHERE toparcha='$toparcha_id'");
                                                    $i=0;
                                                    while ($row_talyp=mysqli_fetch_array($query_talyp)) { $i++; ?>
                                                             <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $row_talyp['familiyasy']." ".$row_talyp['ady']; ?></td>
                                                                <td>
                                                                    <?php
                                                                        $ders_id=$row['ders_id'];
                                                                        $talyp_id=$row_talyp['id'];
                                                                    ?>
                                                                    <label style="margin-left: 40%;"><input id="<?php echo $ders_id."-".$talyp_id."-".$aj; ?>" type="checkbox" value=""
                                                                        <?php
                                                                            //chaklendirilen uchin tick goymak
                                                                            $query_tick=mysqli_query($con, "SELECT id FROM chaklendirme WHERE talyp_id='$talyp_id' AND ders_id='$ders_id' AND aralyk_jemleme='$aj'");
                                                                            $sany=mysqli_num_rows($query_tick);
                                                                            if ($sany>0) echo "checked";
                                                                        ?>
                                                                        ></label>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
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
    
    <script type="text/javascript">
        $('input:checkbox').on('change',function() {
            var id=$(this).attr('id');
            ids=id.split('-');
            var ders_id=ids[0];
            var talyp_id=ids[1];
            var aj=ids[2];
            $.ajax({
                url:"chaklendirmek.php",
                method:"POST",
                data:{ders_id:ders_id, talyp_id:talyp_id, aj:aj},
                dataType:"html",  
                success:function(data){
                    //alert(data);
                }
            });
        });
    </script>>

</html>
