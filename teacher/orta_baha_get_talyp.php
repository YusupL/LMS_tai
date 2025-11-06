<?php
	include '..//dbconnection.php';

	$aralyk_jemleme=$_POST['aralyk_jemleme'];
	$ders_id=$_POST['ders_id'];
	
	$query_toparcha=mysqli_query($con, "SELECT toparcha_id FROM ders_maglumat WHERE id='$ders_id'");
	$row_toparcha=mysqli_fetch_array($query_toparcha);
	$toparcha_id=$row_toparcha['toparcha_id'];
	
	echo "<table class='table'>";
		$query_talyp=mysqli_query($con, "SELECT talyplar.id, talyplar.familiyasy, talyplar.ady, ortacha_baha.baha FROM talyplar LEFT JOIN ortacha_baha ON ortacha_baha.talyp_id=talyplar.id AND ortacha_baha.ders_id='$ders_id' AND ortacha_baha.aralyk_jemleme='$aralyk_jemleme' WHERE talyplar.toparcha='$toparcha_id' ORDER BY talyplar.id");
		while ($row_talyp=mysqli_fetch_array($query_talyp)) { ?>
			<tr>
				<td><?php $id_talyp=$row_talyp['id']; $baha=$row_talyp['baha']; echo $row_talyp['familiyasy']." ".$row_talyp['ady'] ?></td>
				<td>
					<select id="talyp<?php echo $row_talyp['id']; ?>" name="talyp<?php echo $row_talyp['id']; ?>">
						<option></option>
						<option <?php if ($baha=='2') echo "selected"; ?> value="2">2</option>
						<option <?php if ($baha=='3') echo "selected"; ?> value="3">3</option>
						<option <?php if ($baha=='4') echo "selected"; ?> value="4">4</option>
						<option <?php if ($baha=='5') echo "selected"; ?> value="5">5</option>
					</select>
				</td>
			</tr>
			<?php
		}
	echo "</table>";
?>