<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ulanyjylar</title>
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
          <div class="col-12">
            <div class="card">
              <div class="card-body p-0">
                <table class="table table-head-fixed text-nowrap" id="ulanyjylar">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>TID</th>
                      <th>Familiýasy</th>
                      <th>Ady</th>
                      <th>Atasynyň atasy</th>
                      <th>Hünäri</th>
                      <th>Login</th>
                      <th>Parol</th>
                      <th>Amal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include "dbcon.php";
                      $query=mysqli_query($con,"select * from ulanyjylar");
                        while ($row=mysqli_fetch_array($query)){
                          $id=$row['id'];
                          $pass=deshifr($row['parol']);
                          if ($row['ulanyjy_tipi']==1){
                            $query_talyp=mysqli_query($con,"select * from talyplar WHERE ulanyjy_id='$id'");
                            while ($row_talyp=mysqli_fetch_array($query_talyp)) {
                              $id_talyp=$row_talyp['id'];


                              $query_toparcha=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar, talyplar WHERE hunarler.id=toparchalar.hunar and talyplar.toparcha=toparchalar.id and talyplar.id='$id_talyp'");
                              while ($row_toparcha=mysqli_fetch_array($query_toparcha)) {
                                $gysga_ady=$row_toparcha['gysga_ady'];
                                $yyl=$row_toparcha['yyl'];
                                $toparcha=$row_toparcha['toparcha'];
                                $gysga_ady=$gysga_ady." ".$yyl."0".$toparcha;
                              }

                              echo "<tr>
                                      <td>".$id."</td>
                                      <td>".$id_talyp."</td>
                                      <td>".$row_talyp['familiyasy']."</td>
                                      <td>".$row_talyp['ady']."</td>
                                      <td>".$row_talyp['atasynyn_ady']."</td>
                                      <td>".$gysga_ady."</td>
                                      <td>".$row['login']."</td>
                                      <td>".$pass."</td>
                                      <td><button data-id=".$id."edit  data-toggle='modal' data-target='#EditModalTalyp' class='uytgetmek btn-sm btn-success'><i class='fas fa-edit'></i></button><button data-id=".$id." class='ochurmek btn-sm btn-danger'><i class='fas fa-trash'></i></button></td>
                                    </tr>";
                            }
                          }

                          if ($row['ulanyjy_tipi']==2){
                            $query_mugallym=mysqli_query($con,"select * from mugallymlar WHERE ulanyjy_id='$id'");
                            
                            while ($row_mugallym=mysqli_fetch_array($query_mugallym)) {
                              $id_kafedra=$row_mugallym['kafedra'];
                              $query_kafedra=mysqli_query($con, "SELECT gysga_ady FROM kafedralar WHERE id='$id_kafedra' ");
                              while ($row_kafedra=mysqli_fetch_array($query_kafedra)) {
                                $gysga_ady=$row_kafedra['gysga_ady'];                                
                              }

                              echo "<tr>
                                      <td>".$id."</td>
                                      <td>".Null."</td>
                                      <td>".$row_mugallym['familiyasy']."</td>
                                      <td>".$row_mugallym['ady']."</td>
                                      <td>".$row_mugallym['atasynyn_ady']."</td>
                                      <td>".$gysga_ady."</td>
                                      <td>".$row['login']."</td>
                                      <td>".$pass."</td>
                                      <td><button data-id=".$id."edit  data-toggle='modal' data-target='#EditModalMugallym' class='uytgetmek btn-sm btn-success'><i class='fas fa-edit'></i></button><button data-id=".$id." class='ochurmek btn-sm btn-danger'><i class='fas fa-trash'></i></button></td>
                                    </tr>";
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
