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
                <li>
                    <a href="up_test.php">
                        <i class="fas fa-upload"></i>
                        <p>Test ýüklemek</p>
                    </a>
                </li>
                <li>
                    <a href="settest.php">
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
                <?php 
                    $qmenyu=mysqli_query($con, "SELECT * FROM kafedralar WHERE kaf_mudir='$id_ulanyjy'"); 
                    if (mysqli_num_rows($qmenyu)>0){
                ?>
                    <li>
                        <a href="mugbal.php">
                            <i class="fa fa-tasks"></i>
                            <p>Mugallymyň ballary</p>
                        </a>
                    </li>
                <?php     
                    }
                ?>
                <li class="nav-item">
                    <a href="balgos.php" class="nav-link" style="color: white;">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p class="font-weight-bold">
                            Derejeleýin bahalandyrmak
                        </p>
                    </a>
                </li>
                <?php 
                    if (($id_ulanyjy==228)||($id_ulanyjy==137)||($id_ulanyjy==226)){
                ?>
                <li class="nav-item">
                    <a href="fakultet.php" class="nav-link" style="color: white;">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p class="font-weight-bold">
                            Fakultetler boýunça
                        </p>
                    </a>
                </li>
                <?php 
                    }
                ?>
            </ul>            
    	</div>
    </div>

    <div class="main-panel">
<nav class="navbar navbar-default navbar-fixed">
	<?php
	    include '../dbconnection.php';
	    $id_ulanyjy=$_SESSION['id'];
	    $query=mysqli_query($con, "SELECT mugallymlar.familiyasy AS familiyasy, mugallymlar.ady AS ady, mugallymlar.atasynyn_ady AS atasynyn_ady, kafedralar.ady AS kafedra FROM mugallymlar, kafedralar WHERE mugallymlar.kafedra=kafedralar.id AND ulanyjy_id='$id_ulanyjy'");
	    while ($row=mysqli_fetch_array($query)) {
	        $familiya=$row['familiyasy'];
	        $ady=$row['ady'];
	        $aady=$row['atasynyn_ady'];
	        $kafedra=$row['kafedra'];
	    }
	?>

	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse"></div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<h4 style="margin-left: 10px;"><b><?php echo $familiya." ".$ady." ".$aady ?></b></h4>
		</div>
		<div class="col-lg-6">
			<h4><?php echo $kafedra; ?></h4>
		</div>
		<div class="col-lg-1">
			<img src="img/1.jpg" style="max-width: 50px; border-radius: 50%;">
		</div>
		<div class="col-lg-1">
			<a href="../logout.php" style="color: green;">
				<p style="margin-top: 10px; font-size: 18px;"><i class="fas fa-sign-out-alt"></i>  Çykmak</p>
			</a>
		</div>
	</div>
</nav>