<?php
  date_default_timezone_set("Asia/Ashgabat");
  $bashlan_wagt=date("H:i:s");

  include '../dbconnection.php';
  include '../admin/functions.php';
  session_start();
  $id_ulanyjy=$_SESSION['id'];  
  $id_talyp=$_SESSION['id_talyp'];
  $yy=$_SESSION['yy'];
  $aj=$_SESSION['aj'];
  $ss=$_SESSION['ss'];
  $ders_id=$_POST['ders_id'];
  $ders_ady=$_POST['ders_ady'];
  $query=mysqli_query($con, "SELECT id_test FROM synag_test_ders_magl WHERE id_ders_maglumat='$ders_id'");
  $row=mysqli_fetch_array($query);
  $id_test=$row['id_test'];
  $query2=mysqli_query($con, "SELECT * FROM synag_test_jogap WHERE id_test='$id_test'");
  $sany=mysqli_num_rows($query2);
  $tsan=intdiv($sany,15);
  if ($sany%15>0) $tsan++;
  $i=0;
  while ($row_test=mysqli_fetch_array($query2)) {
      $i++;
      $ques_ans[$i][1]=$row_test['sorag'];
      $ques_ans[$i][2]=$row_test['jogap1'];
      $ques_ans[$i][3]=$row_test['jogap2'];
      $ques_ans[$i][4]=$row_test['jogap3'];
      $ques_ans[$i][5]=$row_test['jogap4'];
  }
  $ques = range(1, $sany);
  shuffle($ques);
  $i=0;
  foreach ($ques as $ques_num) {
    $i++;
    $rand[$i][1]=$ques_num;
    $ans = range(1, 4);
    shuffle($ans);
    $j=1;
    foreach ($ans as $ans_num) {
        $j++;
        $rand[$i][$j]=$ans_num;
    }
  }
  $b_j="";
  $t_s="";
  //aabcccbaaccbbcd
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Test geçmek</title>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../teacher/dist/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../teacher/dist/adminlte.css">
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
   
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$ders_ady?></h1>
          </div>         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Bölümler</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <?php 
                    for ($i=1; $i <= $tsan; $i++) { 
                  ?> 
                      <li class="nav-item"><a class="nav-link <?php if ($i==1) echo "active" ?>" href="#tab_<?=$i?>" data-toggle="tab">Bölüm <?=$i?></a></li> 
                  <?php 
                  }
                  ?>                                   
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body direct-chat-messages">
                <div class="tab-content">
                  <?php
                    $k=1; 
                    for ($i=1; $i <= $tsan; $i++) {
                  ?>
                  <div class="tab-pane <?php if ($i==1) echo "active" ?>" id="tab_<?=$i?>">
                    <?php 
                    for ($j=$k; ($j<=$k+14)&&($j<=$sany); $j++){
                      $sorag=$ques_ans[$rand[$j][1]][1]; $t_s.=$rand[$j][1]."-";
                      $jogap1=$ques_ans[$rand[$j][1]][$rand[$j][2]+1]; if ($rand[$j][2]==1) $b_j.='a';
                      $jogap2=$ques_ans[$rand[$j][1]][$rand[$j][3]+1]; if ($rand[$j][3]==1) $b_j.='b';
                      $jogap3=$ques_ans[$rand[$j][1]][$rand[$j][4]+1]; if ($rand[$j][4]==1) $b_j.='c';
                      $jogap4=$ques_ans[$rand[$j][1]][$rand[$j][5]+1]; if ($rand[$j][5]==1) $b_j.='d';
                    ?>                    
                      <div class="row justify-content-center">
                        <div class="col-md-10">
                          <div class="card card-light" id="sorag_<?=$j?>">
                            <div class="card-header">
                              <h4 class="card-title"><?=$j?>-nji(y) sorag</h4>
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
                                        <div class="col-md-12" id="">
                                          <?php echo "<b>".$sorag."</b>"; ?>
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
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="radio<?=$j?>" value="a">                          
                                        </div>
                                        </div>
                                        <div class="col-md-11" id="">
                                          <?php echo $jogap1; ?>
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
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radio<?=$j?>" value="b">                          
                                          </div>
                                        </div>
                                        <div class="col-md-11" id="">
                                          <?php echo $jogap2; ?>
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
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radio<?=$j?>" value="c">                          
                                          </div>
                                        </div>
                                        <div class="col-md-11" id="">
                                          <?php echo $jogap3; ?>
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
                                          <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radio<?=$j?>" value="d">                          
                                          </div>
                                        </div>
                                        <div class="col-md-11" id="">
                                          <?php echo $jogap4; ?>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                                  <!-- /.card -->
                                </div>
                              </div>
                              <!-- /.row -->
                            </div>
                          </div> 
                        </div>
                      </div>
                      <?php                        
                      }
                      $k=$j;
                    if ($tsan==$i){ ?>
                      <div class="row justify-content-center">                                                  
                          <input type="submit" id="submit" value="Testi tamamlamak" class="btn btn-success btn-lg">                        
                      </div>
                    <?php 
                    }
                    ?>                    
                  </div>
                  <!-- /.tab-pane -->
                  <?php 
                    }                   
                  ?>                  
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->   
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0-rc
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../teacher/dist/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../teacher/dist/bootstrap.bundle.js"></script>
<!-- AdminLTE App -->
<script src="../teacher/dist/adminlte.js"></script>
<script>  
  var jt=[];
  jt.length=<?=$sany?>+1;
  jt.fill(0);

  $('[type=radio]').change(function(){
    var nam=$(this).attr('name');    
    name=nam.substring(5, nam.length);
    jt[name]=$(this).val();
    $('#sorag_'+name).removeClass('card-light').addClass('card-success');
    $('[name='+nam+']').attr('disabled', 'disabled');
  });

  $('#submit').click(function(){
    var jtt=jt.join("");
    jtt=jtt.substring(1);
    var a_j=<?=$aj?>;
    var id_t=<?=$id_talyp?>;
    var d_id=<?=$ders_id?>;
    var b_w='<?=$bashlan_wagt?>';
    var b_j='<?=$b_j?>';
    var t_s='<?=$t_s?>';
    $.ajax({  
      url:"atj.php",  
      method:"POST",  
      data:{jtt: jtt, a_j: a_j, id_t: id_t, b_w: b_w, d_id: d_id, t_s: t_s, b_j: b_j},
      dataType:"html",  
      success:function(data){
          window.location.href='examtest.php';
      }  
    });
  });


</script>
</body>
</html>
