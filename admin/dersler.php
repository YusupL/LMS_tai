<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dersler</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php include "header.php"; ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dersler</h1>
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
              <div class="card-body p-0 table-responsive">
                <table class="table table-head-fixed" id="dersler">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Dersiň ady</th>
                      <th>Dersiň görnüşi</th>
                      <th>Okadýan mugallym</th>
                      <th>Okaýan toparça</th>
                      <th>Sagat sany</th>
                      <th>Amal</th>
                    </tr>
                  </thead>
                    <tbody>
                    <?php
                      include "dbcon.php";
                      $query_dersler=mysqli_query($con, "SELECT ders_maglumat.id AS ders_maglumat_id, ders_atlary.ady AS ders_ady, ders_maglumat.sagat_sany, mugallymlar.familiyasy, mugallymlar.ady, ders_gornushi.ady AS ders_gornushi_ady FROM ders_maglumat, mugallymlar, ders_gornushi, ders_atlary WHERE ders_maglumat.mug_id=mugallymlar.id AND ders_gornushi.id=ders_maglumat.gornushi AND ders_atlary.id=ders_maglumat.ders_id" );
                      while ($row_dersler=mysqli_fetch_array($query_dersler)){
                        $ders_maglumat_id=$row_dersler['ders_maglumat_id'];
                        $query_toparchalar=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM toparchalar, hunarler, ders_potok WHERE hunarler.id=toparchalar.hunar AND ders_potok.toparcha_id=toparchalar.id AND ders_maglumat_id='$ders_maglumat_id'");
                        $toparchalar="";
                        while($row_toparchalar=mysqli_fetch_array($query_toparchalar)){
                          $toparchalar=$toparchalar." ".$row_toparchalar['gysga_ady']."".$row_toparchalar['yyl']."0".$row_toparchalar['toparcha'];
                        }
                        ?>
                        <tr>
                          <td><?php echo $row_dersler['ders_maglumat_id']; ?></td>
                          <td><?php echo $row_dersler['ders_ady']; ?></td>
                          <td><?php echo $row_dersler['ders_gornushi_ady']; ?></td>
                          <td><?php echo $row_dersler['familiyasy']." ".$row_dersler['ady']; ?></td>
                          <td><?php echo $toparchalar?></td>
                          <td><?php echo $row_dersler['sagat_sany']; ?></td>
                          <td><button data-id="edit<?php echo $ders_maglumat_id;?>"  data-toggle='modal' data-target='#EditModalDers' class='uytgetmek btn-sm btn-success'><i class='fas fa-edit'></i></button><button data-id="delete<?php echo $ders_maglumat_id;?>" class='ochurmek btn-sm btn-danger'><i class='fas fa-trash'></i></button></td>
                        </tr>
                      <?php }
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

  <!--Ders uytgedilyan yeri -->
  <div class="modal" id="EditModalDers" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Üýtgetmek</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="post" id="update_ders_form">
            <input type="hidden" name="id_ders" id="id_ders"><br>
            <label for="ders_ady_id">Ders ady</label>
            <select class="custom-select d-block w-100" id="ders_ady_id" name="ders_ady_id" required>
              <?php
              include 'dbconnection.php';
              $query_ders_ady=mysqli_query($con, "SELECT * FROM ders_atlary ORDER BY ady");
              while ($row_ders_ady=mysqli_fetch_array($query_ders_ady)) {?>
              <option value="<?php echo $row_ders_ady['id']; ?>"><?php echo $row_ders_ady['ady']; ?></option>
              <?php 
              }
              ?>
              </select>
              <br>
              <label for="ders_gornushi">Görnüşi</label>
              <select class="custom-select d-block w-100" id="ders_gornushi" name="ders_gornushi" required>
                <option value="1">Umumy</option>
                <option value="2">Tejribe</option>
                <option value="3">Amaly</option>
                <option value="4">Söhbet</option>
                <option value="4">Özbaşdak iş</option>
              </select>
              <br>
              <label for="mug">Mugallymyň familiýasy, ady we atasynyň ady</label>
              <select class="custom-select d-block w-100" id="mug" name="mug" required>
                <?php
                $query_mug=mysqli_query($con, "SELECT * FROM mugallymlar ORDER BY familiyasy");
                while ($row_mug=mysqli_fetch_array($query_mug)) {?>
                <option value="<?php echo $row_mug['id']; ?>"><?php echo $row_mug['familiyasy']." ".$row_mug['ady']." ".$row_mug['atasynyn_ady']; ?></option>
                <?php 
                }
                ?>
                </select>
                <br>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="hunar">Hünäri</label>
                    <input name="hunar" type="text" class="form-control" id="hunar">
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
                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="sagat_sany">Sagat sany</label>
                    <input id="sagat_sany" name="sagat_sany" type="number" class="form-control">
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="arjem">Ar. jem</label>
                    <input name="arjem" type="number" min="0" max="1" class="form-control" id="arjem">
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="synagd">Synag</label>
                    <input name="synagd" type="number" min="0" max="1" class="form-control" id="synagd">
                  </div>
                </div>
                <br>
                <input type="submit" name="update_ders" id="update_ders" value="Üýtgetmek" class="btn btn-success" />
              </form>
            </div>
          </div>
        </div>
      </div>
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

<script>
$(document).ready(function(){
  $(document).on('click', '.uytgetmek', function(){
    var id = $(this).attr("data-id");
      id=id.substring(4, id.length);
        $.ajax({
          url:"fetch_ders.php",
          method:"POST",
          data:{id:id},
          dataType:"json",
          success:function(data){
            $('#id_ders').val(data.id);
            $('#ders_ady_id').val(data.ders_ady_id);
            $('#ders_gornushi').val(data.ders_gornushi);
            $('#mug').val(data.mug_faa);
            $('#hunar').val(data.hunar_ady);
            $('#yyly').val(data.yyl);
            $('#topr').val(data.toparcha);
            $('#sagat_sany').val(data.sagat_sany);
            $('#arjem').val(data.arjem);
            $('#synagd').val(data.synagd);
            
            $('#insert').val("Update");
            // $('#EditModalDers').modal('show');
            $('#add_data_Modal').modal('show');
          }
        });  
      });  
      $('#update_ders_form').on("submit", function(event){
        event.preventDefault();
          {
            $.ajax({
              url:"update_ders.php",
              method:"POST",
              data:$('#update_ders_form').serialize(),
                beforeSend:function(){
                  $('#update_ders').val("Üýtgeýär");
                },
                success:function(data){
                  $('#update_ders_form')[0].reset();
                  $('#EditModalDers').modal('hide');
                  $('#dersler').html(data);
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

      var confirmalert = confirm("Sen razymy?");
      if (confirmalert == true) {
        // AJAX Request
        $.ajax({
          url: 'delete_ders.php',
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
</body>
</html>
