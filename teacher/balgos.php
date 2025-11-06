<?php
include '../dbconnection.php';
session_start();
$id_ulanyjy=$_SESSION['id'];
$qbolum=mysqli_query($con, "SELECT * FROM bolumler WHERE utipi='2'");
if (isset($_POST['tass'])){
  $bolumce_id=$_POST['bolumce'];
  $rbolumbal=mysqli_fetch_array(mysqli_query($con, "SELECT baly FROM bolumcheler WHERE id='$bolumce_id'"));
  $bolumbal=$rbolumbal['baly'];
  $sany=$_POST['sany'];
  $baly=$sany*$bolumbal;
  $sene=$_POST['sene'];
  $bellik=$_POST['bellik'];
  mysqli_query($con, "INSERT INTO ballar (ulanyjy_id, bolumche_id, sany, sene, bellik, baly) VALUES ('$id_ulanyjy', '$bolumce_id', '$sany', '$sene', '$bellik', '$baly')");
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bal goşmak</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">   
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> 
  <!-- Sidebar -->
  <link rel="stylesheet" href="../assets/dist/css/docs.css"> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <?php include 'navbar1.php'; ?>  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Hepde boýunça gazanylan ballar barada maglumat girizmek</h1>
          </div>          
        </div>        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Ball goşmak</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <form method="POST">
            <div class="row">
              <div class="col-sm-4">
                <!-- select -->
                <div class="form-group">
                  <label>Bölümi saýlaň</label>
                  <select class="form-control" name="bolum">
                    <option>...</option>
                    <?php while($rbolum=mysqli_fetch_array($qbolum)){ ?>
                    <option value="<?=$rbolum['id']?>"><?=$rbolum['ady']?></option>
                    <?php } ?>                   
                  </select>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label>Bölümçäni saýlaň</label>
                  <select class="form-control" id="bolumce" name="bolumce">                      
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-1">
                <div class="form-group">
                  <label>Sany</label>
                  <input type="number" class="form-control" name="sany">
                </div>                
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Senesi</label>
                  <input type="date" class="form-control" name="sene">
                </div>                
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label>Bellik</label>
                  <textarea class="form-control" rows="1" name="bellik"></textarea>
                </div>
              </div>
              <div class="col-sm-1">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <button type="submit" name="tass" class="btn btn-success form-control">Tassyklamak</button>
                </div>
              </div>
            </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>

        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Hasabat</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0" style="height: 500px;">
            <table class="table table-head-fixed table-hover table-bordered" id="ballar">
              <thead>
                <tr class="text-center">
                <th style="width: 5%;">T/b</th>
                <th style="width: 30%;">Bölümçe</th>
                <th style="width: 10%;">Sene</th>
                <th style="width: 35%;">Bellik</th>
                <th style="width: 5%;">Sany</th>
                <th style="width: 5%;">Baly</th>
                <th style="width: 5%;">Sazlama</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $qballar=mysqli_query($con, "SELECT * FROM ballar WHERE ulanyjy_id='$id_ulanyjy' ORDER BY id DESC");
                    $i=0;
                    while ($rballar=mysqli_fetch_array($qballar)){
                      $i++;
                      $bid=$rballar['bolumche_id'];
                      $rbolumche=mysqli_fetch_array(mysqli_query($con, "SELECT ady FROM bolumcheler WHERE id='$bid'"));
                      $bolumche=$rbolumche['ady'];
                      $sene=$rballar['sene'];
                      $sany=$rballar['sany'];
                      $bellik=$rballar['bellik'];
                      $balid=$rballar['id'];
                      $baly=$rballar['baly'];                    
                  ?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=$bolumche?></td>
                      <td><?=$sene?></td>
                      <td><?=$bellik?></td>
                      <td><?=$sany?></td>
                      <td><?=$baly?></td>
                      <td> 
                        <div class="btn-group">
                          <button data-id="<?=$balid?>" type="button" class="ochurmek btn btn-danger btn-flat">
                            <i class="fas fa-trash"></i>
                          </button>                          
                          </button>
                          <button data-id="<?=$balid?>"  data-toggle='modal' data-target='#editbal' type="button" class="uytget btn btn-default btn-flat">
                            <i class="fas fa-edit"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                <?php 
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<div class="modal" id="editbal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Üýtgetmek</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form method="POST" id="balgos">
        <input type="hidden" id="idbal" name="idbal">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Sany</label>
                <input type="number" id="sany" class="form-control" name="sany">
              </div>                
            </div>
            <div class="col-sm-8">
              <div class="form-group">
                <label>Senesi</label>
                <input type="date" id="sene" class="form-control" name="sene">
              </div>                
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Bellik</label>
                <textarea class="form-control" id="bellik" rows="3" name="bellik"></textarea>
              </div>
            </div>          
          </div>
        </div>
        <div class="modal-footer justify-content-right">
          <button type="submit" id="sub" name="sub" class="btn btn-success">Üýtgetmek</button>
        </div>
      </from>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Bundle -->
<script src="../assets/plugins/bs-custom-file-input/bs-custom-file-input.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields

$(function () {
  bsCustomFileInput.init();

  $('[name=bolum]').change(function(){
  var id=$(this).val();
    $.ajax({
      url: "get_bolumche.php",
      method: "POST",
      data: {id: id},
      dataType: "html",
      success:function(data){      
        $('#bolumce').html(data);
      }
    });
  });

  $(".ochurmek").click(function(){
    var el = this;
    var deleteid = $(this).data('id');
    var tass=confirm("Siz hakykatdan hem bu setiri öçürmekçimi?");
    if (tass==1) {
      $.ajax({
        url: 'delete_ball.php',
        type: 'POST',
        data: { id: deleteid },
        success: function(response){
          if(response == 1){
          // Remove row from HTML Table
          $(el).closest('tr').css('background','tomato');
          $(el).closest('tr').fadeOut(400,function(){
          $(this).remove();
          });
          }else{
            alert('Invalid ID.');
          }
        }
      });
    }
  });

  $(".uytget").click(function(){
    var id=$(this).data('id');
    $.ajax({  
      url:"fetch_balmag.php",  
      method:"POST",  
      data:{id:id},  
      dataType:"json",  
      success:function(data){
        $('#idbal').val(data.id);
        $('#sany').val(data.sany);
        $('#sene').val(data.sene);  
        $('#bellik').val(data.bellik); 
        $('#insert').val("Update");  
        $('#add_data_Modal').modal('show');  
      }  
    });
  });

  $('#balgos').on("submit", function(event){    
    event.preventDefault();
    {  
      $.ajax({  
        url:"update_ballar.php",  
        method:"POST",  
        data:$(this).serialize(),  
        beforeSend:function(){  
          $('#sub').val("Üýtgeýär");  
        },  
        success:function(data){ 
          $('#editbal').modal('hide');  
          $('#ballar').html(data);  
        }  
      });  
    }  
  });
});

</script>
</body>
</html>
