<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ulgamdakylar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php 
    include "header.php";
  ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ulgamdakylar</h1>
          </div>          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">            
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body p-0">
                <table class="table table-head-fixed text-nowrap" id="ulanyjylar">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Familiýasy</th>
                      <th>Ady</th>
                      <th>Hünäri</th>
                      <th>Giren senesi</th>
                      <th>Giren wagty</th>
                      <th>IP salgysy</th>
                      <!-- <th>Aýyrmak</th> -->
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    include "dbcon.php";
                    $i=0;
                    $query=mysqli_query($con,"SELECT * FROM red_users");
                     while($ret=mysqli_fetch_array($query)){
                        $ulan_id=$ret['ulanyjy_id'];
                        $query_talyp=mysqli_query($con,"SELECT * from talyplar WHERE ulanyjy_id='$ulan_id'");
                        while($row_talyp=mysqli_fetch_array($query_talyp)){ //yalnyshlyk
                          $id_talyp=$row_talyp['id'];
                          $fam=$row_talyp['familiyasy'];
                          $ady=$row_talyp['ady'];
                          $query_toparcha=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar, talyplar WHERE hunarler.id=toparchalar.hunar and talyplar.toparcha=toparchalar.id and talyplar.id='$id_talyp'");
                          while($row_toparcha=mysqli_fetch_array($query_toparcha)){ 
                            $gysga_ady=$row_toparcha['gysga_ady'];
                            $yyl=$row_toparcha['yyl'];
                            $toparcha=$row_toparcha['toparcha'];
                            $gysga_ady=$gysga_ady." ".$yyl."0".$toparcha;
                          }
                          
                         $query2=mysqli_query($con,"SELECT * FROM red_list WHERE ulanyjy_id=$ulan_id");
                         while($ret2=mysqli_fetch_array($query2)){
                           $i++;
                          $gwagt=$ret2['gwagt'];
                          $gsene=$ret2['sene'];
                          $ip=$ret2['ip'];
                    ?>
                        <tr>
                          <td><?=$i?></td>
                          <td><?=$fam?></td>
                          <td><?=$ady?></td>
                          <td><?=$gysga_ady?></td>
                          <td><?=$gsene?></td>
                          <td><?=$gwagt?></td>
                          <td><?=$ip?></td>
                          <!-- <td><button data-id=".$id." class='ochurmek btn-sm btn-danger'><i class='fas fa-trash'></i></button></td> -->
                        </tr> 
                    <?php
                         } 
                        }
                       }
                    ?>                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
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
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script type="text/javascript" src="text/jquery.autocomplete.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

   // Delete 
  $('.ochurmek').click(function(){
      var el = this;

      var deleteid = $(this).data('id');
        // AJAX Request
        $.ajax({
          url: 'delete_online.php',
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
