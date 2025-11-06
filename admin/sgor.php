<?php
  include "dbcon.php";
  if (isset($_POST['dmsub'])){
    $adaty_yy=$_POST['adaty_yy'];
    $adaty_aj=$_POST['adaty_aj'];
    $adaty_ss=$_POST['adaty_ss'];
    $bakalawr_yy=$_POST['bakalawr_yy'];
    $bakalawr_aj=$_POST['bakalawr_aj'];
    $bakalawr_ss=$_POST['bakalawr_ss'];
    $podkurs_yy=$_POST['podkurs_yy'];
    $podkurs_aj=$_POST['podkurs_aj'];
    $podkurs_ss=$_POST['podkurs_ss'];    

    mysqli_query($con, "UPDATE synag_tapgyr SET yarymyyllyk='$adaty_yy', aralyk_jemleme='$adaty_aj', sorag_sany='$adaty_ss' WHERE gornush='1'");
    mysqli_query($con, "UPDATE synag_tapgyr SET yarymyyllyk='$bakalawr_yy', aralyk_jemleme='$bakalawr_aj', sorag_sany='$bakalawr_ss' WHERE gornush='2'");
    mysqli_query($con, "UPDATE synag_tapgyr SET yarymyyllyk='$podkurs_yy', aralyk_jemleme='$podkurs_aj', sorag_sany='$podkurs_ss' WHERE gornush='3'");
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Synag görnüşi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/ionicons.min.css">  
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
          <div class="col-sm-12 text-center">
            <h1>
              Synag maglumatlary
            </h1>
          </div>          
        </div>
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-tag"></i>
              Saýla
          </div>
          <div class="card-body">
            <?php
              $query=mysqli_query($con, "SELECT * FROM synag_tapgyr");
              while ($row=mysqli_fetch_array($query)){
                if ($row['gornush']==1){
                  $adaty_yy=$row['yarymyyllyk'];
                  $adaty_aj=$row['aralyk_jemleme'];
                  $adaty_ss=$row['sorag_sany'];
                } 
                else if ($row['gornush']==2){
                  $bakalawr_yy=$row['yarymyyllyk'];
                  $bakalawr_aj=$row['aralyk_jemleme'];
                  $bakalawr_ss=$row['sorag_sany'];
                }
                else if ($row['gornush']==3){
                  $podkurs_yy=$row['yarymyyllyk'];
                  $podkurs_aj=$row['aralyk_jemleme'];
                  $podkurs_ss=$row['sorag_sany'];
                }
              }
            ?>
            <form class="needs-validation" novalidate method="post">
              <div class="row">
                <div class="col-md-2 mb-3">
                  <label><br></label>
                  <h4>Adaty:</h4>                
                </div>
                <div class="col-md-2 mb-3">
                  <label for="fak">Ýarym ýyllyk</label>
                  <select class="custom-select d-block w-100" id="fak" name="adaty_yy" required>
                    <option value="1" <?php if ($adaty_yy=='1') echo 'selected="selected"'; ?> >1-nji</option>
                    <option value="2" <?php if ($adaty_yy=='2') echo 'selected="selected"'; ?> >2-nji</option>
                  </select>                
                </div>
                <div class="col-md-2 mb-3">
                  <label for="adsorsan">Aralyk jemleme</label>
                  <select class="custom-select d-block w-100" id="fak" name="adaty_aj" required>
                    <?php
                      for ($i=1; $i<=5; $i++){?>
                          <option value="<?php echo $i; ?>" <?php if ($i==$adaty_aj) echo 'selected="selected"'; ?> ><?php if ($i<=4) {echo $i."-nji";} else echo "Synag"; ?></option>
                        <?php
                      }
                    ?>
                  </select>      
                </div>
                <div class="col-md-2 mb-">
                  <label for="bakarj">Sorag sany</label>
                  <input type="number"  class="form-control"  id="bakarj" name="adaty_ss" max="75" value="<?php echo $adaty_ss; ?>">                
                </div>
              </div>
              <div class="row">
                <div class="col-md-2 mb-3">
                  <label><br></label>
                  <h4>Bakalawr:</h4>                
                </div>
                <div class="col-md-2 mb-3">
                  <label for="fak">Ýarym ýyllyk</label>
                  <select class="custom-select d-block w-100" id="fak" name="bakalawr_yy" required>
                    <option value="1" <?php if ($bakalawr_yy=='1') echo 'selected="selected"'; ?> >1-nji</option>
                    <option value="2" <?php if ($bakalawr_yy=='2') echo 'selected="selected"'; ?> >2-nji</option>
                  </select>                
                </div>
                <div class="col-md-2 mb-3">
                  <label for="adsorsan">Aralyk jemleme</label>
                  <select class="custom-select d-block w-100" id="fak" name="bakalawr_aj" required>
                    <option value="1" <?php if ($bakalawr_aj=='1') echo 'selected="selected"'; ?> >Aralyk synag</option>
                    <option value="2" <?php if ($bakalawr_aj=='2') echo 'selected="selected"'; ?> >Synag</option>
                  </select>      
                </div>
                <div class="col-md-2 mb-">
                  <label for="bakarj">Sorag sany</label>
                  <input type="number"  class="form-control"  id="bakarj" name="bakalawr_ss" max="120" value="<?php echo $bakalawr_ss; ?>">                
                </div>
              </div>
              <div class="row">
                <div class="col-md-2 mb-3">
                  <label><br></label>
                  <h4>Podkurs:</h4>                
                </div>
                <div class="col-md-2 mb-3">
                  <label for="fak">Ýarym ýyllyk</label>
                  <select class="custom-select d-block w-100" id="fak" name="podkurs_yy" required>
                    <option value="1" <?php if ($podkurs_yy=='1') echo 'selected="selected"'; ?> >1-nji</option>
                    <option value="2" <?php if ($podkurs_yy=='2') echo 'selected="selected"'; ?> >2-nji</option>
                    <option value="3" <?php if ($podkurs_yy=='3') echo 'selected="selected"'; ?> >3-nji</option>
                  </select>                
                </div>
                <div class="col-md-2 mb-3">
                  <label for="adsorsan">Aralyk jemleme</label>
                  <select class="custom-select d-block w-100" id="fak" name="podkurs_aj" required>
                    <option value="1" selected="selected">Synag</option>
                  </select>      
                </div>
                <div class="col-md-2 mb-">
                  <label for="bakarj">Sorag sany</label>
                  <input type="number"  class="form-control"  id="bakarj" name="podkurs_ss" max="75" value="<?php echo $podkurs_ss; ?>">                
                </div>
              </div>
              <button class="btn btn-primary btn-block col-md-8 mb-3" type="submit" id="sub" name="dmsub">Tassyklamak</button>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
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
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="plugins/form-validation.js"></script>
</body>
</html>
