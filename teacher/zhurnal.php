<?php
    session_start();
    $id_ulanyjy=$_SESSION['id'];
    include '..//dbconnection.php';
    $query=mysqli_query($con, "SELECT * FROM synag_tapgyr");
    while ($row=mysqli_fetch_array($query)){
        if ($row['gornush']=='1'){
            $adaty_yy=$row['yarymyyllyk'];
            $adaty_aj=$row['aralyk_jemleme'];
            $adaty_ss=$row['sorag_sany'];
        }
        if ($row['gornush']=='2'){
            $bakalawr_yy=$row['yarymyyllyk'];
            $bakalawr_aj=$row['aralyk_jemleme'];
            $bakalawr_ss=$row['sorag_sany'];
        }
        if ($row['gornush']=='3'){
            $pod_yy=$row['yarymyyllyk'];
            $pod_aj=$row['aralyk_jemleme'];
            $pod_ss=$row['sorag_sany'];
        }
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

    <link rel="stylesheet" type="text/css" href="assets/css/all.css">

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
    
        <?php //include 'navbar.php'; ?>
        <div class="content">
            <br>
            <?php
                include '../dbconnection.php';
                //umumy we amaly uchin talap
                $query_1=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady,  ders_atlary.id AS ders_ady_id, toparchalar.yyl, toparchalar.hunar AS hunar_id, ders_maglumat.id AS ders_id, ders_gornushi.ady AS ders_gornushi_ady, hunarler.gornushi AS hunar_gornush FROM ders_gornushi, ders_atlary, ders_maglumat, mugallymlar, toparchalar, hunarler, ulanyjylar WHERE ulanyjylar.id=mugallymlar.ulanyjy_id AND hunarler.id=toparchalar.hunar AND mugallymlar.id=ders_maglumat.mug_id AND ders_gornushi.id=ders_maglumat.gornushi AND ders_atlary.id=ders_maglumat.ders_id AND ders_maglumat.toparcha_id=toparchalar.id AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND hunarler.gornushi!='3' AND ders_gornushi.id IN (1, 3, 4) AND ders_atlary.id NOT IN (14, 15, 16) GROUP BY ders_atlary.id, toparchalar.hunar, toparchalar.yyl, ders_gornushi.id ORDER BY toparchalar.yyl");

                //tejribe uchin talap
                $query_tejribe_1=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady,  ders_atlary.id AS ders_ady_id, toparchalar.yyl, toparchalar.hunar AS hunar_id, ders_maglumat.id AS ders_id, ders_gornushi.ady AS ders_gornushi_ady, hunarler.gysga_ady AS hunar_gysga_ady, toparchalar.toparcha AS toparcha, hunarler.gornushi AS hunar_gornush  FROM ders_gornushi, ders_atlary, ders_maglumat, mugallymlar, toparchalar, hunarler, ulanyjylar WHERE ulanyjylar.id=mugallymlar.ulanyjy_id AND hunarler.id=toparchalar.hunar AND mugallymlar.id=ders_maglumat.mug_id AND ders_gornushi.id=ders_maglumat.gornushi AND ders_atlary.id=ders_maglumat.ders_id AND ders_maglumat.toparcha_id=toparchalar.id AND mugallymlar.ulanyjy_id='$id_ulanyjy' AND hunarler.gornushi!='3' AND (ders_gornushi.id='2' OR (ders_gornushi.id='3' AND ders_atlary.id IN (14, 15, 16))) ORDER BY toparchalar.yyl");

                $totalrows = mysqli_num_rows($query_1);
                $totalrows_tejribe = mysqli_num_rows($query_tejribe_1);

                if (($totalrows>0)||($totalrows_tejribe>0)){
                    ?>
                    <div class="card" style="background-color: #EAECEE; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="card-header" style="background-color: #FCF5BA;">
                            <h3 class="card-title bg-primary text-white" style="background-color: #32ce36; font-family: Georgia; padding: 7px;">
                            Žurnal</h3>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="panel-group" id="sapak" style="margin-top: 10px;">                                    
                                <?php while ($row_1=mysqli_fetch_array($query_1)) {
                                    $ders_ady_id=$row_1['ders_ady_id'];
                                    $ders_id=$row_1['ders_id'];
                                    $ders_ady=$row_1['ders_ady'];
                                    $yyl=$row_1['yyl'];
                                    $hunar_id=$row_1['hunar_id'];
                                    $ders_gornushi_ady=$row_1['ders_gornushi_ady'];
                                    $id_dersler="";
                                    ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#sapak" href="#sapak<?php echo $ders_id ?>" style="font-size: 20px;"> <?php echo $ders_ady;?><span class="text-muted"> <?php echo "(".strtolower($ders_gornushi_ady).")";?></span> </a>
                                    <?php
                                        $query_2=mysqli_query($con, "SELECT hunarler.gysga_ady AS hunar_ady, toparchalar.yyl AS yyl, toparchalar.toparcha AS toparcha, ders_maglumat.id AS ders_id, ders_maglumat.toparcha_id FROM hunarler, toparchalar, ders_maglumat, ders_gornushi WHERE hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND ders_gornushi.id=ders_maglumat.gornushi AND toparchalar.hunar='$hunar_id' AND toparchalar.yyl='$yyl' AND ders_maglumat.ders_id='$ders_ady_id' AND ders_gornushi.ady='$ders_gornushi_ady'");
                                    
                                        while ($row_2=mysqli_fetch_array($query_2)) {
                                            $id_dersler.=$row_2['ders_id']."-";
                                            ?>
                                            <span style='color: green;'> <?php echo $row_2['hunar_ady']." ".$row_2['yyl']."0".$row_2['toparcha']?> </span> <?php
                                        }
                                        ?>
                                            </h4>
                                        </div>

                        <div id="sapak<?php echo $ders_id; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table_zhurnal" id="e-zhurnal<?php echo $ders_id;?>">
                                    <thead>
                                        <th>Familiýasy, ady</th>
                                        <?php
                                            $id_ders=explode("-",$id_dersler);
                                            $query_sene=mysqli_query($con, "SELECT sene FROM gechilen_dersler WHERE ders_id='$id_ders[0]' ORDER BY sene");
                                            while ($row_sene=mysqli_fetch_array($query_sene)) {?>
                                                    <th><div class="zhurnal_rotate"><?php echo date("d.m.Y", strtotime($row_sene['sene'])); ?></div></th>
                                                <?php
                                            }
                                        ?>
                                        <th style="cursor: pointer;" data-toggle="modal" data-target="#addModal" class="add" data-id="<?php echo $id_dersler; ?>">+</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            for ($i=0; $i<count($id_ders)-1; $i++){
                                                $ders=$id_ders[$i];
                                                $query_hg=mysqli_query($con, "SELECT gornushi FROM hunarler WHERE id IN (SELECT hunar FROM toparchalar WHERE id IN (SELECT toparcha_id FROM ders_maglumat WHERE id='$ders'))");
                                                $row_hg=mysqli_fetch_array($query_hg);
                                                $gornushi=$row_hg['gornushi'];
                                                $query_talyp=mysqli_query($con, "SELECT id, familiyasy, ady FROM talyplar WHERE toparcha IN (SELECT toparcha_id FROM ders_maglumat WHERE id='$ders')");

                                                while ($row_talyp=mysqli_fetch_array($query_talyp)) {
                                                    echo "<tr>";
                                                    echo "<td>".$row_talyp['familiyasy']." ".$row_talyp['ady']."</td>";
                                                    $id_talyp=$row_talyp['id'];
                                                    $query_id=mysqli_query($con, "SELECT id FROM gechilen_dersler WHERE ders_id='$ders' ORDER BY sene");
                                                    while ($row_id=mysqli_fetch_array($query_id)) {
                                                        $gech_ders_id=$row_id['id'];
                                                        $query_baha=mysqli_query($con, "SELECT baha FROM sapak_bahalar WHERE id_talyp='$id_talyp' AND gech_ders_id='$gech_ders_id'");

                                                        if (mysqli_num_rows($query_baha)==0) echo "<td></td>"; else {
                                                            while ($row_baha=mysqli_fetch_array($query_baha)) {
                                                                if($gornushi==1){
                                                                    if ($row_baha['baha']=='0') $baha="gm"; else $baha=$row_baha['baha'];							
                                                                } else {
                                                                    switch ($row_baha['baha']) {
                                                                        case '0':
                                                                            $baha="gm";
                                                                            break;
                                                                        case '1':
                                                                            $baha="Fx";
                                                                            break;
                                                                        case '2':
                                                                            $baha="F";
                                                                            break;
                                                                        case '3':
                                                                            $baha="E";
                                                                            break;
                                                                        case '4':
                                                                            $baha="D";
                                                                            break;
                                                                        case '5':
                                                                            $baha="C";
                                                                            break;
                                                                        case '6':
                                                                            $baha="B";
                                                                            break;
                                                                        case '7':
                                                                            $baha="A";
                                                                            break;								
                                                                    }
                                                                }
                                                                echo "<td>".$baha."</td>";
                                                            }
                                                        }
                                                    }
                                                    echo "<td></td>";
                                                    echo "</tr>";
                                                }
                                            }

                                            echo "<tr><td></td>";
                                            //geçh_der_id'nin ikisinin hem id almak uçhin
                                            $seneler=[];
                                            $j=0;
                                            for ($i=0; $i<count($id_ders)-1; $i++){
                                                $query_s=mysqli_query($con, "SELECT id FROM gechilen_dersler WHERE ders_id='$id_ders[$i]' ORDER BY sene");
                                                while ($row_s=mysqli_fetch_array($query_s)){
                                                    $seneler[$j]=$row_s['id'];
                                                    $j++;
                                                }
                                            }
                                            //$query_sene=mysqli_query($con, "SELECT id FROM gechilen_dersler WHERE ders_id='$id_ders[0]' ORDER BY sene");
                                            for ($i=0; $i<count($seneler)/(count($id_ders)-1); $i++) {
                                                $sene_ozi="";
                                                for ($j=0; $j<count($id_ders)-1; $j++){
                                                    $sene_ozi=$sene_ozi.$seneler[$i+$j*count($seneler)/(count($id_ders)-1)]."-";
                                                }
                                                ?>
                                                <td><button data-toggle="modal" data-target="#editModal" class="edit_data" data-id="<?php echo $id_dersler; ?>" id="<?php echo $sene_ozi; ?>"><i class="fas fa-edit"></i></button><br>
                                                    <button class="delete_data" data-id="<?php echo "delete".$id_dersler; ?>" id="<?php echo "delete".$sene_ozi; ?>"><i class="fas fa-trash-alt"></i></button></td>
                                                <?php
                                            }
                                            echo "</tr>";
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        <?php
                    }
                    ?>
                    <!--Tejribe sapaklary uchin-->
                    <?php while ($row_tejribe_1=mysqli_fetch_array($query_tejribe_1)) {
                        $ders_ady_id=$row_tejribe_1['ders_ady_id'];
                        
                        $ders_id=$row_tejribe_1['ders_id']; 
                        $ders_id_id=$ders_id;
                        $ders_id.="-";
                        
                        $ders_ady=$row_tejribe_1['ders_ady'];
                        $yyl=$row_tejribe_1['yyl'];
                        $hunar_id=$row_tejribe_1['hunar_id'];
                        $ders_gornushi_ady=$row_tejribe_1['ders_gornushi_ady'];
                        $hunar_gysga_ady=$row_tejribe_1['hunar_gysga_ady'];
                        $toparcha=$row_tejribe_1['toparcha'];
                        $id_dersler="";
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#sapak" href="#sapak<?php echo $ders_id ?>" style="font-size: 20px;"> <?php echo $ders_ady;?><span class="text-muted"> <?php echo "(".strtolower($ders_gornushi_ady).")";?></span> </a>
                                        <span style='color: green;'><?php echo $hunar_gysga_ady." ".$yyl."0".$toparcha; ?> </span> 
                                </h4>
                            </div>

                    <div id="sapak<?php echo $ders_id; ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table_zhurnal" id="e-zhurnal<?php echo $ders_id_id;?>">
                                <thead>
                                    <th>Familiýasy, ady</th>
                                    <?php
                                        $query_sene=mysqli_query($con, "SELECT sene FROM gechilen_dersler WHERE ders_id='$ders_id' ORDER BY sene");
                                        while ($row_sene=mysqli_fetch_array($query_sene)) {?>
                                                <th><div class="zhurnal_rotate"><?php echo date("d.m.Y", strtotime($row_sene['sene'])); ?></div></th>
                                            <?php
                                        }
                                    ?>
                                    <th style="cursor: pointer;" data-toggle="modal" data-target="#addModal" class="add" data-id="<?php echo $ders_id; ?>">+</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $query_hg=mysqli_query($con, "SELECT gornushi FROM hunarler WHERE id IN (SELECT hunar FROM toparchalar WHERE id IN (SELECT toparcha_id FROM ders_maglumat WHERE id='$ders_id'))");
                                        $row_hg=mysqli_fetch_array($query_hg);
                                        $gornushi=$row_hg['gornushi'];
                                        $query_talyp=mysqli_query($con, "SELECT id, familiyasy, ady FROM talyplar WHERE toparcha IN (SELECT toparcha_id FROM ders_maglumat WHERE id='$ders_id') ");

                                        while ($row_talyp=mysqli_fetch_array($query_talyp)) {
                                            echo "<tr>";
                                            echo "<td>".$row_talyp['familiyasy']." ".$row_talyp['ady']."</td>";
                                            $id_talyp=$row_talyp['id'];
                                            $query_id=mysqli_query($con, "SELECT id FROM gechilen_dersler WHERE ders_id='$ders_id' ORDER BY sene");
                                            while ($row_id=mysqli_fetch_array($query_id)) {
                                                $gech_ders_id=$row_id['id'];
                                                $query_baha=mysqli_query($con, "SELECT baha FROM sapak_bahalar WHERE id_talyp='$id_talyp' AND gech_ders_id='$gech_ders_id'");

                                                if (mysqli_num_rows($query_baha)==0) echo "<td></td>"; else {
                                                    while ($row_baha=mysqli_fetch_array($query_baha)) {
                                                        if($gornushi==1){
                                                            if ($row_baha['baha']=='0') $baha="gm"; else $baha=$row_baha['baha'];							
                                                        } else {
                                                            switch ($row_baha['baha']) {
                                                                case '0':
                                                                    $baha="gm";
                                                                    break;
                                                                case '1':
                                                                    $baha="Fx";
                                                                    break;
                                                                case '2':
                                                                    $baha="F";
                                                                    break;
                                                                case '3':
                                                                    $baha="E";
                                                                    break;
                                                                case '4':
                                                                    $baha="D";
                                                                    break;
                                                                case '5':
                                                                    $baha="C";
                                                                    break;
                                                                case '6':
                                                                    $baha="B";
                                                                    break;
                                                                case '7':
                                                                    $baha="A";
                                                                    break;								
                                                            }
                                                        }
                                                        echo "<td>".$baha."</td>";
                                                    }
                                                }
                                            }
                                            echo "<td></td>";
                                            echo "</tr>";
                                        }

                                    $query_sene=mysqli_query($con, "SELECT id FROM gechilen_dersler WHERE ders_id='$ders_id' ORDER BY sene");
                                    echo "<tr><td></td>";
                                    while ($row_sene=mysqli_fetch_array($query_sene)) {?>
                                        <td><button  data-toggle="modal" data-target="#editModal"  class="edit_data" data-id="<?php echo $ders_id; ?>" id="<?php echo $row_sene['id']."-"; ?>"><i class="fas fa-edit"></i></button><br>
                                                <button class="delete_data" data-id="<?php echo "delete".$id_dersler; ?>" id="<?php echo "delete".$row_sene['id']; ?>"><i class="fas fa-trash-alt"></i></button></td>
                                        <?php
                                    }
                                    echo "</tr>";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div></div></div>
        <?php
    }
    ?>

<br>
        </div>
    </div>
    <!--baha goshyan model-->
</div>

<div id="editModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Elektron žurnalda maglumat üýtgetmek</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="edit_form">
                    <input type="hidden" name="gech_ders_id_edit" id="gech_ders_id_edit" value="">
                    <input type="hidden" name="id_dersler_edit" id="id_dersler_model_edit" value="">
                    <label>Temanyň ady</label><br>
                    <textarea name="tema_ady_edit" id="tema_ady_edit" style="width: 100%; height: 70px;"></textarea>
                    <br>
                    <label>Sapagyň görnüşini saýlaň</label>
                    <select class="form-control" id="sapak_gornush_edit" name="sapak_gornush_edit">
                        <?php
                            $query_sap_gor=mysqli_query($con, "SELECT * FROM ders_gornushi");
                            while ($row_sap_gor=mysqli_fetch_array($query_sap_gor)) {?>
                                <option value="<?php echo $row_sap_gor['id']; ?>"><?php echo $row_sap_gor['ady']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <br/>
                    <label>Sagat sany</label>
                    <select class="form-control" name="sagat_sany_edit" id="sagat_sany_edit">
                        <?php
                            for ($i=1; $i<=10; $i++){?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                        ?>
                    </select><br>
                    <label>Sene</label> <br> <input type="date" name="sene_edit" id="sene_edit">
                    <br><br>
                    <div class="talyplar_edit">
                        <!--talyplaryn sanawy ajaxdan gelyar-->    
                    </div>
                    
                    <!--<input type="hidden" name="employee_id" id="employee_id" />-->
                    <input type="submit" name="edit" id="edit" value="Tassyklamak" class="btn btn-success" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ýapmak</button>
            </div>
        </div>
    </div>
</div>

<div id="addModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Elektron žurnala maglumat goşmak</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <!--<input type="text" name="gech_ders_id" id="gech_ders_id" value="">-->
                    <input type="hidden" name="id_dersler_add" id="id_dersler_model_add" value="">
                    <label>Temanyň ady</label><br>
                    <textarea name="tema_ady_add" id="tema_ady_add" style="width: 100%; height: 70px;"></textarea>
                    <br>
                    <label>Sapagyň görnüşini saýlaň</label>
                    <select class="form-control" id="sapak_gornush_add" name="sapak_gornush_add">
                        <?php
                            $query_sap_gor=mysqli_query($con, "SELECT * FROM ders_gornushi");
                            while ($row_sap_gor=mysqli_fetch_array($query_sap_gor)) {?>
                                <option value="<?php echo $row_sap_gor['id']; ?>"><?php echo $row_sap_gor['ady']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <br/>
                    <label>Sagat sany</label>
                    <select class="form-control" name="sagat_sany_add" id="sagat_sany_add">
                        <?php
                            for ($i=1; $i<=10; $i++){?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                        ?>
                    </select><br>
                    <label>Sene</label> <br> <input type="date" name="sene_add" id="sene_add">
                    <br><br>
                    <div class="talyplar_add">
                        <!--talyplaryn sanawy ajaxdan gelyar-->
                    </div>
                    
                    <!--<input type="hidden" name="employee_id" id="employee_id" />-->
                    <input type="submit" name="insert" id="insert" value="Tassyklamak" class="btn btn-success" />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ýapmak</button>
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
        function func(){
            var sene = $('#sene').val();
            //alert(sene);
            var dateAr = sene.split('-');
            var newDate = dateAr[2] + '.' + dateAr[1] + '.' + dateAr[0];

            var trn = $("#e-zhurnal tbody td").length, thn=$("#e-zhurnal thead th").length;
            setir_sany=trn/thn;
            //alert(thn);
            $("#e-zhurnal thead th:last-child").remove();
            $("#e-zhurnal tbody td:last-child").remove();
            
            $("#e-zhurnal thead tr").append("<th><div class='zhurnal_rotate'>"+newDate+"</div></th>");
            
            for (var i=0; i<4; i++){
                var Row = document.getElementById("e-zhurnal").rows[i+1];
                var x = Row.insertCell(-1);
                x.innerHTML = i;
            };

            $("#e-zhurnal thead tr").append("<th style='cursor: pointer;' data-toggle='modal' data-target='#bahaModal'>+</th>");
            $("#e-zhurnal tbody tr").append("<td></td>");
        }
    </script>
    <script>  
$(document).ready(function(){
    $('.add').click(function(){  
        var id_dersler=$(this).attr("data-id");

        $('#insert').val("Goşmak");
        $('#insert_form')[0].reset();

        $("#id_dersler_model_add").val(id_dersler);
        
        $.ajax({
            url: "zhurnal_add_get_talyp.php",
            method: "POST",
            data:{id_dersler:id_dersler},
            dataType: "html",
            success:function(data){
                $('.talyplar_add').html(data);
            }
        });
    });
});

$(document).ready(function(){
    $(document).on('click', '.edit_data', function(){
        var id = $(this).attr("id");
        $('#edit_form')[0].reset();
        $('#insert_edit').val("Üýtgetmek");

        var id_dersler_edit=$(this).attr("data-id");
        $("#id_dersler_model_edit").val(id_dersler_edit);

        $.ajax({
            url:"fetch_zhurnal.php",  
            method:"POST",  
            data:{id:id},  
            dataType:"json",  
            success:function(data){
                $("#gech_ders_id_edit").val(id);
                $('#tema_ady_edit').val(data.tema_ady);
                $('#sapak_gornush_edit').val(data.sapak_gornush);
                $('#sagat_sany_edit').val(data.sagat_sany);
                $('#sene_edit').val(data.sene);
                $('#editModal').modal('show');
            }
        });

        $.ajax({
            url: "zhurnal_get_talyp.php",
            method: "POST",
            data:{id_dersler:id_dersler_edit, id:id},
            dataType: "html",
            success:function(data){
                $('.talyplar_edit').html(data);
            }
        });

    });
});


$(document).ready(function(){
    $(document).on('click', '.delete_data', function(){
        var id_gech_dersler = $(this).attr("id");        
        var id_dersler=$(this).attr("data-id");
        id_gech_dersler=id_gech_dersler.substr(6, id_gech_dersler.length-6);
        //alert(id_gech_dersler);
        
        $.ajax({
            url:"delete_zhurnal.php",  
            method:"POST",  
            data:{id_gech_dersler:id_gech_dersler, id_dersler:id_dersler},  
            dataType:"html",  
            success: function(data){
                location.reload();
                //alert(data);
                /*if(response == 1){
                    // Remove row from HTML Table
                    $(el).closest('tr').css('background','tomato');
                    $(el).closest('tr').fadeOut(400,function(){
                        $(this).remove();
                    });
                }else{
                    alert('Invalid ID.');
                }*/
            }
        });
    });
});

$(document).ready(function(){
    $('#insert_form').on("submit", function(event){
        var id_zhurnal_1 = $("#id_dersler_model_add").val();
        var id_zhurnal=id_zhurnal_1.split("-");
        //alert(id_zhurnal[0]);
        event.preventDefault();
            $.ajax({  
                url:"insert_zhurnal.php",  
                method:"POST",
                data:$('#insert_form').serialize(),
                beforeSend:function(){
                    $('#insert').val("Goşulýar");
                },
                success:function(data){
                    $('#insert_form')[0].reset();
                    $('#addModal').modal('hide');
                    $('#e-zhurnal'+id_zhurnal[0]).html(data);
                }
            });
        });

    $('#edit_form').on("submit", function(event){
        var id_zhurnal_1 = $("#id_dersler_model_edit").val();
        var id_zhurnal=id_zhurnal_1.split("-");
        //alert(id_zhurnal[0]);
        event.preventDefault();
            $.ajax({  
                url:"edit_zhurnal.php",  
                method:"POST",
                data:$('#edit_form').serialize(),
                beforeSend:function(){
                    $('#edit').val("Üýtgeýär");
                },
                success:function(data){
                    $('#edit_form')[0].reset();
                    $('#editModal').modal('hide');
                    $('#e-zhurnal'+id_zhurnal[0]).html(data);
                }
            });
        });
});  
 </script>
</html>
