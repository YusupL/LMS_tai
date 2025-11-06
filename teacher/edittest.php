<?php    
    include "../dbconnection.php";
    session_start();
    if (isset($_POST['submit'])){    
      $id_toparchalar=$_POST['id_toparchalar'];
      $count_id_t=count($id_toparchalar);
      
      $id_ulanyjy=$_POST['id_ulanyjy'];
      $hunar_ady=$_POST['hunar_ady'];
      $sapak_ady=$_POST['sapak_ady'];
      $yyl=$_POST['yyl'];
      $sorag_sany=$_POST['sorag_sany'];
      $aralyk_jemleme=$_POST['aralyk_jemleme'];
      $ders_id_ler=$_POST['ders_id_ler'];

      //$count_id_d=count($id_dersler);

      $query_test_regis_bar=mysqli_query($con, "SELECT * FROM `synag_test_regis` WHERE mugal_ulan_id='$id_ulanyjy' AND ders_magl_id='$ders_id_ler' AND ar_jem='$aralyk_jemleme'");
      $row_test_regis=mysqli_fetch_array($query_test_regis_bar);
      $id_test=$row_test_regis['id'];
    }
    //$query_test=mysqli_query($con, "SELECT * FROM synag_test_jogap WHERE id_test='$id_test'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Test sazlamalar</title>
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
          <div class="col-sm-6">
            <h1>Test sazlamalar <b><?php echo $sapak_ady; ?></b></h1>
          </div>          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
      <div class="container-fluid">
        <?php
          $query_test=mysqli_query($con, "SELECT * FROM synag_test_jogap WHERE id_test='$id_test' ORDER BY sorag_tb");
          while ($row_test=mysqli_fetch_array($query_test)) { ?>
                      
            <div class="row justify-content-center">
              <div class="col-md-10">
                <div class="card card-outline card-success">
                  <div class="card-header">
                    <h3 class="card-title"><?php echo $row_test['sorag_tb']; ?>-nji(y) sorag</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- gerekli yeri -->
                    <div class="row justify-content-center">                      
                      <div class="col-md-8">
                        <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-1">
                                <button type="button" class="btn btn-tool edit_data" data-toggle="modal" data-target="#addModal" data-id="<?=$row_test['id']?>" id="sorag">
                                  <i class="fas fa-edit"></i>
                                </button>
                              </div>
                              <div class="col-md-11" id="sorag_<?=$row_test['id']?>">
                                <?php echo "<b>".$row_test['sorag']."</b>"; ?>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.col -->        
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-md-6">
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-1">
                                <button type="button" class="btn btn-tool edit_data" data-toggle="modal" data-target="#addModal" data-id="<?=$row_test['id']?>" id="jogap1">
                                  <i class="fas fa-edit"></i>
                                </button>
                              </div>
                              <div class="col-md-11" id="jogap1_<?=$row_test['id']?>">
                                <?php echo $row_test['jogap1']; ?>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <div class="col-md-6">
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-1">
                                <button type="button" class="btn btn-tool edit_data" data-toggle="modal" data-target="#addModal" data-id="<?=$row_test['id']?>" id="jogap2">
                                  <i class="fas fa-edit"></i>
                                </button>
                              </div>
                              <div class="col-md-11" id="jogap2_<?=$row_test['id']?>">
                                <?php echo $row_test['jogap2']; ?>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-md-6">
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-1">
                                <button type="button" class="btn btn-tool edit_data" data-toggle="modal" data-target="#addModal" data-id="<?=$row_test['id']?>" id="jogap3">
                                  <i class="fas fa-edit"></i>
                                </button>
                              </div>
                              <div class="col-md-11" id="jogap3_<?=$row_test['id']?>">
                                <?php echo $row_test['jogap3']; ?>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                      <div class="col-md-6">
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-1">
                                <button type="button" class="btn btn-tool edit_data" data-toggle="modal" data-target="#addModal" data-id="<?=$row_test['id']?>" id="jogap4">
                                  <i class="fas fa-edit"></i>
                                </button>
                              </div>
                              <div class="col-md-11" id="jogap4_<?=$row_test['id']?>">
                                <?php echo $row_test['jogap4']; ?>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                      </div>
                    </div>
                    <!-- /.row --> 
                    <div class="row justify-content-center">
                    <div class="col-sm-2">
                      <!-- select -->
                      <div class="form-group">
                        <label>Soragyň baly</label>
                        <select class="form-control" name="baly_<?=$row_test['id']?>">
                          <option value="1" <?php if ($row_test['baly']==1) echo "selected"; ?>>1</option>
                          <option value="2" <?php if ($row_test['baly']==2) echo "selected"; ?>>2</option>
                          <option value="3" <?php if ($row_test['baly']==3) echo "selected"; ?>>3</option>
                        </select>
                      </div>
                    </div>                    
                  </div>                   
                  </div>
                </div>
              </div>
            </div>  <?php
           }
        ?>  
      </div><!-- /.container-fluid -->
    </section>

    
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="addModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Üýtgetmek</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="insert_form" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="test" id="test" value="">
            <input type="hidden" name="gor" id="gor" value="">
            <div class="row">                   
              <div class="col-lg-12">
                <fieldset id="scep">
                  <label for="djog">Tekst görnüşde</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <input type="radio" value="tekst" name="radio1">
                      </span>
                    </div>
                    <textarea rows="4" name="tekst" class="form-control"></textarea>
                  </div>
                  <!-- /input-group -->
                </fieldset>
              </div>
              <!-- /.col-lg-6 -->
                      
              <div class="col-lg-12">
                <fieldset id="ssag">
                  <label for="djog">Surat görnüşde</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <input type="radio" value="fayl" name="radio1">
                      </span>
                    </div>
                    <div class="custom-file">
                      <input type="file" name="fayl" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Surat faýly saýlaň</label>
                    </div>
                  </div>
                  <!-- /input-group -->
                </fieldset>
              </div>
              <!-- /.col-lg-6 -->          
            </div>
          </div>
          <div class="modal-footer justify-content-right">
            <button type="submit" name="sub" class="btn btn-success">Üýtgetmek</button>
          </div>
        </form>
      </div>
    </div>
  </div>
      <!-- /.modal -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>

<script type="text/javascript">

  $(document).on('click', '.edit_data', function(){
    $('#insert_form')[0].reset();
    $('#ssag').removeAttr('disabled');
    $('#scep').removeAttr('disabled');
    var sutun= $(this).attr("id");
    var sid=$(this).attr("data-id");
    $("#test").val(sid);
    $("#gor").val(sutun);
  });

  $('#insert_form').on("submit", function(event){
    goymak="#"+$('#gor').val()+"_"+$('#test').val();
    event.preventDefault();
    $.ajax({  
      type: 'POST',
      url: 'update_sing_test.php',
      data: new FormData(this),
      dataType: 'json',
      contentType: false,
      cache: false,
      processData:false,
      beforeSend:function(){
          $('[name=sub]').val("Goşulýar");
      },
      success: function (response) {                   	
        $(goymak).html(response);
        $('#addModal').modal('hide');
      }
    });
  });

  $('input[name=radio1]').on('change',function() {
    var name=$(this).val();
    if (name=='fayl'){
      $('#scep').attr('disabled', 'disabled');
    }
    else {
      $('#ssag').attr('disabled', 'disabled');
    }               
  });
  $('select').change(function(){
    var idd=$(this).attr('name').substring(5);
    var baly=$(this).val();
    $.ajax({  
      url:"sbs.php",  
      method:"POST",  
      data:{idd:idd, baly:baly},
      dataType:"html",  
    });
  })
</script>
</body>
</html>
