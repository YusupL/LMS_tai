<?php
include '../dbconnection.php';
session_start();
$id_ulanyjy=$_SESSION['id'];
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Netijeler</title>
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
            <h1>Synag netijeleri</h1>
          </div>          
        </div>        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Synag geçen hünäriň ýylyny, hünärini saýlaň</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form class="needs-validation" novalidate method="post">
                  <div class="row justify-content-center">
                    <div class="col-md-6 mb-3">
                      <label for="yyly">Ýyly</label>
                      <select class="custom-select d-block w-100 neti" id="yyly" name="yyly" required>
                        <option value="0"></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>	
                        <option value="4">4</option>
                        <option value="5">5</option>				  
                      </select>                
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="hunar">Hünäri</label>
                      <select class="custom-select d-block w-100 neti" id="hunar" name="hunar" required>
                        <option value="0"></option>
                        <?php
                          $query_hunar=mysqli_query($con, "SELECT * FROM hunarler");
                          while ($row_hunar=mysqli_fetch_array($query_hunar)) {?>
                            <option value="<?php echo $row_hunar['id']; ?>"><?php echo $row_hunar['gysga_ady']; ?></option>
                            <?php
                          }
                        ?>  
                      </select>                
                    </div>                                                 
                  </div>              
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <div class="row" id="result">
        </div>
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

  $('.neti').on("change", function(event){
    var yyly=$("#yyly").val();
    var hunar=$("#hunar").val();
    $.ajax({
      url:"get_netije.php",
      method:"POST",
      data: {yyly:yyly, hunar:hunar},
      beforeSend:function(){
        $('#result').html("Maglumatlar ýüklenýär");
      },
      success:function(data){
        $('#result').html(data);
      }
    });
  });  
});

</script>
</body>
</html>
