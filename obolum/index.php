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
          $strquery=mysqli_fetch_array(mysqli_query($con, "SELECT * FROM synag_tapgyr where gornush=1"));
          $aj=$strquery['aralyk_jemleme'];
          $fsql=mysqli_query($con, "SELECT * FROM fakultetler"); 
          while($rfak=mysqli_fetch_array($fsql)){
           $fid=$rfak['id'];
           $fady=$rfak['ady'];
        ?>
          <div class="card card-light collapsed-card">
            <div class="card-header text-success">
              <h3 class="card-title text-success card-cursor" data-card-widget="collapse">
                <i class="fas fa-bookmark"></i>
                <b><?=$fady;?></b>
              </h3>
            </div>
            <div class="card-body">
            <?php
              for($i=1;$i<=5;$i++){
            ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-success card-outline collapsed-card">
                    <div class="card-header">
                      <h3 class="card-title text-success card-cursor" data-card-widget="collapse">                    
                        <b><?=$i;?>-nji kurs talyplar</b>
                      </h3>                    
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <?php
                            $hsql=mysqli_query($con,"SELECT toparchalar.id as top_id,toparchalar.yyl as yyly, toparchalar.toparcha as toparcha,hunarler.ady as hun_ady FROM toparchalar,hunarler WHERE hunarler.fakultet=$fid AND toparchalar.yyl=$i AND toparchalar.hunar=hunarler.id");
                            while($rhun=mysqli_fetch_array($hsql)){
                            $tid=$rhun['top_id'];
                            $tyyly=$rhun['yyly'];
                            $toparcha=$rhun['toparcha'];
                            $hady=$rhun['hun_ady'];  
                          ?>
                          <div class="card card-success card-outline collapsed-card">
                            <div class="card-header">
                              <h3 class="card-title text-success card-cursor" data-card-widget="collapse">                    
                                <b><?php echo $hady;?></b>
                                <?php echo " hünäriniň ".$tyyly."0".$toparcha."-nji toparçasy";?>
                              </h3>                    
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <table class="table table-sm table-bordered table-striped text-center text-nowrap text-lg w-25" >
                                <thead>
                                  <tr class="align-middle">
                                    <th class="w-5">T/b</th>
                                    <th class="w-5">Familiýasy we ady</th>
                                    <th class="w-5"><?=$aj?>-nji aralyk synag</th>                                               
                                  </tr>
                                </thead>
                                <tbody>  
                                  <?php 
                                    $talsql=mysqli_query($con,"SELECT * FROM `talyplar` WHERE toparcha=$tid");
                                    $j=0;
                                    while($rtal=mysqli_fetch_array($talsql)){
                                      $j++;
                                      $talyp_id=$rtal['id'];
                                      $tady=$rtal['ady'];
                                      $tfam=$rtal['familiyasy'];
                                      $query_tick=mysqli_query($con, "SELECT id FROM chaklendirme WHERE talyp_id='$talyp_id' AND aralyk_jemleme='$aj'");
                                      $sany=mysqli_num_rows($query_tick);
                                      $chbox="";
                                      if ($sany>0) $chbox="checked";
                                  ?>                
                                  <tr>
                                    <td class="align-middle"><?=$j?></td>
                                    <td class="text-left align-middle"><?php echo $tfam."  ".$tady?></td> 
                                    <td>
                                      <div class="form-group">
                                        <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input custom-control-input-danger" id="<?=$talyp_id."-".$aj."-".$tid;?>" <?=$chbox?>>
                                        <label class="custom-control-label align-middle" for="<?=$talyp_id."-".$aj."-".$tid;?>"></label>
                                        </div>
                                      </div>
                                    </td>                         
                                  </tr>                                        
                                  <?php 
                                    }  
                                  ?>                                    
                                </tbody>
                              </table>  
                            </div>
                            <!-- /.card-body -->
                          </div>
                            <?php }    ?>
                        </div>                     
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php }?> 
            </div> 
          </div>
        <?php } ?>
        <!-- Test yuklemek bolumini gutaryan yeri -->
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
<script type="text/javascript">
  $('input:checkbox').on('change',function() {
    var id=$(this).attr('id');
    ids=id.split('-');
    var talyp_id=ids[0];
    var aj=ids[1];
    var toparcha=ids[2];
    $.ajax({
      url:"chaklendirmek.php",
      method:"POST",
      data:{talyp_id:talyp_id, aj:aj, toparcha:toparcha},
      dataType:"html",      
    });
  });
</script>>
</body>
</html>
