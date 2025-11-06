<?php
    include '../admin/functions.php';
    session_start();
    $id_ulanyjy=$_SESSION['id'];
    $id_talyp=$_SESSION['id_talyp'];
    $yy=$_SESSION['yy'];
    $aj=$_SESSION['aj'];
    $ss=$_SESSION['ss'];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Synaglar</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">
    
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <style> 
    .ders_ady{
        background-color: white;
        font-weight: bold;
        font-size: 24px;
        border: none;
        color: green;
        padding: 0 0 0 16px ;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
    }
    </style>

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
		<?php include 'navbar.php'; ?>        

        <div class="content">
            <div class="container-fluid">
                <?php
                    include '../dbconnection.php';
                    date_default_timezone_set('Asia/Ashgabat');
                    $now = date('Y-m-d H:i:s', time());
                    $bash=0;
                    $gut=0;
                    $query_time=mysqli_query($con, "SELECT * FROM synag_reje WHERE toparcha_id IN (SELECT toparcha FROM talyplar WHERE ulanyjy_id='$id_ulanyjy')");
                    $num_time=mysqli_num_rows($query_time);

                    while ($row_time=mysqli_fetch_array($query_time)) {
                        $bash=$row_time['bashlayan_wagty'];
                        $gut=$row_time['gutaryan_wagty'];
                    }
                    if (($gut>=$now)&&($now>=$bash)) 
                    {
                        $query=mysqli_query($con, "SELECT ders_id, ders_ady FROM synag_sapaklar WHERE toparcha_id IN (SELECT toparcha FROM talyplar WHERE ulanyjy_id='$id_ulanyjy')");
                        $num_rows=mysqli_num_rows($query);
                        $sap_sany=1;
                        while ($row=mysqli_fetch_array($query)) {
                        $sap_sany++;
                        $ders_id=$row['ders_id'];
                        ?>
                        <form method="POST" action="general.php">
                            <div class="card">
                                <input type="hidden" name="ders_id" value="<?php echo $ders_id; ?>">
                                <input type="hidden" name="ders_ady" value="<?php echo $row['ders_ady']; ?>">
                                
                                <?php                                   
                                        $query_test=mysqli_query($con, "SELECT * FROM bellenen_jogap_test WHERE talyp_id='$id_talyp' AND ders_id='$ders_id' AND aralyk_jemleme='$aj'");
                                        $count_test=mysqli_num_rows ($query_test);
                                        $d=0; $y=0;                                        
                                        if ($count_test>0){
                                            while ($row_test=mysqli_fetch_array($query_test)) {
                                                $m_jogap=$row_test['bolmaly_jogap'];
                                                $t_jogap=$row_test['bellenen_jogap'];   
                                                $d=0;
                                                $y=0;
                                                for ($j=0; $j<strlen($m_jogap); $j++){
                                                    if ($m_jogap[$j]==$t_jogap[$j]) $d++; else $y++;
                                                }
                                            }
                                            $ssa=strlen($m_jogap);
                                            $baha=$d/$ssa*5;
                                            $baha=round($baha, 2);
                                        }

                                    $query_chaklendirme=mysqli_query($con, "SELECT * FROM chaklendirme WHERE talyp_id='$id_talyp' AND ders_id='$ders_id' AND aralyk_jemleme='$aj'");
                                    $count_chaklendirme=mysqli_num_rows($query_chaklendirme);

                                    
                                ?>                                
                                <input class="ders_ady" type="submit" name="sub_ders" <?php if (($count_test>0)||($count_chaklendirme>0)) echo "disabled='disabled'"; ?> value="<?php echo $row['ders_ady']; ?>">
                                <?php if ($count_test>0){ ?>
                                        <span style="font-size: 22px;">-<span class="text-muted"><?php if ($hun_gor=='1') echo " (".$d."/".$ssa.")"; ?></span> <span style="color: <?php if ($hun_gor=='1') echo $color; else echo "#208C05"; ?>;"><b><?php echo $baha; ?></b></span></span>
                                    <?php
                                    }
                                    if ($count_chaklendirme>0){ ?>
                                        <span style="font-size: 18px; color: red;">(Çäklendirilen)</span>
                                    <?php
                                    }
                                ?>
                            </div>
                        </form>
                    <?php }
                }
                else if ($now<$bash){?>
                    <div style="font-size: 22px;" class="text-info">Synag üçin niýetlenen wagt başlanmady. Synag <?php echo date('d.m.Y', strtotime($bash)); echo "ý. güni "; echo date('H:i', strtotime($bash)); echo "-"; echo date('H:i', strtotime($gut)); echo " aralygynda bolup geçýär." ?></div>
                    <?php
                }
                else if ($now>$gut) {?>
                        <div style="font-size: 22px;" class="text-danger">Synag üçin niýetlenen wagt gutardy. Synag <?php echo date('d.m.Y', strtotime($bash)); echo "ý. güni "; echo date('H:i', strtotime($bash)); echo "-"; echo date('H:i', strtotime($gut)); echo " aralygynda bolup geçdi." ?></div>
                    <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>


</body>

    <!--   Core JS Files   -->
       <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

</html>
