<?php
include '../dbconnection.php';
session_start();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Okuw bölümi</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css"> 
  <!-- DataTables -->
  <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> 
  <!-- Sidebar -->
  <link rel="stylesheet" href="../assets/dist/css/docs.css"> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  
  <?php include 'navsidebar.php'; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Kafedralar boýunça mugallymlaryň ýekeleýin derejeleýin görkezijileri</h1>
          </div>          
        </div>        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
          $qkaf=mysqli_query($con, "SELECT * FROM kafedralar");
          while($rkaf=mysqli_fetch_array($qkaf)){
            $kid=$rkaf['id'];
            $kady=$rkaf['ady'];
            $rkjem=mysqli_fetch_array(mysqli_query($con, "SELECT SUM(ballar.baly) AS jemi FROM ballar, ulanyjylar, mugallymlar, kafedralar WHERE ulanyjylar.id=mugallymlar.ulanyjy_id AND mugallymlar.kafedra=kafedralar.id AND kafedralar.id='$kid' AND ulanyjylar.id=ballar.ulanyjy_id"));
            $kjemi=$rkjem['jemi'];
            if ($kjemi=='') $kjemi=0;
            $mug_san=mysqli_query($con, "SELECT mugallymlar.ady, mugallymlar.familiyasy FROM ballar, ulanyjylar, mugallymlar WHERE ballar.ulanyjy_id=ulanyjylar.id AND ulanyjylar.id=mugallymlar.ulanyjy_id AND mugallymlar.kafedra='$kid' GROUP BY (mugallymlar.id)");
            $mug_s=mysqli_num_rows($mug_san);
        ?>        
        <div class="card card-light collapsed-card">
          <div class="card-header">
            <h3 class="card-title"><?=$kady." | Ortaça: <b>".round($kjemi/$mug_s, 2)." ball </b>"?></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php 
              $qkafmug=mysqli_query($con, "SELECT * FROM mugallymlar WHERE kafedra='$kid'");
              while($rkafmug=mysqli_fetch_array($qkafmug)){
                $ulan_id=$rkafmug['ulanyjy_id'];
                $rbaljem=mysqli_fetch_array(mysqli_query($con, "SELECT SUM(baly) as jemi FROM ballar WHERE ulanyjy_id='$ulan_id'"));            
                $jemi=$rbaljem['jemi'];
                $mady=$rkafmug['ady'];
                $mfam=$rkafmug['familiyasy'];
                if ($jemi!=''){
            ?>
            <div class="card card-success collapsed-card">
              <div class="card-header">
                <h3 class="card-title"><?=$mfam." ".$mady." | Jemi:<b>".$jemi." ball </b>"?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">          
                <table class="table table-bordered table-striped example">
                  <thead>
                  <tr>
                    <th>T/b</th>
                    <th>Bölümçe</th>
                    <th>Sene</th>
                    <th>Bellik</th>
                    <th>Sany</th>
                    <th>Baly</th>
                    <th>Sazlama</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $qballar=mysqli_query($con, "SELECT * FROM ballar WHERE ulanyjy_id='$ulan_id'");
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
                          <td><button data-id="<?=$balid?>" class='ochurmek btn-sm btn-danger'><i class='fas fa-trash'></i> Öçürmek</button></td>
                        </tr>
                    <?php 
                      }
                    ?>                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>T/b</th>
                    <th>Bölümçe</th>
                    <th style="width: 100px;">Sene</th>
                    <th>Bellik</th>
                    <th>Sany</th>
                    <th>Baly</th>                    
                    <th>Sazlama</th>
                  </tr>
                  </tfoot>
                </table>
              </div>            
            </div>
            <?php } 
            }?>
          </div>
        </div>
          <!-- /.row -->
          <?php
          }           
          ?>        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

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
<!-- DataTables  & Plugins -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/plugins/jszip/jszip.min.js"></script>
<script src="../assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields

$(function () {
  bsCustomFileInput.init();
  $(".example").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,      
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('.ochurmek').click(function(){
    var el = this;
    var deleteid = $(this).data('id');
    alert(deleteid);
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
   });
});
</script>
</body>
</html>
