<?php
    include '../dbconnection.php';
    $id_ulanyjy=$_SESSION['id'];
    $query=mysqli_query($con, "SELECT talyplar.familiyasy AS familiyasy, talyplar.ady AS ady, talyplar.atasynyn_ady AS atasynyn_ady, hunarler.gysga_ady AS hunar, toparchalar.yyl AS yyl, toparchalar.toparcha AS toparcha, hunarler.gornushi AS gornushi FROM talyplar, hunarler, toparchalar WHERE talyplar.toparcha=toparchalar.id AND toparchalar.hunar=hunarler.id AND talyplar.ulanyjy_id='$id_ulanyjy'");
    while ($row=mysqli_fetch_array($query)) {
        $familiya=$row['familiyasy'];
        $ady=$row['ady'];
        $aady=$row['atasynyn_ady'];
        $toparcha=$row['hunar'].$row['yyl']."0".$row['toparcha'];
        $hun_gor=$row['gornushi'];
    }
?>
<nav class="navbar navbar-default navbar-fixed">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse">
	</div>
	<div class="row">
		<div class="col-lg-6">
			<h4><b><?php echo $familiya." ".$ady." ".$aady ?></b></h4>
		</div>
		<div class="col-lg-4">
			<h4><?php echo $toparcha; ?></h4>
		</div>
		<div class="col-lg-1">
			<img src="img/1.jpg" style="margin-top: 2px; max-width: 56px; border-radius: 50%;">
		</div>
		<div class="col-lg-1">
			<a href="../logout.php" style="color: green;">
				<p style="margin-top: 16px; font-size: 18px;"><i class="fas fa-sign-out-alt"></i>  Çykmak<p>
			</a>
		</div>
	</div>
</nav>