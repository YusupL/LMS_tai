<?php
    include '../dbconnection.php';
    session_start();
    $id_ulanyjy=$_SESSION['id'];    
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Baş sahypa</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

     <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
  
    <link href="assets/css/main.css" rel="stylesheet" />
     <!--     Fonts and icons     -->
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">
    
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>
	<div class="wrapper">
	    <div class="sidebar" data-color="green" data-image="assets/img/sidebar-5.jpg">
	    	<div class="sidebar-wrapper">
	            <div class="logo">
					<div class="simple-text">
	                    ŞAHSY OTAG
					</div>
	            </div>

	            <ul class="nav">
	                <li>
	                    <a href="main_page.php">
	                        <i class="fa fa-home"></i>
	                        <p>Baş sahypa</p>
	                    </a>
	                </li>
	                <li class="active">
	                    <a href="upload_test.php">
	                        <i class="fas fa-upload"></i>
	                        <p>Test ýüklemek</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="test_setting.php">
	                        <i class="fas fa-cogs"></i>
	                        <p>Test sazlama</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="result_test.php">
	                        <i class="fas fa-poll"></i>
	                        <p>Test netije</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="points.php">
	                        <i class="fas fa-chart-pie"></i>
	                        <p>Ballar</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="zhurnal.php">
	                        <i class="fas fa-receipt"></i>
	                        <p>Žurnal</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="restrictions.php">
	                        <i class="fas fa-times-circle"></i>
	                        <p>Çäklendirme</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="timetable.php">
	                        <i class="fa fa-table"></i>
	                        <p>Reje</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="tutoring.php">
	                        <i class="fas fa-users"></i>
	                        <p>Halypaçylyk</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="exam.php">
	                        <i class="fa fa-tasks"></i>
	                        <p>Attestasiýa</p>
	                    </a>
	                </li>
	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel">
	        <?php include 'navbar.php' ?>      
	        <div class="container-fluid">
	            <br>
	            <div class="card" style="background-color: #EAECEE; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
	                <div class="card-header" style="background-color: #FCF5BA;">
	                    <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; padding: 7px;">Ball goşmak</h3>
	                </div>
	                <div class="card-body">
	                	<div class="container-fluid">
		                	<form>
							  <div class="form-row">
							  	<?php 
							  		$query=mysqli_query($con, "SELECT * FROM bolum");
							  		$bs=mysqli_num_rows($query);
							  	?>
							    <div class="form-group col-md-3">
							      <label for="bolum">Bölümi saýlaň</label>
							      <select id="bolum" name="bolum" class="form-control">
							        <option>Bölümi saýlaň</option>
							        <?php 
							        	if ($bs>0){
							        		while ($row=mysqli_fetch_array($query)){ ?>

							        		}
							        	}
							        ?>
							      </select>
							    </div>
							    <div class="form-group col-md-3">
							      <label for="inputState">Görnüşini saýlaň</label>
							      <select id="inputState" class="form-control">
							        <option selected>.....</option>
							        <option>...</option>
							      </select>
							    </div>
							    <div class="form-group col-md-2">
							      	<label for="inputAddress">Senesini saýlaň</label>
							    	<input type="date" class="form-control" id="inputAddress" placeholder="1234 Main St">
							    </div>
							    <div class="form-group col-md-4">
							      	<label>Bellik</label>
		                        	<textarea class="form-control" rows="1"></textarea>
							    </div>
							  </div>
							</form>
						</div>
	        		</div>
	    		</div>
	    		<div class="card" style="background-color: #EAECEE; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
	                <div class="card-header" style="background-color: #FCF5BA;">
	                    <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; padding: 7px;">Jemi toplan ballarym</h3>
	                </div>
	                <div class="card-body">
	                	<div class="container-fluid">
		                	<form>
							  <div class="form-row">							  	
							    <div class="form-group col-md-3">
							      <label for="bolum">Bölümi saýlaň</label>
							      <select id="bolum" name="bolum" class="form-control">
							        <option selected>.....</option>
							        <option>...</option>
							      </select>
							    </div>
							    <div class="form-group col-md-3">
							      <label for="inputState">Görnüşini saýlaň</label>
							      <select id="inputState" class="form-control">
							        <option selected>.....</option>
							        <option>...</option>
							      </select>
							    </div>
							    <div class="form-group col-md-2">
							      	<label for="inputAddress">Senesini saýlaň</label>
							    	<input type="date" class="form-control" id="inputAddress" placeholder="1234 Main St">
							    </div>
							    <div class="form-group col-md-4">
							      	<label>Bellik</label>
		                        	<textarea class="form-control" rows="1"></textarea>
							    </div>
							  </div>
							</form>
						</div>
	        		</div>
	    		</div>
	    	</div>
	    </div>
	</div>
</body>
    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
    <script type="text/javascript">
		$(document).ready(function(){
		    $('#country').on('change',function(){
		        var countryID = $(this).val();
		        if(countryID){
		            $.ajax({
		                type:'POST',
		                url:'ajaxFile.php',
		                data:'country_id='+countryID,
		                success:function(html){
		                    $('#state').html(html);
		                    $('#city').html('<option value="">Select state first</option>'); 
		                }
		            }); 
		        }else{
		            $('#state').html('<option value="">Select country first</option>');
		            $('#city').html('<option value="">Select state first</option>'); 
		        }
		    });
		    
		    $('#state').on('change',function(){
		        var stateID = $(this).val();
		        if(stateID){
		            $.ajax({
		                type:'POST',
		                url:'ajaxFile.php',
		                data:'state_id='+stateID,
		                success:function(html){
		                    $('#city').html(html);
		                }
		            }); 
		        }else{
		            $('#city').html('<option value="">Select state first</option>'); 
		        }
		    });
		});
	</script>
</html>
