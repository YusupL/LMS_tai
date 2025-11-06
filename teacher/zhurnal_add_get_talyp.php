<?php
	include '..//dbconnection.php';

	$id_dersler=$_POST['id_dersler'];
	$id_ders=explode("-",$id_dersler);

	echo "<table class='table'>";
	for ($i=0; $i<count($id_ders)-1; $i++){
		$ders=$id_ders[$i];

		$query_toparcha=mysqli_query($con, "SELECT toparcha_id FROM ders_maglumat WHERE id='$ders'");
		$row_toparcha=mysqli_fetch_array($query_toparcha);
		$toparcha=$row_toparcha['toparcha_id'];

		$query_talyp=mysqli_query($con, "SELECT talyplar.id, talyplar.ady, talyplar.familiyasy, talyplar.toparcha, hunarler.gornushi FROM talyplar, toparchalar, hunarler WHERE talyplar.toparcha=toparchalar.id AND toparchalar.hunar=hunarler.id AND talyplar.toparcha='$toparcha'");
		while ($row_talyp=mysqli_fetch_array($query_talyp)) { ?>
			<tr>
				<td><?php $id_talyp=$row_talyp['id']; echo $row_talyp['familiyasy']." ".$row_talyp['ady'] ?></td>
				<td>
					<select id="talyp<?php echo $row_talyp['id']; ?>" name="talyp<?php echo $row_talyp['id']; ?>">
						<?php
							if($row_talyp['gornushi']==1){
						?>
						<option></option>
						<option value="0">gm</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<?php }else { ?>
						<option></option>
						<option value="0">gm</option>
						<option value="1">Fx</option>
						<option value="2">F</option>
						<option value="3">E</option>
						<option value="4">D</option>
						<option value="5">C</option>
						<option value="6">B</option>
						<option value="7">A</option>
						<?php }?>
					</select>
				</td>
		</tr>
			<?php
		}
	}
	echo "</table>";
?>