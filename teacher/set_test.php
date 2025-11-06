<?php
    include '../dbconnection.php';
    include '../admin/functions.php';
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

	<title>Test sazlamalar</title>

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

        <div class="content"><br>
            <div class="card" style="background-color: #EAECEE; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="card-header" style="background-color: #FCF5BA;">
                    <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; font-family: Georgia; padding: 7px;">Test sazlamalar</h3>
                </div>

                <div class="card-body">
                    <div class="container-fluid">
                        <div class="panel-group" id="sapak" style="margin-top: 10px;">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a data-toggle="collapse" style="font-size: 20px;" data-parent="#sapak" href="#sapak1">
                                    Garyşyk görnüşli testler</a>
                                    </h4>
                                </div>
                                <div id="sapak1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="container-fluid">
                                            <table class="setting_test_table" id="testler">
                                                <tr>
                                                    <th style="width: 1%;">T/B</th>
                                                    <th style="width: 37%;">Sorag</th>
                                                    <th style="width: 12.5%;">Dogry jogap</th>
                                                    <th style="width: 12.5%;">Ýalňyş jogap</th>
                                                    <th style="width: 12.5%;">Ýalňyş jogap</th>
                                                    <th style="width: 12.5%;">Ýalňyş jogap</th>
                                                    <th style="width: 8%">Toparçalar</th>
                                                    <th style="width: 8%">Amal</th>
                                                </tr>
                                                <?php
                                                    $query_test=mysqli_query($con, "SELECT testler_degishlilik.id, testler.id AS id_test, testler.sorag, testler.jogap1, testler.jogap2, testler.jogap3, testler.jogap4 FROM testler, mugallymlar, ders_maglumat, testler_degishlilik WHERE mugallymlar.ulanyjy_id='$id_ulanyjy' AND (testler.aralyk_jem='$adaty_aj' OR testler.aralyk_jem='$bakalawr_aj' OR testler.aralyk_jem='$pod_aj') AND mugallymlar.id=ders_maglumat.mug_id AND ders_maglumat.id=testler_degishlilik.ders_id AND testler_degishlilik.test_id=testler.id GROUP BY testler.id");
                                                    $tb=0;
                                                    while ( $row_test=mysqli_fetch_array($query_test)) {
                                                        $tb++;
                                                        $id_test=$row_test['id_test']; ?>
                                                    <tr>
                                                        <td><?php echo $tb;?></td>
                                                        <td><?php echo deshifr_kichi($row_test['sorag']); ?></td>
                                                        <td><?php echo deshifr_kichi($row_test['jogap1']); ?></td>
                                                        <td><?php echo deshifr_kichi($row_test['jogap2']); ?></td>
                                                        <td><?php echo deshifr_kichi($row_test['jogap3']); ?></td>
                                                        <td><?php echo deshifr_kichi($row_test['jogap4']); ?></td>
                                                        <td>
                                                            <?php 
                                                            $query_toparcha=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar, ders_maglumat, testler_degishlilik WHERE testler_degishlilik.test_id='$id_test' AND hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.id=testler_degishlilik.ders_id");

                                                                while ($row_toparcha=mysqli_fetch_array($query_toparcha)) {
                                                                    echo $row_toparcha['gysga_ady'].$row_toparcha['yyl']."0".$row_toparcha['toparcha']." ";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><div><button data-id="edit<?php echo $id_test;?>"  data-toggle='modal' data-target='#EditModalTest' class='uytgetmek'><i class="fas fa-edit"></i></button><br><button data-id="delete<?php echo $id_test;?>" class='ochurmek'><i class="fas fa-trash-alt"></i></button></div></td>
                                                    </tr>
                                                    <?php
                                                    }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#sapak" href="#sapak2" style="font-size: 20px;">
                                        PDF görnüşli testler <span class="text-muted"></span></a>
                                    </h4>
                                </div>
                                <div id="sapak2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="container-fluid">
                                            <table class="setting_test_table">
                                                <tr>
                                                    <th style="width: 50%;">Jogap açarlary çalyşmak</th>
                                                    <th style="width: 30%;">Dersiň ady</th>
                                                    <th style="width: 15%;">Toparça</th>
                                                    <th style="width: 5%">Öçürmek</th>
                                                </tr>
                                                <?php 
                                                    $query=mysqli_query($con, "SELECT ders_maglumat.id AS ders_id, hunarler.gornushi AS hunar_gor, hunarler.gysga_ady AS hunar_gysga_ady, toparchalar.yyl, toparchalar.toparcha, ders_atlary.ady AS ders_ady FROM hunarler, toparchalar, ders_maglumat, mugallymlar, ders_atlary WHERE hunarler.id=toparchalar.hunar AND mugallymlar.id=ders_maglumat.mug_id AND ders_atlary.id=ders_maglumat.ders_id AND ders_maglumat.toparcha_id=toparchalar.id AND mugallymlar.ulanyjy_id='$id_ulanyjy'");
                                                    while ($row=mysqli_fetch_array($query)) {
                                                        $ders_id=$row['ders_id'];
                                                        $hunar_gor=$row['hunar_gor'];
                                                        $hunar_gysga_ady=$row['hunar_gysga_ady'];
                                                        $yyl=$row['yyl'];
                                                        $toparcha=$row['toparcha'];
                                                        $ders_ady=$row['ders_ady'];
                                                        if ($hunar_gor=='1') { $aj=$adaty_aj; $ss=$adaty_ss;}
                                                        if ($hunar_gor=='2') { $aj=$bakalawr_aj; $ss=$bakalawr_ss;}
                                                        if ($hunar_gor=='3') { $aj=$pod_aj; $ss=$pod_ss;}
                                                        $file_name="pdfler/".$aj."_".$ders_id.".pdf";
                                                        if (file_exists($file_name)){ ?>
                                                            <tr>
                                                                <td>
                                                                    <form method="POST" action="jogap_achar_tazelemek.php" class="update_ans">
                                                                        <input type="hidden" name="ders_id" value="<?php echo $ders_id; ?>">
                                                                        <input type="hidden" name="ss" value="<?php echo $ss; ?>">
                                                                        <input type="hidden" name="aj" value="<?php echo $aj; ?>">
                                                                        <div class="row"><?php
                                                                            for ($j=1; $j<=$ss; $j++){?>
                                                                                <div class="jogap_achar_selektor">
                                                                                <?php echo $j; ?>) <select class="form-control" name="jogap<?php echo $j; ?>">
                                                                                    <option>a</option>
                                                                                    <option>b</option>
                                                                                    <option>c</option>
                                                                                    <option>d</option>
                                                                                </select>
                                                                                </div> <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <br><div><input value="Tassyklamak" type="submit" class="btn btn-info jogap_achar_taz" name="jogap_achar_taz"></div>
                                                                    </form>
                                                                </td>
                                                                <td><?php echo $ders_ady; ?></td>
                                                                <td><?php echo $hunar_gysga_ady.$yyl."0".$toparcha; ?></td>
                                                                <td><button data-id="pdfler/<?php echo $aj."_".$ders_id;?>.pdf" class='ochurmek_pdf'><i class="fas fa-trash-alt"></i></button>
                                                                    <div class="loader" style="display: none;">
                                                                        <img src="745.gif">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</div>

<!--Test uytgedilyan yeri -->
<div class="modal" id="EditModalTest" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Testi üýtgetmek</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" id="update_test_form">
                    <input type="hidden" name="id_test" id="id_test"><br>
                    <label for="sorag">Sorag</label><br>
                    <textarea id="sorag" name="sorag" style='width: 100%; height: 120px;'></textarea><br>
                    <label for="jogap_1">Dogry jogap</label><input type="text" name="jogap_1" id="jogap_1" style="width: 100%;"><br>
                    <label for="jogap_2">Ýalňyş jogap</label><input type="text" name="jogap_2" id="jogap_2" style="width: 100%;"><br>
                    <label for="jogap_3">Ýalňyş jogap</label><input type="text" name="jogap_3" id="jogap_3" style="width: 100%;"><br>
                    <label for="jogap_4">Ýalňyş jogap</label><input type="text" name="jogap_4" id="jogap_4" style="width: 100%;">
                    <br><br><input type="submit" name="update_test" id="update_test" value="Üýtgetmek" class="btn btn-success" />
                </form>
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
            $(document).on('click', '.uytgetmek', function(){
                var id = $(this).attr("data-id");
                id=id.substring(4, id.length);
                $.ajax({
                    url:"fetch_test.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"json",
                    success:function(data){
                        $('#id_test').val(data.id);
                        $('#sorag').val(data.sorag);
                        $('#jogap_1').val(data.jogap1);
                        $('#jogap_2').val(data.jogap2);
                        $('#jogap_3').val(data.jogap3);
                        $('#jogap_4').val(data.jogap4);
                        
                        $('#insert').val("Update");
                        $('#add_data_Modal').modal('show');
                    }
                });
            });
            $('#update_test_form').on("submit", function(event){
                event.preventDefault();
                {
                    $.ajax({
                    url:"update_test.php",
                    method:"POST",
                    data:$('#update_test_form').serialize(),
                    beforeSend:function(){
                        //$('#update_test').val("Üýtgeýär");
                    },
                    success:function(data){
                        $('#update_test_form')[0].reset();
                        $('#EditModalTest').modal('hide');
                        $('#testler').html(data);
                    }
                });
                }
            });
        }); 
    </script>

<script type="text/javascript">
    $(document).ready(function(){
        // Delete 
        $('.ochurmek').click(function(){
            var el = this;
            var deleteid = $(this).data('id');
            deleteid=deleteid.substring(6, deleteid.length);
            var confirmalert = confirm("Siz bu testi öçürmekçimi?");

            if (confirmalert == true) {
                // AJAX Request
                $.ajax({
                    url: 'delete_test.php',
                    type: 'POST',
                    data: { id: deleteid },
                    success: function(response){
                        if(response == 1){
                            //Remove row from HTML Table
                            $(el).closest('tr').css('background','tomato');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                            });
                        }else{
                            alert('Invalid ID.');
                        }
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        // Delete 
        $('.ochurmek_pdf').click(function(){
            var el = this;
            var deleteid = $(this).data('id');
            
            var confirmalert = confirm("Siz bu faýly öçürmekçimi?");

            if (confirmalert == true) {
                // AJAX Request
                $.ajax({
                    url: 'delete_pdf.php',
                    type: 'POST',
                    data: { id: deleteid },

                    beforeSend:function(){
                        $('.loader').show();
                    },
                    success: function(response){
                        if(response == 1){
                            $('.loader').hide();
                            location.reload();     
                        }else{
                            alert('Invalid ID.');
                        }
                    }
                });
            }
        });
    });
</script>
</html>
