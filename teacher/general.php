<?php
session_start();   
include "../dbconnection.php";  
if (isset($_POST['submit'])){   
    $id_ulanyjy=$_POST['id_ulanyjy'];
    $hunar_ady=$_POST['hunar_ady'];
    $sapak_ady=$_POST['sapak_ady'];
    $yyl=$_POST['yyl'];
    $sorag_sany=$_POST['sorag_sany'];
    $aralyk_jemleme=$_POST['aralyk_jemleme'];
    $ders_id_ler=$_POST['ders_id_ler'];   
    //$count_id_d=count($id_dersler);    
    $ders_id_ler_mas=explode ("-", $ders_id_ler);
    for ($i=0; $i<count($ders_id_ler_mas)-1; $i++){
      //echo $id_test;
      $j=$ders_id_ler_mas[$i];      
      $qhunar=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar, ders_maglumat WHERE ders_maglumat.toparcha_id=toparchalar.id AND toparchalar.hunar=hunarler.id AND ders_maglumat.id='$j'");
      $rhunar=mysqli_fetch_array($qhunar);
      $hunar=$rhunar['gysga_ady']."-".$rhunar['yyl']."0".$rhunar['toparcha'];
      $arr[$i]=$hunar;
    }
    $query_test_regis_bar=mysqli_query($con, "SELECT * FROM `synag_test_regis` WHERE mugal_ulan_id='$id_ulanyjy' AND ders_magl_id='$ders_id_ler' AND ar_jem='$aralyk_jemleme'");
    if (mysqli_num_rows($query_test_regis_bar)==0){
      mysqli_query($con, "INSERT INTO synag_test_regis (mugal_ulan_id, ders_magl_id, ar_jem) VALUES ('$id_ulanyjy', '$ders_id_ler', '$aralyk_jemleme') ");
      $query_test_regis_bar=mysqli_query($con, "SELECT * FROM `synag_test_regis` WHERE mugal_ulan_id='$id_ulanyjy' AND ders_magl_id='$ders_id_ler' AND ar_jem='$aralyk_jemleme'");
      $row_test_regis=mysqli_fetch_array($query_test_regis_bar);
      $id_test=$row_test_regis['id'];
      for ($i=0; $i<count($ders_id_ler_mas)-1; $i++){
        //echo $id_test;
        $j=$ders_id_ler_mas[$i];
        mysqli_query($con, "INSERT INTO synag_test_ders_magl (id_test, id_ders_maglumat) VALUES ('$id_test', '$j') ");
        $qhunar=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar, ders_maglumat WHERE ders_maglumat.toparcha_id=toparchalar.id AND toparchalar.hunar=hunarler.id AND ders_maglumat.id='$j'");
        $rhunar=mysqli_fetch_array($qhunar);
        $hunar=$rhunar['gysga_ady']."-".$rhunar['yyl']."0".$rhunar['toparcha'];
        $arr[$i]=$hunar;
      }
    }

    $query_test_regis_bar=mysqli_query($con, "SELECT * FROM `synag_test_regis` WHERE mugal_ulan_id='$id_ulanyjy' AND ders_magl_id='$ders_id_ler' AND ar_jem='$aralyk_jemleme'");
    $row_test_regis=mysqli_fetch_array($query_test_regis_bar);
    $id_test=$row_test_regis['id'];

    $query_test= mysqli_fetch_array(mysqli_query($con, "SELECT max(sorag_tb) AS sorag_tb FROM synag_test_jogap WHERE id_test='$id_test'"));
    $sorag_tb=$query_test['sorag_tb'];
    $sorag_tb++;
    }
    else if (isset($_POST['sub'])){
    $sapak_ady=$_POST['sapak_ady'];
    $ders_id_ler=$_POST['ders_id_ler'];
    $ders_id_ler_mas=explode ("-", $ders_id_ler);
    for ($i=0; $i<count($ders_id_ler_mas)-1; $i++){
      //echo $id_test;
      $j=$ders_id_ler_mas[$i];      
      $qhunar=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar, ders_maglumat WHERE ders_maglumat.toparcha_id=toparchalar.id AND toparchalar.hunar=hunarler.id AND ders_maglumat.id='$j'");
      $rhunar=mysqli_fetch_array($qhunar);
      $hunar=$rhunar['gysga_ady']."-".$rhunar['yyl']."0".$rhunar['toparcha'];
      $arr[$i]=$hunar;
    }
    $id_test=$_POST['id_test'];

    $query_test= mysqli_fetch_array(mysqli_query($con, "SELECT max(sorag_tb) AS sorag_tb FROM synag_test_jogap WHERE id_test='$id_test'"));
    $sorag_tb=$query_test['sorag_tb'];
    $sorag_tb++;

    $radio1=$_POST['radio1'];
    $radio2=$_POST['radio2'];
    $radio3=$_POST['radio3'];
    $radio4=$_POST['radio4'];
    $radio5=$_POST['radio5'];

    $baly=$_POST['baly'];
    //soragy yuklemek
    if ($radio1=='stekst') $sorag=$_POST['stekst'];
    if ($radio1=='sfayl') {
      if (isset($_FILES['sfayl']) && $_FILES['sfayl']['error'] === UPLOAD_ERR_OK){
            // get details of the uploaded file
            $fileTmpPath = $_FILES['sfayl']['tmp_name'];
            $fileName = $_FILES['sfayl']['name'];
            $fileSize = $_FILES['sfayl']['size'];
            $fileType = $_FILES['sfayl']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // sanitize file-name
            $newFileName = md5($id_test."_".$sorag_tb.'_sorag').".".$fileExtension;

            $sorag="<img class=\"img-fluid pad\" src=\"../test-surat/".$newFileName."\">";

            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

            if (in_array($fileExtension, $allowedfileExtensions)){
              // directory in which the uploaded file will be moved
              $uploadFileDir = '../test-surat/';
              $dest_path = $uploadFileDir . $newFileName;

              if(move_uploaded_file($fileTmpPath, $dest_path)){
                $message ='File is successfully uploaded.';
              }
              else{
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
              }
            }
            else{
              $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            }
        }
          else{
        $message = 'There is some error in the file upload. Please check the following error.<br>';
            $message .= 'Error:' . $_FILES['sfayl']['error'];
        }
    }

    //dogry jogap yuklemek
    if ($radio2=='djt') $dj=$_POST['djt'];
    if ($radio2=='djf') {
      if (isset($_FILES['djf']) && $_FILES['djf']['error'] === UPLOAD_ERR_OK){
            // get details of the uploaded file
            $fileTmpPath = $_FILES['djf']['tmp_name'];
            $fileName = $_FILES['djf']['name'];
            $fileSize = $_FILES['djf']['size'];
            $fileType = $_FILES['djf']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // sanitize file-name
            $newFileName = md5($id_test."_".$sorag_tb.'_dj').".".$fileExtension;

            $dj="<img class=\"img-fluid pad\" src=\"../test-surat/".$newFileName."\">";

            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

            if (in_array($fileExtension, $allowedfileExtensions)){
              // directory in which the uploaded file will be moved
              $uploadFileDir = '../test-surat/';
              $dest_path = $uploadFileDir . $newFileName;

              if(move_uploaded_file($fileTmpPath, $dest_path)){
                $message ='File is successfully uploaded.';
              }
              else{
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
              }
            }
            else{
              $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            }
        }
          else{
        $message = 'There is some error in the file upload. Please check the following error.<br>';
            $message .= 'Error:' . $_FILES['djf']['error'];
        }
    }

    //yalnsyh jogap1 yuklemek
    if ($radio3=='yj1t') $yj1=$_POST['yj1t'];
    if ($radio3=='yj1f') {
      if (isset($_FILES['yj1f']) && $_FILES['yj1f']['error'] === UPLOAD_ERR_OK){
            // get details of the uploaded file
            $fileTmpPath = $_FILES['yj1f']['tmp_name'];
            $fileName = $_FILES['yj1f']['name'];
            $fileSize = $_FILES['yj1f']['size'];
            $fileType = $_FILES['yj1f']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // sanitize file-name
            $newFileName = md5($id_test."_".$sorag_tb.'_yj1').".".$fileExtension;

            $yj1="<img class=\"img-fluid pad\" src=\"../test-surat/".$newFileName."\">";

            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

            if (in_array($fileExtension, $allowedfileExtensions)){
              // directory in which the uploaded file will be moved
              $uploadFileDir = '../test-surat/';
              $dest_path = $uploadFileDir . $newFileName;

              if(move_uploaded_file($fileTmpPath, $dest_path)){
                $message ='File is successfully uploaded.';
              }
              else{
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
              }
            }
            else{
              $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            }
        }
          else{
        $message = 'There is some error in the file upload. Please check the following error.<br>';
            $message .= 'Error:' . $_FILES['yj1f']['error'];
        }
    }

    //yalnsyh jogap2 yuklemek
    if ($radio4=='yj2t') $yj2=$_POST['yj2t'];
    if ($radio4=='yj2f') {
      if (isset($_FILES['yj2f']) && $_FILES['yj2f']['error'] === UPLOAD_ERR_OK){
            // get details of the uploaded file
            $fileTmpPath = $_FILES['yj2f']['tmp_name'];
            $fileName = $_FILES['yj2f']['name'];
            $fileSize = $_FILES['yj2f']['size'];
            $fileType = $_FILES['yj2f']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // sanitize file-name
            $newFileName = md5($id_test."_".$sorag_tb.'_yj2').".".$fileExtension;

            $yj2="<img class=\"img-fluid pad\" src=\"../test-surat/".$newFileName."\">";

            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

            if (in_array($fileExtension, $allowedfileExtensions)){
              // directory in which the uploaded file will be moved
              $uploadFileDir = '../test-surat/';
              $dest_path = $uploadFileDir . $newFileName;

              if(move_uploaded_file($fileTmpPath, $dest_path)){
                $message ='File is successfully uploaded.';
              }
              else{
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
              }
            }
            else{
              $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            }
        }
          else{
        $message = 'There is some error in the file upload. Please check the following error.<br>';
            $message .= 'Error:' . $_FILES['yj2f']['error'];
        }
    }

    //yalnsyh jogap3 yuklemek
    if ($radio5=='yj3t') $yj3=$_POST['yj3t'];
    if ($radio5=='yj3f') {
      if (isset($_FILES['yj3f']) && $_FILES['yj3f']['error'] === UPLOAD_ERR_OK){
            // get details of the uploaded file
            $fileTmpPath = $_FILES['yj3f']['tmp_name'];
            $fileName = $_FILES['yj3f']['name'];
            $fileSize = $_FILES['yj3f']['size'];
            $fileType = $_FILES['yj3f']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // sanitize file-name
            $newFileName = md5($id_test."_".$sorag_tb.'_yj3').".".$fileExtension;

            $yj3="<img class=\"img-fluid pad\" src=\"../test-surat/".$newFileName."\">";

            // check if file has one of the following extensions
            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'bmp');

            if (in_array($fileExtension, $allowedfileExtensions)){
              // directory in which the uploaded file will be moved
              $uploadFileDir = '../test-surat/';
              $dest_path = $uploadFileDir . $newFileName;

              if(move_uploaded_file($fileTmpPath, $dest_path)){
                $message ='File is successfully uploaded.';
              }
              else{
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
              }
            }
            else{
              $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
            }
        }
          else{
        $message = 'There is some error in the file upload. Please check the following error.<br>';
            $message .= 'Error:' . $_FILES['yj3f']['error'];
        }
    }

    //echo $sorag." ".$dj." ".$yj1." ".$yj2." ".$yj3." ";

    mysqli_query($con, "INSERT INTO synag_test_jogap (id_test, sorag_tb, sorag, jogap1, jogap2, jogap3, jogap4, baly) VALUES ('$id_test', '$sorag_tb', '$sorag', '$dj', '$yj1', '$yj2','$yj3', '$baly') ");
    $sorag_tb++;
    $sapak_ady=$sapak_ady;
  }
  $rqss=mysqli_fetch_array(mysqli_query($con,"SELECT sorag_sany FROM synag_tapgyr WHERE gornush='1'"));
  $sorag_sany=$rqss['sorag_sany'];
  if($sorag_tb>$sorag_sany) header("location: uptest.php");    
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Test goşmak</title>
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
            <h1><?=$sapak_ady?> dersinden test soraglaryny goşmak <?=$sorag_sany?></h1>
          </div>          
        </div>
        <div class="row mb-2">
          <div class="col-sm-12">
            <h5><?php 
              for ($i=0; $i<count($arr); $i++){
                echo "\"".$arr[$i]."\" ";
              }
            ?></h5>
          </div>          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title"><?=$sorag_tb?>-nji(y) sorag</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data" class="needs-validation">                
                <input type="hidden" name="sorag_tb" value="<?=$sorag_tb?>">
                <input type="hidden" name="id_test" value="<?=$id_test?>">
                <div class="card-body">
                  <div class="row">                    
                    <div class="col-lg-6">
                      <label for="sorag">Sorag tekst görnüşde</label>
                      <fieldset id="ssag">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="radio" value="stekst" name="radio1">
                            </span>
                          </div>
                          <textarea rows="4" name="stekst" class="form-control" required></textarea>                          
                        </div>
                        <!-- /input-group -->
                      </fieldset>
                    </div>
                    <!-- /.col-lg-6 -->
                    
                    <div class="col-lg-6">
                      <label for="sorag">Sorag surat görnüşde</label>
                      <fieldset id="scep">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="radio" value="sfayl" name="radio1" required>
                            </span>
                          </div>
                          <div class="custom-file">
                            <input type="file" name="sfayl" class="custom-file-input">
                            <label class="custom-file-label" for="exampleInputFile">Surat faýly saýlaň</label>
                          </div>
                        </div>
                        <!-- /input-group -->
                      </fieldset>
                    </div>
                    <!-- /.col-lg-6 -->
                  </div>
                  
                  <div class="row">                    
                    <div class="col-lg-6">
                      <fieldset id="sdj">
                        <label for="djog">Dogry jogap tekst görnüşde</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="radio" value="djt" name="radio2">
                            </span>
                          </div>
                          <textarea rows="1" name="djt" class="form-control"></textarea>
                        </div>
                        <!-- /input-group -->
                      </fieldset>
                    </div>
                    <!-- /.col-lg-6 -->
                    
                    <div class="col-lg-6">
                      <fieldset id="cdj">
                        <label for="djog">Dogry jogap surat görnüşde</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="radio" value="djf" name="radio2">
                            </span>
                          </div>
                          <div class="custom-file">
                            <input type="file" name="djf" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Surat faýly saýlaň</label>
                          </div>
                        </div>
                        <!-- /input-group -->
                      </fieldset>
                    </div>
                    <!-- /.col-lg-6 -->
                  </div>

                  <div class="row">                    
                    <div class="col-lg-6">
                      <fieldset id="syj1">
                        <label for="djog">1-nji ýalňyş jogap tekst görnüşde</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="radio" value="yj1t" name="radio3">
                            </span>
                          </div>
                          <textarea rows="1" name="yj1t" class="form-control"></textarea>
                        </div>
                        <!-- /input-group -->
                      </fieldset>
                    </div>
                    <!-- /.col-lg-6 -->
                    
                    <div class="col-lg-6">
                      <fieldset id="cyj1">
                        <label for="djog">1-nji ýalňyş jogap surat görnüşde</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="radio" value="yj1f" name="radio3">
                            </span>
                          </div>
                          <div class="custom-file">
                            <input type="file" name="yj1f" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Surat faýly saýlaň</label>
                          </div>
                        </div>
                        <!-- /input-group -->
                      </fieldset>
                    </div>
                    <!-- /.col-lg-6 -->
                  </div>

                  <div class="row">                    
                    <div class="col-lg-6">
                      <fieldset id="syj2">
                        <label for="djog">2-nji ýalňyş jogap tekst görnüşde</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="radio" value="yj2t" name="radio4">
                            </span>
                          </div>
                          <textarea rows="1" name="yj2t" class="form-control"></textarea>
                        </div>
                        <!-- /input-group -->
                      </fieldset>
                    </div>
                    <!-- /.col-lg-6 -->
                    
                    <div class="col-lg-6">
                      <fieldset id="cyj2">
                        <label for="djog">2-nji ýalňyş jogap surat görnüşde</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="radio" value="yj2f" name="radio4">
                            </span>
                          </div>
                          <div class="custom-file">
                            <input type="file" name="yj2f" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Surat faýly saýlaň</label>
                          </div>
                        </div>
                        <!-- /input-group -->
                      </fieldset>
                    </div>
                    <!-- /.col-lg-6 -->
                  </div>

                  <div class="row">                    
                    <div class="col-lg-6">
                      <fieldset id="syj3">
                        <label for="djog">3-nji ýalňyş jogap tekst görnüşde</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="radio" value="yj3t" name="radio5">
                            </span>
                          </div>
                          <textarea rows="1" name="yj3t" class="form-control"></textarea>
                        </div>
                        <!-- /input-group -->
                      </fieldset>
                    </div>
                    <!-- /.col-lg-6 -->
                    
                    <div class="col-lg-6">
                      <fieldset id="cyj3">
                        <label for="djog">3-nji ýalňyş jogap surat görnüşde</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <input type="radio" value="yj3f" name="radio5">
                            </span>
                          </div>
                          <div class="custom-file">
                            <input type="file" name="yj3f" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Surat faýly saýlaň</label>
                          </div>
                        </div>
                        <!-- /input-group -->
                      </fieldset>
                    </div>
                   
                    <!-- /.col-lg-6 -->
                  </div>
                  <div class="row">
                    <div class="col-sm-1">
                      <!-- select -->
                      <div class="form-group">
                        <label>Soragyň baly</label>
                        <select class="form-control" name="baly">
                          <option value="1" selected>1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                      </div>
                    </div>                    
                  </div>                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">                  
                  <button type="submit" name="sub" class="btn btn-success">Tassyklamak</button>
                </div>
                <input type="hidden" value="<?=$ders_id_ler?>" name="ders_id_ler">
                <input type="hidden" value="<?=$sapak_ady?>" name="sapak_ady">
              </form>              
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->         
        </div>
        <!-- /.row -->
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
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields

$(function () {
  bsCustomFileInput.init();  
});
$('input[name=radio1]').on('change',function() {
  var name=$(this).val();
  if (name=='stekst'){
    $('#scep').attr('disabled', 'disabled');
  }
  else {
    $('#ssag').attr('disabled', 'disabled');
  }               
});
$('input[name=radio2]').on('change',function() {
  var name=$(this).val();
  if (name=='djt'){
    $('#cdj').attr('disabled', 'disabled');
  }
  else {
    $('#sdj').attr('disabled', 'disabled');
  }               
});
$('input[name=radio3]').on('change',function() {
  var name=$(this).val();
  if (name=='yj1t'){
    $('#cyj1').attr('disabled', 'disabled');
  }
  else {
    $('#syj1').attr('disabled', 'disabled');
  }               
});
$('input[name=radio4]').on('change',function() {
  var name=$(this).val();
  if (name=='yj2t'){
    $('#cyj2').attr('disabled', 'disabled');
  }
  else {
    $('#syj2').attr('disabled', 'disabled');
  }               
});
$('input[name=radio5]').on('change',function() {
  var name=$(this).val();
  if (name=='yj3t'){
    $('#cyj3').attr('disabled', 'disabled');
  }
  else {
    $('#syj3').attr('disabled', 'disabled');
  }               
});
$('[name=sfayl]').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#prew').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
</script>
</body>
</html>
