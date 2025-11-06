<?php
	include '../dbconnection.php';
	session_start();
    $id_ulanyjy=$_SESSION['id'];
	$id_dersler=$_POST['id_dersler_add'];
	//$id_dersler=substr($id_dersler, 2, strlen($id_dersler)-2);
	$sapak_gornush=$_POST['sapak_gornush_add'];
	$sagat_sany=$_POST['sagat_sany_add'];
	$sene=$_POST['sene_add'];
	$tema_ady=$_POST['tema_ady_add'];

	echo $id_ulanyjy." ".$id_dersler;

	if ($sene=="0000-00-00") $sene=date("Y-m-d");

	$id_ders=explode("-",$id_dersler);

	for ($i=0; $i<count($id_ders)-1; $i++){
		$ders_id=$id_ders[$i];
		mysqli_query($con, "INSERT INTO gechilen_dersler (ders_id, sene, sapak_gornush, sagat_sany, tema_ady) VALUES ('$ders_id', '$sene', '$sapak_gornush', '$sagat_sany', '$tema_ady')");
		$gech_ders_id=mysqli_insert_id($con);

		$query_talyp=mysqli_query($con, "SELECT id, familiyasy, ady FROM talyplar WHERE toparcha IN (SELECT toparcha_id FROM ders_maglumat WHERE id='$ders_id') ");
		while ($row_talyp=mysqli_fetch_array($query_talyp)) {
			$baha=$_POST['talyp'.$row_talyp['id']];
			$id_talyp=$row_talyp['id'];
			if ($baha!="") {
				mysqli_query($con, "INSERT INTO sapak_bahalar (id_talyp, gech_ders_id, baha) VALUES ('$id_talyp', '$gech_ders_id', '$baha')");
			}
		}
	}
?>
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
		$query_talyp=mysqli_query($con, "SELECT id, familiyasy, ady FROM talyplar WHERE toparcha IN (SELECT toparcha_id FROM ders_maglumat WHERE id='$ders') ");

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

	$query_sene=mysqli_query($con, "SELECT id FROM gechilen_dersler WHERE ders_id='$id_ders[0]' ORDER BY sene");
	echo "<tr><td></td>";
	while ($row_sene=mysqli_fetch_array($query_sene)) {?>
		<td><button data-toggle="modal" data-target="#editModal" class="edit_data" data-id="<?php echo $id_dersler; ?>" id="<?php echo $row_sene['id']; ?>"><i class="fas fa-edit"></i></button></td>
		<?php
	}
	echo "</tr>";
	?>
</tbody>
<script type="text/javascript">
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
</script>