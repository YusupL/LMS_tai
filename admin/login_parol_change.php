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
            <h1>Login parol uytgetmek</h1>
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
                      <th>id</th>
                      <th>Familiýasy</th>
                      <th>Ady</th>
                      <th>Hünäri</th>
                      <th>login</th>
                      <th>parol</th>
                      <th>taz_login</th>
                      <th>taz_parol</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      //header('Content-Type: text/html; charset=utf-8');
                      include "dbcon.php";
                      $query=mysqli_query($con,"SELECT ulanyjylar.id, ulanyjylar.login, ulanyjylar.parol, talyplar.ady, talyplar.familiyasy, talyplar.atasynyn_ady, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM ulanyjylar, talyplar, hunarler, toparchalar WHERE ulanyjylar.id=talyplar.ulanyjy_id AND toparchalar.id=talyplar.toparcha and hunarler.id=toparchalar.hunar and toparchalar.yyl='1' AND ulanyjylar.id>=1400 AND ulanyjylar.id<1500 ORDER BY toparchalar.id");
                        while ($row=mysqli_fetch_array($query)){
                          $id_ulan=$row['id'];
                          $fam=$row['familiyasy'];
                          $ady=$row['ady'];
                          $taz_login=$ady[0].$fam;

                          $taz_parol="";
                          $ch='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                          $chl=strlen($ch);
                          for ($i=0; $i<8; $i++){
                            $taz_parol.=$ch[rand(0, $chl-1)];
                          }

                          echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['familiyasy']."</td>
                            <td>".$row['ady']."</td>
                            <td>".$row['gysga_ady'].$row['yyl']."0".$row['toparcha']."</td>
                            <td>".$row['login']."</td>
                            <td>".$row['parol']."</td>
                            <td>".$taz_login."</td>
                            <td>".$taz_parol."</td>
                          </tr>";

                          //mysqli_query($con, "UPDATE ulanyjylar SET login='$taz_login' WHERE id='$id_ulan'");
                          //mysqli_query($con, "UPDATE ulanyjylar SET parol='$taz_parol' WHERE id='$id_ulan'");
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
