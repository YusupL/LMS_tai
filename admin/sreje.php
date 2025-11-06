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
            <h1 clas>Synag reje</h1>
          </div>          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="adaty-tab" data-toggle="pill" href="#adaty" role="tab" aria-controls="adaty" aria-selected="true">Adaty synag reje</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="bakalawr-tab" data-toggle="pill" href="#bakalawr" role="tab" aria-controls="bakalawr" aria-selected="false">Bakalawr synag reje</a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" id="podkurs-tab" data-toggle="pill" href="#podkurs" role="tab" aria-controls="podkurs" aria-selected="false">Podkurs synag reje</a>
          </li>          
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade" id="adaty" role="tabpanel" aria-labelledby="adaty-tab">
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
                          <th>Başlaýan wagty</th>
                          <th>Tamamlanýan wagty</th>
                          <th>Synag dersi</th>
                          <th>Tassykla</th>                      
                        </tr>
                      </thead>
                      <tbody>
                      	<?php                      		
                      		$query=mysqli_query($con, "SELECT toparchalar.id, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar WHERE hunarler.id=toparchalar.hunar AND hunarler.gornushi='1'");
                      		$i=0;
                      		while ($row=mysqli_fetch_array($query)){ $i++; ?>
                      			<tr>
		                          <td><?php echo $i; ?></td>
		                          <td><?php echo $row['gysga_ady']; ?></td>
		                          <td><?php echo $row['yyl']."0".$row['toparcha']; ?></td>
		                          <?php
		                          	$bashlanyan=""; $gutaryan="";
		                          	$toparcha_id=$row['id'];
		                          	$query_wagt=mysqli_query($con, "SELECT * FROM synag_reje WHERE toparcha_id='$toparcha_id'");
		                          	$row_num=mysqli_num_rows($query_wagt);
		                          	if ($row_num>0){
		                          		while ($row_wagt=mysqli_fetch_array($query_wagt)) {
		                          			$bashlanyan=$row_wagt['bashlayan_wagty'];
		                          			$bashlanyan = strtotime($bashlanyan);
		                          			$bashlanyan = date('Y-m-d\TH:i', $bashlanyan);
		                          			$gutaryan=$row_wagt['gutaryan_wagty'];
		                          			$gutaryan=strtotime($gutaryan);
		                          			$gutaryan=date('Y-m-d\TH:i', $gutaryan);
		                          		}
		                          	}
		                          ?>
		                          <td><input type="datetime-local" class="form-control" id="bashlanyan<?php echo $row['id']; ?>" <?php if ($bashlanyan!=""){?> value="<?php echo $bashlanyan; ?>" <?php } ?> ></td>

		                          <td><input type="datetime-local" class="form-control" id="gutaryan<?php echo $row['id']; ?>" <?php if ($gutaryan!=""){?> value="<?php echo $gutaryan; ?>" <?php } ?> ></td>
                              <td>
                                <select class="form-control" id="ders_id<?php echo $row['id']; ?>">
                                
                                <?php
                                  $query_reje=mysqli_query($con, "SELECT * FROM synag_reje WHERE toparcha_id='$toparcha_id'");
                                  $row_reje=mysqli_fetch_array($query_reje);
                                  $d_i=$row_reje['ders_id'];

                                  $query_sapaklar=mysqli_query($con, "SELECT ders_maglumat.id AS ders_id, ders_atlary.ady AS ders_ady FROM ders_maglumat, ders_atlary, ders_potok WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.id=ders_potok.ders_maglumat_id AND ders_potok.toparcha_id='$toparcha_id' AND (ders_maglumat.synag_degish='1' OR ders_maglumat.ara_syn_deg='1')");
                                  while ($row_sapaklar=mysqli_fetch_array($query_sapaklar)){
                                    ?>
                                      <option <?php if ($d_i==$row_sapaklar['ders_id']) echo "selected='selected'"; ?> value='<?php echo $row_sapaklar['ders_id']; ?>'>
                                        <?php echo $row_sapaklar['ders_ady']; ?>
                                      </option>
                                    <?php
                                  }
                                ?>
                                </select>
                              </td>

		                          <td><button class="btn btn-success tassyk" id="toparcha<?php echo $row['id'];?>"><i class="fas fa-check-circle"></i></button></td>
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
          </div>
          <div class="tab-pane fade" id="bakalawr" role="tabpanel" aria-labelledby="bakalawr-tab">
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
                          <th>Başlaýan wagty</th>
                          <th>Tamamlanýan wagty</th>
                          <th>Synag dersi</th>
                          <th>Tassykla</th>                      
                        </tr>
                      </thead>
                      <tbody>
                      	<?php                      		
                      		$query=mysqli_query($con, "SELECT toparchalar.id, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar WHERE hunarler.id=toparchalar.hunar AND hunarler.gornushi='2'");
                      		$i=0;
                      		while ($row=mysqli_fetch_array($query)){ $i++; ?>
                      			<tr>
		                          <td><?php echo $i; ?></td>
		                          <td><?php echo $row['gysga_ady']; ?></td>
		                          <td><?php echo $row['yyl']."0".$row['toparcha']; ?></td>
		                          <?php
		                          	$bashlanyan=""; $gutaryan="";
		                          	$toparcha_id=$row['id'];
		                          	$query_wagt=mysqli_query($con, "SELECT * FROM synag_reje WHERE toparcha_id='$toparcha_id'");
		                          	$row_num=mysqli_num_rows($query_wagt);
		                          	if ($row_num>0){
		                          		while ($row_wagt=mysqli_fetch_array($query_wagt)) {
		                          			$bashlanyan=$row_wagt['bashlayan_wagty'];
		                          			$bashlanyan = strtotime($bashlanyan);
		                          			$bashlanyan = date('Y-m-d\TH:i', $bashlanyan);
		                          			$gutaryan=$row_wagt['gutaryan_wagty'];
		                          			$gutaryan=strtotime($gutaryan);
		                          			$gutaryan=date('Y-m-d\TH:i', $gutaryan);
		                          		}
		                          	}
		                          ?>
		                          <td><input type="datetime-local" class="form-control" id="bashlanyan<?php echo $row['id']; ?>" <?php if ($bashlanyan!=""){?> value="<?php echo $bashlanyan; ?>" <?php } ?> ></td>

		                          <td><input type="datetime-local" class="form-control" id="gutaryan<?php echo $row['id']; ?>" <?php if ($gutaryan!=""){?> value="<?php echo $gutaryan; ?>" <?php } ?> ></td>
                              <td>
                                <select class="form-control" id="ders_id<?php echo $row['id']; ?>">
                                
                                <?php
                                  $query_reje=mysqli_query($con, "SELECT * FROM synag_reje WHERE toparcha_id='$toparcha_id'");
                                  $row_reje=mysqli_fetch_array($query_reje);
                                  $d_i=$row_reje['ders_id'];

                                  $query_sapaklar=mysqli_query($con, "SELECT ders_maglumat.id AS ders_id, ders_atlary.ady AS ders_ady FROM ders_maglumat, ders_atlary, ders_potok WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.id=ders_potok.ders_maglumat_id AND ders_potok.toparcha_id='$toparcha_id' ANd (ders_maglumat.synag_degish='1' OR ders_maglumat.ara_syn_deg='1')");
                                  while ($row_sapaklar=mysqli_fetch_array($query_sapaklar)){
                                    ?>
                                      <option <?php if ($d_i==$row_sapaklar['ders_id']) echo "selected='selected'"; ?> value='<?php echo $row_sapaklar['ders_id']; ?>'>
                                        <?php echo $row_sapaklar['ders_ady']; ?>
                                      </option>
                                    <?php
                                  }
                                ?>
                                </select>
                              </td>

		                          <td><button class="btn btn-success tassyk" id="toparcha<?php echo $row['id'];?>"><i class="fas fa-check-circle"></i></button></td>
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
          </div>
          <div class="tab-pane fade" id="podkurs" role="tabpanel" aria-labelledby="podkurs-tab">
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
                          <th>Başlaýan wagty</th>
                          <th>Tamamlanýan wagty</th>
                          <th>Tassykla</th>                      
                        </tr>
                      </thead>
                      <tbody>
                      	<?php                      		
                      		$query=mysqli_query($con, "SELECT toparchalar.id, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar WHERE hunarler.id=toparchalar.hunar AND hunarler.gornushi='3'");
                      		$i=0;
                      		while ($row=mysqli_fetch_array($query)){ $i++; ?>
                      			<tr>
		                          <td><?php echo $i; ?></td>
		                          <td><?php echo $row['gysga_ady']; ?></td>
		                          <td><?php echo $row['yyl']."0".$row['toparcha']; ?></td>
		                          <?php
		                          	$bashlanyan=""; $gutaryan="";
		                          	$toparcha_id=$row['id'];
		                          	$query_wagt=mysqli_query($con, "SELECT * FROM synag_reje WHERE toparcha_id='$toparcha_id'");
		                          	$row_num=mysqli_num_rows($query_wagt);
		                          	if ($row_num>0){
		                          		while ($row_wagt=mysqli_fetch_array($query_wagt)) {
		                          			$bashlanyan=$row_wagt['bashlayan_wagty'];
		                          			$bashlanyan = strtotime($bashlanyan);
		                          			$bashlanyan = date('Y-m-d\TH:i', $bashlanyan);
		                          			$gutaryan=$row_wagt['gutaryan_wagty'];
		                          			$gutaryan=strtotime($gutaryan);
		                          			$gutaryan=date('Y-m-d\TH:i', $gutaryan);
		                          		}
		                          	}
		                          ?>
		                          <td><input type="datetime-local" class="form-control" id="bashlanyan<?php echo $row['id']; ?>" <?php if ($bashlanyan!=""){?> value="<?php echo $bashlanyan; ?>" <?php } ?> ></td>

		                          <td><input type="datetime-local" class="form-control" id="gutaryan<?php echo $row['id']; ?>" <?php if ($gutaryan!=""){?> value="<?php echo $gutaryan; ?>" <?php } ?> ></td>

		                          <td><button class="btn btn-success tassyk" id="toparcha<?php echo $row['id'];?>"><i class="fas fa-check-circle"></i></button></td>
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
          </div>
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
			var bashlanyan=$("#bashlanyan"+id).val();
			var gutaryan=$("#gutaryan"+id).val();
      var ders_id=$("#ders_id"+id).val();
      // alert(ders_id);

			$.ajax({
				url:"add_reje.php",
				method:"POST",
				data:{id:id, bashlanyan:bashlanyan, gutaryan:gutaryan, ders_id:ders_id},
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
