<?php
    session_start();
    $id_ulanyjy=$_SESSION['id'];
    include '../dbconnection.php';
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
                <li class="active">
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
                <li>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <div class="alert alert-success">
									<h4 class="title">
										<b><?php echo  $aj;?> </b>-nji(y) jemlemesi üçin maglumat
									</h4>
								</div>
								
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><i class="fa fa-door-closed"></i>   Otag</td>
                                                <td class="td-actions text-right">
                                                    <!--otag belgisini goymaly-->
                                                    <?php echo "-";?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="fa fa-desktop"></i>  Kompýuter</td>
                                                <td class="td-actions text-right">
                                                    <!--oturmaly komp belgisini goymaly-->
                                                    <?php echo "-";?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i class="far fa-calendar"></i>    Sene</td>
                                                <td class="td-actions text-right">
                                                    <?php
                                                        $bash_wagt="";
                                                        $gut_wagt="";
                                                        $query_sene=mysqli_query($con, "SELECT * FROM synag_reje WHERE toparcha_id='$toparcha_id'");
                                                        while ($row_sene=mysqli_fetch_array($query_sene)) {
                                                            $bash_wagt=$row_sene['bashlayan_wagty'];
                                                            $gut_wagt=$row_sene['gutaryan_wagty'];
                                                        }
                                                        if ($bash_wagt!="") echo date("d.m.Y", strtotime($bash_wagt)); else echo "-";
                                                    ?>
                                                </td>
                                            </tr>
											<tr>
                                                <td><i class="far fa-clock"></i>    Wagt</td>
                                                <td class="td-actions text-right">
                                                    <?php if (($bash_wagt!="")&&($gut_wagt!="")) 
                                                        {
                                                            echo date("H:i", strtotime($bash_wagt)); echo "-"; echo  date("H:i", strtotime($gut_wagt));
                                                        }
                                                        else echo "-";
                                                    ?>
                                                </td>
                                            </tr>
											
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							<hr>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <div class="alert alert-success"><h3 class="title">Okalýan dersler</h3></div>
                                <?php
                                    $query_dersler=mysqli_query($con, "SELECT ders_atlary.ady FROM ders_maglumat, ders_atlary WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.ara_syn_deg='1' AND ders_maglumat.toparcha_id='$toparcha_id'");
                                    $tb=0;
                                    while ($row_dersler=mysqli_fetch_array($query_dersler)) {
                                        $tb++;
                                        $ders_ady=$row_dersler['ady'];?>
                                            <h5><?php echo $tb.". ".$ders_ady; ?></h5>
                                        <?php
                                    }
                                ?>
                            </div>
                            <div class="content">
                                <div id="chartHours" class="ct-chart"></div>
                                <div class="footer">
									<div class="stats">
                                        I ýarymýyllyk
                                    </div>
                                </div>
                            </div>
                        </div>
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
</html>