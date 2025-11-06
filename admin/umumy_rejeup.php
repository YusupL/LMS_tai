<?php
	include "dbcon.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Umumy reje</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/ionicons.min.css">  
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">  

  <link rel="stylesheet" href="plugins/form-validation.css">
  <link rel="stylesheet" type="text/css" href="text/jquery.autocomplete.css" />
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php include "header.php"; ?>
  	
  	<div class="content-wrapper" style="padding-top: 20px;">
  		<!-- Main content -->
      <?php
        include '../dbconnection.php';
        $query_fakul=mysqli_query($con,"SELECT * FROM fakultetler");
        while ($row_fakul=mysqli_fetch_array($query_fakul)){
          $fak_id=$row_fakul['id'];
          for ($yyl=1; $yyl<=5; $yyl++){
          	if ($yyl==4 && $fak_id==2) { 
            ?>
              <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title"><?php echo $row_fakul['ady']." ".$yyl; ?></h3>
                        </div>
                          <div class="card-body">

                            <table class="table table-bordered table-responsive">
                              <thead>
                                <tr>
                                  <th style="width: 10px;">#</th>
                                  <td style="width: 20px">Jubut</td>
                                  <?php
                                    $query_toparcha=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, toparchalar.id FROM hunarler, toparchalar WHERE hunarler.id=toparchalar.hunar AND hunarler.fakultet='$fak_id' AND toparchalar.yyl='$yyl'");
                                    while ($row_toparcha=mysqli_fetch_array($query_toparcha)) {
                                      ?>
                                        <th><?php echo $row_toparcha['gysga_ady']." ".$row_toparcha['yyl']."0".$row_toparcha['toparcha']; ?></th>
                                      <?php
                                    }
                                  ?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  for ($gun=4; $gun<=4; $gun++){?>
                                      
                                    <?php
                                    for ($jubut=1; $jubut<=3; $jubut++){
                                      ?>
                                      <tr>
                                        <td class="align-middle"><?php echo $gun; ?></td>
                                        <td class="align-middle text-center"><?php echo $jubut; ?></td>
                                        <?php
                                          $query_toparcha=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, toparchalar.id  FROM hunarler, toparchalar WHERE hunarler.id=toparchalar.hunar AND hunarler.fakultet='$fak_id' AND toparchalar.yyl='$yyl'");
                                          while ($row_toparcha=mysqli_fetch_array($query_toparcha)) {
                                            $toparcha_id=$row_toparcha['id']; 
                                            ?>
                                            <td>
                                              <form method="POST" action="add_umumy_reje.php">
                                                <input type="hidden" name="gun" value='<?php echo $gun; ?>'>
                                                <input type="hidden" name="jubut" value='<?php echo $jubut; ?>'>
                                                <input type="hidden" name="toparcha_id" value='<?php echo $toparcha_id; ?>'>
                                                <input type="hidden" name="s_m" value='1'>
                                                <select class="form-control" name='ders'>
                                                  <?php
                                                    $query_ders=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady, mugallymlar.familiyasy, mugallymlar.ady, mugallymlar.atasynyn_ady, ders_gornushi.ady AS ders_gor_ady, ders_maglumat.toparcha_id, ders_maglumat.id AS ders_mag_id FROM ders_atlary, mugallymlar, ders_maglumat, ders_gornushi WHERE ders_maglumat.mug_id=mugallymlar.id AND ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.gornushi=ders_gornushi.id AND ders_maglumat.toparcha_id='$toparcha_id' ORDER BY ders_atlary.ady");
                                                    while ($row_ders=mysqli_fetch_array($query_ders)) {
                                                      ?>
                                                        <option <?php echo 'value='.$row_ders['ders_mag_id']; ?>> <?php echo "<b>".$row_ders['ders_ady']."</b> ".$row_ders['familiyasy']." ".$row_ders['ady']." ".$row_ders['atasynyn_ady']." (".$row_ders['ders_gor_ady'].")"; ?> </option>
                                                      <?php
                                                    }
                                                  ?>
                                                </select>
                                                <select class="form-control" name='otag'>
                                                  <?php
                                                    $query_otag=mysqli_query($con, "SELECT * FROM otaglar");
                                                    while ($row_otag=mysqli_fetch_array($query_otag)) {
                                                      ?>
                                                        <option <?php echo 'value='.$row_otag['id']; ?>><?php echo $row_otag['nomer']; ?></option>
                                                      <?php                                                      
                                                    }
                                                  ?>
                                                </select>
                                                <input type="submit" class="form-control" name="submit" value="Tassyklamak">
                                              </form>
                                            </td>
                                            <?php
                                          }
                                        ?>
                                        </tr>                                       
                                      <?php
                                    }
                                    ?>
                                    <?php
                                  }
                                ?>
                              </tbody>
                            </table>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            <?php
        	}
          }
        }
      ?>
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

<script type="text/javascript" src="text/jquery.js"></script>
<script type="text/javascript" src="text/jquery.autocomplete.js"></script>
</body>
</html>
