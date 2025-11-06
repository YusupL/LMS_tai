<?php
	include '../dbconnection.php';
	session_start();
    //$id_ulanyjy=$_SESSION['id'];
	$ders_id=$_POST['ders_id'];
	$aralyk_jemleme=$_POST['aralyk_jemleme'];

	$query_toparcha=mysqli_query($con, "SELECT toparcha_id FROM ders_maglumat WHERE id='$ders_id'");
	$row_toparcha=mysqli_fetch_array($query_toparcha);
	$toparcha_id=$row_toparcha['toparcha_id'];

	$query_talyp=mysqli_query($con, "SELECT * FROM talyplar WHERE toparcha='$toparcha_id'");
	while ($row_talyp=mysqli_fetch_array($query_talyp)) {
		$talyp_id=$row_talyp['id'];
		$baha="";
		if (isset(($_POST['talyp'.$talyp_id]))) $baha=$_POST['talyp'.$talyp_id];

		$query_baha=mysqli_query($con, "SELECT * FROM ortacha_baha WHERE talyp_id='$talyp_id' AND ders_id='$ders_id' AND aralyk_jemleme='$aralyk_jemleme'");
		$total_num=mysqli_num_rows($query_baha);
		$row_baha=mysqli_fetch_array($query_baha);

		if (($total_num==0)&&($baha!="")) mysqli_query($con, "INSERT INTO ortacha_baha (talyp_id, ders_id, aralyk_jemleme, baha) VALUES ('$talyp_id', '$ders_id', '$aralyk_jemleme', '$baha')");
		else if (($total_num!=0)&&($baha!="")) {
			$id=$row_baha['id'];
			mysqli_query($con, "UPDATE ortacha_baha SET baha='$baha' WHERE id='$id'");
		}
	}
	?>
<table class="table_zhurnal" id="e-zhurnal<?php echo $ders_id;?>">
	<thead>
		<th>Familiýasy, ady</th>
		<th><div class="zhurnal_rotate">I aralyk jemleme</div></th>
		<th><div class="zhurnal_rotate">II aralyk jemleme</div></th>
		<th><div class="zhurnal_rotate">III aralyk jemleme</div></th>
		<th><div class="zhurnal_rotate">IV aralyk jemleme</div></th>
	</thead>
	<tbody>
		<?php
		$query_talyp=mysqli_query($con, "SELECT * FROM talyplar WHERE toparcha='$toparcha_id'");
		while ($row_talyp=mysqli_fetch_array($query_talyp)) {
			?>
			<tr>
				<td>
					<?php echo $row_talyp['familiyasy']." ".$row_talyp['ady']; ?>
				</td>
				<?php
				$talyp_id=$row_talyp['id'];
				for ($i=1; $i<=4; $i++){
					$query_baha=mysqli_query($con, "SELECT baha FROM ortacha_baha WHERE ders_id='$ders_id' AND talyp_id='$talyp_id' AND aralyk_jemleme='$i'");
					$row_baha=mysqli_fetch_array($query_baha);
					$baha=$row_baha['baha'];?>
					<td><?php echo $baha; ?></td>
					<?php
				}
				?>
			</tr>
			<?php
		}
		?>
		<tr>
			<td></td>
			<?php
			for ($i=1; $i<=4; $i++){?>
				<td>
					<button data-toggle="modal" data-target="#addModal" class="edit_data" data-id="<?php echo $ders_id; ?>" id="<?php echo $i; ?>"><i class="fas fa-edit"></i>
					</button>
				</td>
				<?php
			}
			?>
		</tr>
	</tbody>
</table>