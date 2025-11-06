<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mugallymlaryň sanawy</title>
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
          $fsql=mysqli_query($con, "SELECT * FROM fakultetler"); 
          while($rfak=mysqli_fetch_array($fsql))
           $fid=$rfak['id'];
           $fady=$rfak['ady'];
        ?>

            <?php
				$qkaf=mysqli_query($con,"SELECT * FROM kafedralar");
				while($rkaf=mysqli_fetch_array($qkaf)){
					$kid=$rkaf['id'];      
            ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-success card-outline collapsed-card">
                    <div class="card-header">
                      <h3 class="card-title text-success card-cursor" data-card-widget="collapse">                    
                        <b><?=$rkaf['ady'].' kafedrasy'?></b>
                      </h3>                    
                    </div>
                    <div class="card-body">
						<table class="table table-sm table-bordered table-striped text-center text-nowrap text-lg w-25" >
							<thead>
								<tr class="align-middle">
								<th class="w-5">T/b</th>
								<th class="w-5">Familiýasy we ady</th>
								<th class="w-5">Derejesi</th>                                               
								</tr>
							</thead>
							<tbody>  
								<?php
									$qmug=mysqli_query($con, "SELECT * FROM mugallymlar WHERE kafedra='$kid' ORDER BY familiyasy");
									$i=0;
									while($rmug=mysqli_fetch_array($qmug)){
										$i++;
                    $dereje=$rmug['mug_dereje'];
								?>			
								<tr>
								<td class="align-middle"><?=$i?></td>
								<td class="text-left align-middle"><?=$rmug['familiyasy'].' '.$rmug['ady']?></td> 
								<td>
                  <?php
                    if($dereje==1) echo "Uly mugallym";
                    if($dereje==2) echo "Mugallym";
                    if($dereje==3) echo "Mugallym-öwreniji";
                  ?>
								</td>                         
								</tr>
								<?php } ?>                             
							</tbody>
						</table>                      
                    </div>
                  </div>
                </div>
              </div>
            <?php }?> 
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
</script>>
</body>
</html>
