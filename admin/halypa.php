<?php include "dbcon.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Synagyň rejesi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" type="text/css" href="text/jquery.autocomplete.css" />  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php 
		include "header.php"; 
		include "dbconnection.php";
	?>
  	
  	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-1 text-center">
          <div class="col-sm-12">
            <h1 clas>Halypa mugallym</h1>
          </div>          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="tab-content" id="pills-tabContent">
          <!--<div class="tab-pane fade" id="adaty" role="tabpanel" aria-labelledby="adaty-tab">-->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
                    <table class="table table-head-fixed text-nowrap">
                      <thead>
                        <tr>
                          <th>T/b</th>
                          <th>Hunar</th>
                          <th>Toparça</th>
                          <th>Halypa mugallym</th>
                          <th>Tassykla</th>                      
                        </tr>
                      </thead>
                      <tbody>
                      	<?php                      		
                      		$query=mysqli_query($con, "SELECT toparchalar.id, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar WHERE hunarler.id=toparchalar.hunar ORDER BY toparchalar.id DESC");
                      		$i=0;
                      		while ($row=mysqli_fetch_array($query)){ 
                            $i++; ?>
                      			<tr>
		                          <td><?php echo $i; ?></td>
		                          <td><?php echo $row['gysga_ady']; ?></td>
		                          <td><?php echo $row['yyl']."0".$row['toparcha']; ?></td>
		                          <?php
		                          	$toparcha_id=$row['id'];
		                          	?>
                              <td>
                                <select class="form-control" id="ders_id<?php echo $row['id']; ?>">                                
                                <?php
                                  $query_halypa=mysqli_query($con, "SELECT * FROM toparchalar WHERE id='$toparcha_id'");
                                  $row_halypa=mysqli_fetch_array($query_halypa);
                                  $halypa_mug_id=$row_halypa['halypa_mug'];

                                  $query_mugallymlar=mysqli_query($con, "SELECT * FROM mugallymlar ORDER BY mugallymlar.familiyasy");
                                  while ($row_mugallymlar=mysqli_fetch_array($query_mugallymlar)){
                                    ?>
                                      <option <?php if ($halypa_mug_id==$row_mugallymlar['id']) echo "selected='selected'"; ?> value='<?php echo $row_mugallymlar['id']; ?>'>
                                        <?php echo $row_mugallymlar['familiyasy']." ".$row_mugallymlar['ady']; ?>
                                      </option>
                                    <?php
                                  }
                                ?>
                                </select>
                              </td>
		                          <td><button class="btn btn-success tassyk" id="mugallym<?php echo $toparcha_id;?>"><i class="fas fa-check-circle"></i></button></td>
		                        </tr>
                      			<?php
                      		}
                      	?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <!--</div>-->
          
        </div>
      </div>
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

<!-- autocomplete uchin jquery --><script type="text/javascript" src="text/jquery.js"></script>
<script type="text/javascript" src="text/jquery.autocomplete.js"></script>
<!-- jQuery -->

<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>



<script>
    $(document).ready(function(){$("#bders").autocomplete("autocomplete_ders.php", { selectFirst: true }); });
</script>

</body>

<script type="text/javascript">
	$(document).ready(function(){
		$(".tassyk").click(function(){
			var id=$(this).attr('id');
			id=id.substring(8, id.length);
      var mug_id=$("#ders_id"+id).val();
			$.ajax({
				url:"add_halypa_mug.php",
				method:"POST",
				data:{id:id, mug_id:mug_id},
				dataType:"html",
				success:function(data){
					//alert(data);
					//window.location.href='exams.php'
				}
			});
		});
	});
</script>
</html>
