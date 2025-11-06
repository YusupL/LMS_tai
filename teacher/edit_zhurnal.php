<?php
	include '../dbconnection.php';
	session_start();
    $id_ulanyjy=$_SESSION['id'];
	$id_dersler=$_POST['id_dersler_edit'];
	$gech_ders_id_ler=$_POST['gech_ders_id_edit'];
	$sapak_gornush=$_POST['sapak_gornush_edit'];
	$sagat_sany=$_POST['sagat_sany_edit'];
	$sene=$_POST['sene_edit'];
	$tema_ady=$_POST['tema_ady_edit'];

	if ($sene=="0000-00-00") $sene=date("Y-m-d");

	$gech_ders_id=explode("-",$gech_ders_id_ler);
	$ders_id=explode("-",$id_dersler);
	for ($i=0; $i<count($gech_ders_id)-1; $i++){
		mysqli_query($con, "UPDATE gechilen_dersler SET sene='$sene', sapak_gornush='$sapak_gornush', sagat_sany='$sagat_sany', tema_ady='$tema_ady' WHERE id='$gech_ders_id[$i]'");

		//on bahasy bar bolup indi ochurilmeli
		$query_bah_ochurmek=mysqli_query($con, "SELECT * FROM sapak_bahalar WHERE gech_ders_id='$gech_ders_id[$i]'");
		while ($row_baha_ochurmek=mysqli_fetch_array($query_bah_ochurmek)) {
			$id=$row_baha_ochurmek['id'];
			$id_talyp=$row_baha_ochurmek['id_talyp'];
			if ($_POST['talyp'.$id_talyp]=="") {
				mysqli_query($con, "DELETE FROM sapak_bahalar WHERE id='$id'");
			}
		}

		//on baha yok bolup taze baha goshmak
		$query_talyp=mysqli_query($con, "SELECT id, familiyasy, ady FROM talyplar WHERE toparcha IN (SELECT toparcha_id FROM ders_maglumat WHERE id='$ders_id[$i]') ");

		while ($row_talyp=mysqli_fetch_array($query_talyp)) {
			$baha=$_POST['talyp'.$row_talyp['id']];
			$id_talyp=$row_talyp['id'];
			$query_baha_bardygy=mysqli_query($con, "SELECT * FROM sapak_bahalar WHERE id_talyp='$id_talyp' AND gech_ders_id='$gech_ders_id[$i]'");
			$num_baha_bardygy=mysqli_num_rows($query_baha_bardygy);

			while ($row_baha_bardygy=mysqli_fetch_array($query_baha_bardygy)){
				$id=$row_baha_bardygy['id'];
			}

			if (($baha!="")&&($num_baha_bardygy==0)) {
				mysqli_query($con, "INSERT INTO sapak_bahalar (id_talyp, gech_ders_id, baha) VALUES ('$id_talyp', '$gech_ders_id[$i]', '$baha')");
			}

			//bar bahany uytgetmek
			if (($baha!="")&&($num_baha_bardygy>0)) {
					mysqli_query($con, "UPDATE sapak_bahalar SET baha='$baha' WHERE id='$id'");
				}
			}
	}

	/*$query_gech_ders=mysqli_query($con, "SELECT * FROM gechilen_dersler WHERE id='$gech_ders_id'");
	while ($row_gech_ders=mysqli_fetch_array($query_gech_ders)) {
		$sene_onki=$row_gech_ders['sene'];
		$sapak_gornush_onki=$row_gech_ders['sapak_gornush'];
		$sagat_sany_onki=$row_gech_ders['sagat_sany'];
		$tema_ady_onki=$row_gech_ders['tema_ady'];

		$query_gech_ders_idler=mysqli_query($con, "SELECT id, ders_id FROM gechilen_dersler WHERE sene='$sene_onki' AND sapak_gornush='$sapak_gornush_onki' AND sagat_sany='$sagat_sany_onki' AND tema_ady='$tema_ady_onki'");
		while ($row_gech_ders_idler=mysqli_fetch_array($query_gech_ders_idler)) {
			$row_gech_ders=$row_gech_ders_idler['id'];
			$ders_id=$row_gech_ders_idler['ders_id'];

			mysqli_query($con, "UPDATE gechilen_dersler SET sene='$sene', sapak_gornush='$sapak_gornush', sagat_sany='$sagat_sany', tema_ady='$tema_ady' WHERE id='$row_gech_ders'");

			//on bahasy bar bolup indi ochurilmeli
			$query_bah_ochurmek=mysqli_query($con, "SELECT * FROM sapak_bahalar WHERE gech_ders_id='$row_gech_ders'");
			while ($row_baha_ochurmek=mysqli_fetch_array($query_bah_ochurmek)) {
				$id=$row_baha_ochurmek['id'];
				$id_talyp=$row_baha_ochurmek['id_talyp'];
				if ($_POST['talyp'.$id_talyp]=="") {
					echo $id_talyp;
					mysqli_query($con, "DELETE FROM sapak_bahalar WHERE id='$id'");
				}
			}

			//on baha yok bolup taze baha goshmak
			$query_talyp=mysqli_query($con, "SELECT id, familiyasy, ady FROM talyplar WHERE toparcha IN (SELECT toparcha_id FROM ders_maglumat WHERE id='$ders_id') ");

			while ($row_talyp=mysqli_fetch_array($query_talyp)) {
				$baha=$_POST['talyp'.$row_talyp['id']];
				$id_talyp=$row_talyp['id'];
				$query_baha_bardygy=mysqli_query($con, "SELECT * FROM sapak_bahalar WHERE id_talyp='$id_talyp' AND gech_ders_id='$row_gech_ders'");
				$num_baha_bardygy=mysqli_num_rows($query_baha_bardygy);

				while ($row_baha_bardygy=mysqli_fetch_array($query_baha_bardygy)){
					$id=$row_baha_bardygy['id'];
				}

				if (($baha!="")&&($num_baha_bardygy==0)) {
					mysqli_query($con, "INSERT INTO sapak_bahalar (id_talyp, gech_ders_id, baha) VALUES ('$id_talyp', '$row_gech_ders', '$baha')");
				}

				//bar bahany uytgetmek
				if (($baha!="")&&($num_baha_bardygy>0)) {
					mysqli_query($con, "UPDATE sapak_bahalar SET baha='$baha' WHERE id='$id'");
				}
			}
		}
	}*/
?>
<thead>
	<th>Familiýasy, ady <?php echo $id_dersler; ?></th>
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
						if ($row_baha['baha']=='0') $baha="gm"; else $baha=$row_baha['baha'];
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
		<td><button data-toggle="modal" data-target="#editModal" class="edit_data" data-id="<?php echo $id_dersler; ?>" id="<?php echo $sene_ozi; ?>"><i class="fas fa-edit"></i></button></td>
		<?php
	}
	echo "</tr>";
	?>
</tbody>