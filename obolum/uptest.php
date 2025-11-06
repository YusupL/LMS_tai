<?php
    include '../dbconnection.php';
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Test ýüklemek</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">  
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
  <link rel="stylesheet" href="../assets/dist/css/docs.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include 'navsidebar.php'; ?>
 
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <!-- COLOR PALETTE -->
        <div class="card card-default card-danger mt-4">
          <div class="card-header bg-blue">
            <h3 class="card-title">
              <i class="fas fa-clipboard-list"></i>
              <b>Test ýüklemek</b>
            </h3>
          </div>
          <div class="card-body">
            <div class="container-fluid">
              <!-- COLOR PALETTE -->
              <div class="card card-default color-palette-box mt-4">
                <div class="card-header bg-success">
                  <h3 class="card-title">
                    <i class="fas fa-bookmark"></i>
                    <b>Adaty hünärler üçin</b>
                  </h3>
                </div>
                <div class="card-body">
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12" id="accordion">
                          <div class="card card-success card-outline">
                              <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                  <div class="card-header">
                                      <h4 class="card-title font-weight-bold w-100" style="color: green;" >
                                          Maglumat bazalary
                                      </h4>
                                  </div>
                              </a>
                              <div id="collapseOne" class="collapse" data-parent="#accordion">
                                  <div class="card-body">
                                    <form method="post" action="excel_upload.php" enctype="multipart/form-data">
                                      <input type="hidden" name="hunar_ady" value="">
                                      <input type="hidden" name="sapak_ady" value="">
                                      <input type="hidden" name="yyl" value="">
                                      <input type="hidden" name="sorag_sany" value="">
                                      <input type="hidden" name="aralyk_jemleme" value="">
                                      <input type="hidden" name="id_ulanyjy" value="">

                                      <div class='form-group row'>
                                          <div class="col-lg-1"><div style="padding: 5px; padding-left: 20px; font-size: 13px; background-color: #32ce36; color: white; border-radius: 5px;">TEST</div></div>

                                          <div class='col-md-2'> <input type='file' name='uploadfile' class='form-control' id="" class="file_name"> </div>

                                          <div class="col-md-5"  id="">

                                                          <label style="font-size: 18px; color: black; padding-top: 6px; padding-left: 5px; padding-right: 3px;"></label><input type="checkbox" name="id_toparchalar[]" value="">

                                          </div>

                                          <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-outline-success class_excel' value='Tassyklamak' id=""></div>
                                      </div>
                                  </form>

                                  <form  class="" method="post" action="pdf_upload.php" enctype="">
                                      <input type="hidden" name="hunar_ady" value="">
                                      <input type="hidden" name="sapak_ady" value="">
                                      <input type="hidden" name="yyl" value="">
                                      <input type="hidden" name="sorag_sany" value="">
                                      <input type="hidden" name="aralyk_jemleme" value="">
                                      <input type="hidden" name="id_ulanyjy" value="">

                                      <div class='form-group row'>
                                          <div class="col-lg-1"><div style="padding: 5px; padding-left: 20px; font-size: 13px; background-color: #32ce36; color: white; border-radius: 5px;">PDF</div></div>
                                          <div class='col-md-2'> <input type='file' name='pdffile' class='form-control' id="" class="file_name_pdf"> </div>
                                          <div class="col-md-5"  id="">
                                                          <label style="font-size: 18px; color: black; padding-top: 6px; padding-left: 5px; padding-right: 3px;"> </label><input type="checkbox" name="">
                                          </div>
                                          <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-outline-success class_pdf' value='Tassyklamak' id="" ></div>
                                      </div>
                                  </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="card card-default color-palette-box mt-4">
                  <div class="card-header bg-success">
                    <h3 class="card-title">
                      <i class="fas fa-bookmark"></i>
                      Bakalawr hünärler üçin
                    </h3>
                  </div>
                  <div class="card-body">
                    <div class="col-12">
                      <div class="row">

                        <div class="col-12" id="accordion">


                            <div class="card card-success card-outline">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                    <div class="card-header">
                                        <h4 class="card-title font-weight-bold w-100" style="color: green;" >
                                            Maglumat bazalary
                                        </h4>
                                    </div>
                                </a>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                      <form method="post" action="excel_upload.php" enctype="multipart/form-data">
                                        <input type="hidden" name="hunar_ady" value="">
                                        <input type="hidden" name="sapak_ady" value="">
                                        <input type="hidden" name="yyl" value="">
                                        <input type="hidden" name="sorag_sany" value="">
                                        <input type="hidden" name="aralyk_jemleme" value="">
                                        <input type="hidden" name="id_ulanyjy" value="">

                                        <div class='form-group row'>
                                            <div class="col-lg-1"><div style="padding: 5px; padding-left: 20px; font-size: 13px; background-color: #32ce36; color: white; border-radius: 5px;">TEST</div></div>

                                            <div class='col-md-2'> <input type='file' name='uploadfile' class='form-control' id="" class="file_name"> </div>

                                            <div class="col-md-5"  id="">

                                                            <label style="font-size: 18px; color: black; padding-top: 6px; padding-left: 5px; padding-right: 3px;"></label><input type="checkbox" name="id_toparchalar[]" value="">

                                            </div>

                                            <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-outline-success class_excel' value='Tassyklamak' id=""></div>
                                        </div>
                                    </form>

                                    <form  class="" method="post" action="pdf_upload.php" enctype="">
                                        <input type="hidden" name="hunar_ady" value="">
                                        <input type="hidden" name="sapak_ady" value="">
                                        <input type="hidden" name="yyl" value="">
                                        <input type="hidden" name="sorag_sany" value="">
                                        <input type="hidden" name="aralyk_jemleme" value="">
                                        <input type="hidden" name="id_ulanyjy" value="">

                                        <div class='form-group row'>
                                            <div class="col-lg-1"><div style="padding: 5px; padding-left: 20px; font-size: 13px; background-color: #32ce36; color: white; border-radius: 5px;">PDF</div></div>
                                            <div class='col-md-2'> <input type='file' name='pdffile' class='form-control' id="" class="file_name_pdf"> </div>
                                            <div class="col-md-5"  id="">
                                                            <label style="font-size: 18px; color: black; padding-top: 6px; padding-left: 5px; padding-right: 3px;"> </label><input type="checkbox" name="">
                                            </div>
                                            <div class='col-md-3'> <input type='submit' name='submit' class='btn btn-outline-success class_pdf' value='Tassyklamak' id="" ></div>
                                        </div>
                                    </form>
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
          </div>
        </div>
    </section>
</div>

  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
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
</body>
</html>
