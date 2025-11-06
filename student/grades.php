<?php
    session_start();
    include '../admin/functions.php';
    $id_ulanyjy=$_SESSION['id'];
    include '..//dbconnection.php';
    $query=mysqli_query($con, "SELECT synag_tapgyr.yarymyyllyk, synag_tapgyr.aralyk_jemleme, synag_tapgyr.sorag_sany, toparchalar.id FROM synag_tapgyr, talyplar, hunarler, toparchalar WHERE talyplar.toparcha=toparchalar.id AND toparchalar.hunar=hunarler.id AND hunarler.gornushi=synag_tapgyr.gornush AND talyplar.ulanyjy_id='$id_ulanyjy'");
    while ($row=mysqli_fetch_array($query)){
        $toparcha_id=$row['id'];
        $yy=$row['yarymyyllyk'];
        $aj=$row['aralyk_jemleme'];
        $ss=$row['sorag_sany'];
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Bahalar</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <link href="assets/css/main.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
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
                <li>
                    <a href="exams.php">
                        <i class="fa fa-tasks"></i>
                        <p>Synaglar</p>
                    </a>
                </li>
                <li class="active">
                    <a href="grades.php">
                        <i class="fa fa-align-left"></i>
                        <p>Bahalarym</p>
                    </a>
                </li>
                <li>
                    <a href="timetable.php">
                        <i class="fa fa-table"></i>
                        <p>Reje</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
    <div class="main-panel">
    	<?php include "navbar.php"; ?>
        <div class="content">
            <div class="container-fluid">
                <div class="panel-group" id="accordion">
                	<?php
                		$query_ders=mysqli_query($con, "SELECT ders_maglumat.id, ders_atlary.ady FROM ders_maglumat, ders_atlary, talyplar, toparchalar WHERE ders_atlary.id=ders_maglumat.ders_id AND ders_maglumat.toparcha_id=toparchalar.id AND talyplar.toparcha=toparchalar.id AND ders_maglumat.ara_syn_deg='1' AND talyplar.ulanyjy_id='$id_ulanyjy'");
                		while ($row_ders=mysqli_fetch_array($query_ders)) {
                			$ders_id=$row_ders['id'];
                	?>
					<div class="panel panel-default">
						<div class="panel-heading">
						  <h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row_ders['id'];?>"><?php echo $row_ders['ady']; ?></a>
						  </h4>
						</div>
						<div id="collapse<?php echo $row_ders['id'];?>" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="container-fluid">
									<table class="grade_table">
										<thead>
											<tr class="grade_table_header">
												<td style="border-radius: 15px 0 0 0;" class="column1">Aralyk jemleme</td>
												<td class="column2">Test</td>
												<td style="border-radius: 0 15px 0 0;" class="column3">Sapak</td>
											</tr>
										</thead>
										<tbody>
											<?php
                                            //her aralyk jemlemede sorag sany uyygeyar. Kakamyratda problem chykdy
												for ($i=$aj; $i<=$aj; $i++){
											?>
											<tr class="grade_table_body">
												<?php
												$bellenen_jogap="";
                                                $bolmaly_jogap="";
												$query_baha_test=mysqli_query($con, "SELECT bolmaly_jogap, bellenen_jogap FROM bellenen_jogap_test, talyplar WHERE talyplar.id=bellenen_jogap_test.talyp_id AND talyplar.ulanyjy_id='$id_ulanyjy' AND bellenen_jogap_test.ders_id='$ders_id' AND bellenen_jogap_test.aralyk_jemleme='$i'");
												if (mysqli_num_rows($query_baha_test)>0){
													$row_baha_test=mysqli_fetch_array($query_baha_test);
													$bolmaly_jogap=$row_baha_test['bolmaly_jogap'];
													$bellenen_jogap=$row_baha_test['bellenen_jogap'];
												} else 
													{
														$query_pdf=mysqli_query($con, "SELECT bellenen_jogap_pdf.bellenen_jogap FROM bellenen_jogap_pdf, talyplar WHERE bellenen_jogap_pdf.talyp_id=talyplar.id AND talyplar.ulanyjy_id='$id_ulanyjy' AND ders_id='$ders_id' AND aralyk_jemleme='$i'");
														$row_num_pdf=mysqli_num_rows($query_pdf);
														if ($row_num_pdf>0){
															$row_pdf=mysqli_fetch_array($query_pdf);
															$bellenen_jogap=$row_pdf['bellenen_jogap'];
															$query_pdf_jogap=mysqli_query($con, "SELECT jogap FROM testler_pdf WHERE ders_id='$ders_id' AND aralyk_jemleme='$i'");
															$row_pdf_jogap=mysqli_fetch_array($query_pdf_jogap);
															$bolmaly_jogap=deshifr_kichi($row_pdf_jogap['jogap']);
														}
													}
												$d=0; $test_baha=0;
                                                if ($bellenen_jogap!=""){
                                                    for ($j=0; $j<$ss; $j++){
                                                        if ($bellenen_jogap[$j]==$bolmaly_jogap[$j]) $d++;
                                                    }
                                                    $test_baha=round(5*$d/$ss, 2);
                                                } else {
                                                	$test_baha="_";
                                                	$d="_";
                                                }

                                                $query_ob=mysqli_query($con, "SELECT ortacha_baha.baha FROM ortacha_baha, talyplar WHERE ortacha_baha.talyp_id=talyplar.id AND ortacha_baha.ders_id='$ders_id' AND ortacha_baha.aralyk_jemleme='$i' AND talyplar.ulanyjy_id='$id_ulanyjy'");
                                                if (mysqli_num_rows($query_ob)>0){
                                                	$row_ob=mysqli_fetch_array($query_ob);
                                                	$ob=$row_ob['baha'];
                                                } else $ob="_";

												?>
												<td class="column1"><?php echo $i; ?></td>
												<td class="column2"><?php echo $test_baha; ?> <span class="text-muted">(<?php echo " ".$d." / ".$ss; ?>)</span></td>
												<td class="column3"><?php echo $ob; ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
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

</html>
