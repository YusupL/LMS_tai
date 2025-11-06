<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Çäklendirme</title>
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

  <?php include 'navsidebar.php';?>
 
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">        
        <?php
          $qy=mysqli_query($con, "SELECT DISTINCT yyl FROM saylama"); 
          while($ry=mysqli_fetch_array($qy)){
           $yyl=$ry['yyl'];
        ?>
          <div class="card card-light collapsed-card">
            <div class="card-header text-success">
              <h3 class="card-title text-success card-cursor" data-card-widget="collapse">
                <i class="fas fa-bookmark"></i>
                <b><?=$yyl+1?>-nji ýyl talyplaryň saýlama sapaklary</b>
              </h3>
            </div>
            <div class="card-body">            
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-success card-outline collapsed-card">
                    <div class="card-header">
                      <h3 class="card-title text-success card-cursor" data-card-widget="collapse">                    
                        <b>Salam</b>
                      </h3>                    
                    </div>
                    <div class="card-body p=0">
                                         
                      <table class="table table-bordered text-center text-nowrap text-lg" >
                        <tbody>
                        <?php
                          $qh=mysqli_query($con, "SELECT DISTINCT hunar FROM saylama WHERE yyl='$yyl'");
                          while($rh=mysqli_fetch_array($qh)){
                            $hid=$rh['hunar'];
                            $rha=mysqli_fetch_array(mysqli_query($con, "SELECT ady, gornushi FROM hunarler WHERE id='$hid'"));
                            $hady=$rha['ady'];
                            $hgor=$rha['gornushi'];
                        ?>
                        <tr>
                          <td colspan="4" class="text-bold"><?php echo $hady; if($hgor==1){echo " hünäri";} else {echo " taýýarlyk ugry";} ?></td>
                        </tr>
                      <?php 
                        for ($i=1; $i <= 2 ; $i++) { 
                          $qr=mysqli_query($con, "SELECT * FROM saylama WHERE hunar='$hid' AND yyl='$yyl' AND semestr='$i'");
                          if(mysqli_num_rows($qr)>0){
                      ?>  
                        <!-- <thead>
                          <tr class="align-middle">
                            <th class="w-5">T/b</th>
                            <th class="w-5">Dersiň ady</th>
                            <th class="w-5">Sesleriň sany</th>                                               
                          </tr>
                        </thead> -->
                       
                          <tr>
                            <td colspan="4" class="text-bold"><?=$i?>-nji ýarymýyllyk</td>
                          </tr>
                        <?php 
                          }
                        while($rr=mysqli_fetch_array($qr)){
                        ?>                                      
                          <tr>
                            <td class="align-middle w-50"><?=$rr['first_sub']?></td>
                            <td class="text-left align-middle w-10"><?=$rr['fs_vote']?></td>
                            <td class="text-left align-middle w-10"><?=$rr['ss_vote']?></td>
                            <td class="align-middle w-50"><?=$rr['second_sub']?></td>                       
                          </tr>
                        <?php 
                        }
                        ?>                                    
                        </tbody>
                        <?php   
                    }
                      ?>
                      
            <?php }?> 
                      </table>
                    
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          </div>
        <?php } ?>
      </div>        
    </section>
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
</body>
</html>
