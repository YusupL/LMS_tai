<?php
	include '../dbconnection.php';
	session_start();
    $id_ulanyjy=$_SESSION['id'];
	$id_dersler=$_POST['id_dersler'];
	$gech_ders_id_ler=$_POST['id_gech_dersler'];

	//echo $gech_ders_id_ler;
	
	$gech_ders_id=explode("-",$gech_ders_id_ler);
	$ders_id=explode("-",$id_dersler);
	for ($i=0; $i<count($gech_ders_id)-1; $i++){
		mysqli_query($con, "DELETE FROM sapak_bahalar WHERE gech_ders_id='$gech_ders_id[$i]'");
		mysqli_query($con, "DELETE FROM gechilen_dersler WHERE id='$gech_ders_id[$i]'");
	}
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