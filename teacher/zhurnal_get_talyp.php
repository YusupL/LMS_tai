<?php
	include '..//dbconnection.php';

	$id_dersler=$_POST['id_dersler'];
	$id_gech_ders_ler=$_POST['id'];

	$id_ders=explode("-",$id_dersler);
	
	if ($id_gech_ders_ler!=""){
	$id_gech_derss=explode("-",$id_gech_ders_ler);
	
	echo "<table class='table'>";
	for ($i=0; $i<count($id_ders)-1; $i++){
		$ders=$id_ders[$i];
		$id_gech_ders=$id_gech_derss[$i];

		$query_toparcha=mysqli_query($con, "SELECT toparcha_id FROM ders_maglumat WHERE id='$ders'");
		$row_toparcha=mysqli_fetch_array($query_toparcha);
		$toparcha=$row_toparcha['toparcha_id'];

		$query_talyp=mysqli_query($con, "SELECT talyplar.id, talyplar.ady, talyplar.familiyasy, talyplar.toparcha, sapak_bahalar.baha, sapak_bahalar.gech_ders_id FROM talyplar LEFT JOIN sapak_bahalar ON talyplar.id=sapak_bahalar.id_talyp AND sapak_bahalar.gech_ders_id='$id_gech_ders' WHERE talyplar.toparcha='$toparcha'");
		while ($row_talyp=mysqli_fetch_array($query_talyp)) { ?>
			<tr>
				<td><?php $id_talyp=$row_talyp['id']; $baha=$row_talyp['baha']; echo $row_talyp['familiyasy']." ".$row_talyp['ady'] ?></td>
				<td>
					<select id="talyp<?php echo $row_talyp['id']; ?>" name="talyp<?php echo $row_talyp['id']; ?>">
						<option></option>
						<option <?php if ($baha=='0') echo "selected"; ?> value="0">gm</option>
						<option <?php if ($baha=='2') echo "selected"; ?> value="2">2</option>
						<option <?php if ($baha=='3') echo "selected"; ?> value="3">3</option>
						<option <?php if ($baha=='4') echo "selected"; ?> value="4">4</option>
						<option <?php if ($baha=='5') echo "selected"; ?> value="5">5</option>
					</select>
				</td>
			</tr>
			<?php
		}
	}
	echo "</table>";
}
?>