<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ulanyjylaryň girişi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php 
    include "header.php"; 
    include "functions.php";
  ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ulanyjylar</h1>
          </div>          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">            
        <div class="row">
          <div class="col-md-9">
            <!-- general form elements disabled -->
            <div class="card card-warning">              
              <div class="card-body">
                <form method="POST">
                  <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Başlangyç sene</label>
                        <input type="date" class="form-control" name="bashy">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Gutarýan sene</label>
                        <input type="date" class="form-control" name="ahyry">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Gutarýan sene</label>
                        <button type="submit" class="btn btn-block btn-primary" name="tass">Tassykla</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <?php 
            if(isset($_POST['tass'])){
              $bashy=$_POST['bashy'];
              $ahyry=$_POST['ahyry'];
              $gun=strtotime($ahyry)-strtotime($bashy);
              $gun=$gun/(60*60*24);
              //$gun=$gun-intdiv($gun-7);
              $gun=round(6/7*$gun);
              echo $gun;
              $gun=$gun-14;
              include "dbcon.php";
              $qusers=mysqli_query($con,"SELECT * FROM ulanyjylar");
              $usan=mysqli_num_rows($qusers)-300;
              $query=mysqli_query($con,"select * from user_girish WHERE wagt>='$bashy' AND wagt<='$ahyry' ORDER BY wagt DESC");              
              $sany=mysqli_num_rows($query);                  
          ?>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Bellenilen aralykda giren ulanyjylaryň sany</span>
                <span class="info-box-number"><?=$sany?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-plus"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ortaça giriş sany</span>
                <span class="info-box-number"><?=round($sany/$gun,2)?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-body p-0">                
                <table class="table table-head-fixed text-nowrap" id="ulanyjylar">
                  <thead>
                    <tr>
                      <th>T/b</th>                      
                      <th>Familiýasy we ady</th>
                      <th>Ulanyjy görnüşi</th>
                      <th>Fakulteti</th>
                      <th>Toparçasy/Kafedrasy</th>
                      <th>Giren senesi we wagty</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $i=0;                      
                        while ($row=mysqli_fetch_array($query)){
                          $i++;
                          $id_ulanyjy=$row['id_ulanyjy'];
                          $id=$row['id'];
                          $query2=mysqli_query($con,"select * from ulanyjylar WHERE id='$id_ulanyjy'");
                          $row2=mysqli_fetch_array($query2);
                          $ulanyjy_tipi=$row2['ulanyjy_tipi'];
                          if ($ulanyjy_tipi==1){
                            $query_talyp=mysqli_query($con,"SELECT talyplar.familiyasy, talyplar.ady As tal_ady, fakultetler.ady AS fak_ady, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, user_girish.wagt FROM user_girish, ulanyjylar, hunarler, toparchalar, talyplar, fakultetler WHERE hunarler.id=toparchalar.hunar and talyplar.toparcha=toparchalar.id and hunarler.fakultet=fakultetler.id AND ulanyjylar.id=talyplar.ulanyjy_id AND user_girish.id_ulanyjy=ulanyjylar.id AND ulanyjylar.ulanyjy_tipi='1' AND ulanyjylar.id='$id_ulanyjy' AND user_girish.id='$id' ORDER BY toparchalar.id");
                            if(mysqli_num_rows($query_talyp)>0){
                              $row_talyp=mysqli_fetch_array($query_talyp);
                              $fam_ady=$row_talyp['familiyasy']." ".$row_talyp['tal_ady'];
                              $ulan_gor="Talyp";
                              $fak_ady=$row_talyp['fak_ady'];
                              $toparchasy=$row_talyp['gysga_ady']."-".$row_talyp['yyl']."0".$row_talyp['toparcha'];
                              $wagt=$row_talyp['wagt'];
                            }
                            ?>        
                                    <tr>
                                      <td><?=$i?></td>
                                      <td><?=$fam_ady?></td>
                                      <td><?=$ulan_gor?></td>
                                      <td><?=$fak_ady?></td>
                                      <td><?=$toparchasy?></td>
                                      <td><?=$wagt?></td>
                                    </tr>
                            <?php
                            }
                          if ($ulanyjy_tipi==2){
                            $query_mugallym=mysqli_query($con,"SELECT mugallymlar.familiyasy, mugallymlar.ady AS mug_ady, fakultetler.ady AS fak_ady, kafedralar.ady AS kaf_ady, user_girish.wagt FROM mugallymlar, fakultetler, kafedralar, user_girish, ulanyjylar WHERE ulanyjylar.id=mugallymlar.ulanyjy_id AND kafedralar.fakultet=fakultetler.id AND user_girish.id_ulanyjy=ulanyjylar.id AND mugallymlar.kafedra=kafedralar.id AND ulanyjylar.ulanyjy_tipi='2' AND ulanyjylar.id='$id_ulanyjy' AND user_girish.id='$id';");
                            if (mysqli_num_rows($query_mugallym)>0){
                              $row_mugallym=mysqli_fetch_array($query_mugallym);
                              $fam_ady=$row_mugallym['familiyasy']." ".$row_mugallym['mug_ady'];
                              $ulan_gor="Mugallym";
                              $fak_ady=$row_mugallym['fak_ady'];
                              $kaf_ady=$row_mugallym['kaf_ady'];
                              $wagt=$row_mugallym['wagt'];
                          ?>
                              <tr>
                                <td><?=$i?></td>
                                <td><?=$fam_ady?></td>
                                <td><?=$ulan_gor?></td>
                                <td><?=$fak_ady?></td>
                                <td><?=$kaf_ady?></td>
                                <td><?=$wagt?></td>
                              </tr>
                          <?php
                            }
                          }
                        }
                    ?>
                  </tbody>
                </table>                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <?php
            }
          ?>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--Edit modal Talyp-->
    <div class="modal" id="EditModalTalyp" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Üýtgetmek</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form method="post" id="update_talyp_form">
                    <input type="hidden" name="id_talyp" id="id_talyp"><br>
                    <label for="famt">Familiýasy</label>
                    <input type="text" class="form-control" id="famt" name="famt" placeholder="" value="" required>
                    <br>

                    <label for="adyt">Ady</label>
                    <input type="text" class="form-control" id="adyt" name="adyt" placeholder="" value="" required>
                    <br>

                    <label for="aadyt">Atasynyň ady</label>
                    <input type="text" class="form-control" id="aadyt" name="aadyt" placeholder="" value="" required>
                    <br>

                    <div class="row">
                      

                      <div class="col-md-3 mb-3">
                        <label for="thunar">Hünäri</label>
                        <input name="thunar" type="text" class="form-control" id="thunar">
                      </div>

                      <div class="col-md-3 mb-3">
                        <label for="yyly">Ýyly</label>
                          <select class="custom-select d-block w-100" id="yyly" name="yyly" required>
                            <option value="1" selected="selected">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                      </div>

                      <div class="col-md-3 mb-3">
                        <label for="topr">Toparça</label>
                          <select class="custom-select d-block w-100" id="topr" name="topr" required>
                            <option value="1" selected="selected">1</option>
                            <option value="2">2</option>
                          </select>
                      </div>
                    </div>
                    <label for="loginn">Login</label>
                      <input id="loginn" name="loginn" type="text" class="form-control">
                    <label for="demo">Açar</label>
                      <input id="demo" name="demo" type="text" class="form-control"><br>

                      <input type="submit" name="update_talyp" id="update_talyp" value="Üýtgetmek" class="btn btn-success" />
                  </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Edit modal Talyp-->
    <div class="modal" id="EditModalMugallym" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Üýtgetmek</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form method="post" id="update_mugallym_form">
                    <input type="hidden" name="id_mugallym" id="id_mugallym"><br>
                    <label for="famm">Familiýasy</label>
                    <input type="text" class="form-control" id="famm" name="famm" placeholder="" value="" required>
                    <br>

                    <label for="adym">Ady</label>
                    <input type="text" class="form-control" id="adym" name="adym" placeholder="" value="" required>
                    <br>

                    <label for="aadym">Atasynyň ady</label>
                    <input type="text" class="form-control" id="aadym" name="aadym" placeholder="" value="" required>
                    <br>

                    <div>
                        <label for="kafedra">Kafedra</label>
                        	<select class="custom-select d-block w-100" id="kafedra" name="kafedra" required>
                            	<?php
                            		$query_kafedra=mysqli_query($con, "SELECT * FROM kafedralar");
                            		while ($row_kafedra=mysqli_fetch_array($query_kafedra)) {
                            			?> <option value="<?php echo $row_kafedra['id'];?>"><?php echo $row_kafedra['ady'];?></option> 
                            			<?php
                            		}
                            	?>
                          	</select>
                    </div>

                    <label for="loginm">Login</label>
                      <input id="loginm" name="loginm" type="text" class="form-control">
                    <label for="parolm">Parol</label>
                      <input id="parolm" name="parolm" type="text" class="form-control"><br>

                      <input type="submit" name="update_mugallym" id="update_mugallym" value="Üýtgetmek" class="btn btn-success" />
                  </form>
                </div>
            </div>
        </div>
    </div>


  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>TOHI</b>
    </div>
    <strong>Ähli hukuklar goralan &copy; <script>var x=new Date(); document.write(x.getFullYear());</script></strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script type="text/javascript" src="text/jquery.autocomplete.js"></script>
<script>
    $(document).ready(function(){ $("#thunar").autocomplete("autocomplete_hunar.php", { selectFirst: true }); });
</script>

<script type="text/javascript">
  $(document).ready(function(){

   // Delete 
  $('.ochurmek').click(function(){
      var el = this;

      var deleteid = $(this).data('id');
   
      var confirmalert = confirm("Sen razymy?");
      if (confirmalert == true) {
        // AJAX Request
        $.ajax({
          url: 'delete_user.php',
          type: 'POST',
          data: { id: deleteid },
          success: function(response){

          if(response == 1){
        // Remove row from HTML Table
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
<script>
$(document).ready(function(){
      $(document).on('click', '.uytgetmek', function(){  
           var id = $(this).attr("data-id");
           id=id.substring(0, id.length-4);
           $.ajax({  
                url:"fetch_talyp.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){
                    $('#id_talyp').val(data.id);
                    $('#adyt').val(data.ady);  
                    $('#famt').val(data.familiyasy);  
                    $('#aadyt').val(data.atasynyn_ady);
                    $('#thunar').val(data.hunar);
                    $('#yyly').val(data.yyl);
                    $('#topr').val(data.toparcha);
                    $('#loginn').val(data.login);
                    $('#demo').val(data.parol);
                    $('#insert').val("Update");  
                    $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#update_talyp_form').on("submit", function(event){ 
           event.preventDefault();
           {  
                $.ajax({  
                     url:"update_talyp.php",  
                     method:"POST",  
                     data:$('#update_talyp_form').serialize(),  
                     beforeSend:function(){  
                          $('#update_talyp').val("Üýtgeýär");  
                     },  
                     success:function(data){  
                          $('#update_talyp_form')[0].reset();  
                          $('#EditModalTalyp').modal('hide');  
                          $('#ulanyjylar').html(data);  
                     }  
                });  
           }  
      });  
 }); 
</script>

<script>
$(document).ready(function(){
      $(document).on('click', '.uytgetmek', function(){  
           var id = $(this).attr("data-id");
           id=id.substring(0, id.length-4);
           $.ajax({  
                url:"fetch_mugallym.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){
                    $('#id_mugallym').val(data.id);
                    $('#adym').val(data.ady);  
                    $('#famm').val(data.familiyasy);  
                    $('#aadym').val(data.atasynyn_ady);
                    $('#kafedra').val(data.id_kafedra);
                    $('#loginm').val(data.login);
                    $('#parolm').val(data.parol);
                    $('#insert').val("Update");  
                    $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#update_mugallym_form').on("submit", function(event){ 
           event.preventDefault();
           {  
                $.ajax({  
                     url:"update_mugallym.php",  
                     method:"POST",  
                     data:$('#update_mugallym_form').serialize(),  
                     beforeSend:function(){  
                          $('#update_mugallym').val("Üýtgeýär");  
                     },  
                     success:function(data){  
                          $('#update_mugallym_form')[0].reset();  
                          $('#EditModalMugallym').modal('hide');  
                          $('#ulanyjylar').html(data);  
                     }  
                });  
           }  
      });  
 }); 
</script>

</body>
</html>
