<?php
include "dbcon.php";
	$id=$_POST['id_ders'];
	$ders_ady_id=$_POST['ders_ady_id'];
	$ders_gornushi=$_POST['ders_gornushi'];
	$mug=$_POST['mug'];
	$hunar=$_POST['hunar'];
	$yyl=$_POST['yyly'];
	$toparcha=$_POST['topr'];
	$sagat_sany=$_POST['sagat_sany'];
  $arjem=$_POST['arjem'];
  $synagd=$_POST['synagd'];
	

	$result_hunar = mysqli_query($con, "SELECT * FROM hunarler WHERE gysga_ady='$hunar'");
	while ($row_hunar=mysqli_fetch_array($result_hunar)) {
		$hunar_id=$row_hunar['id'];
	}
	//echo "<br>";

	$result_toparcha = mysqli_query($con, "SELECT * FROM toparchalar WHERE hunar='$hunar_id' AND yyl='$yyl' AND toparcha='$toparcha'");
	while ($row_toparcha=mysqli_fetch_array($result_toparcha)) {
		$toparcha_id=$row_toparcha['id'];
	}

	mysqli_query($con, "UPDATE ders_maglumat SET ders_id='$ders_ady_id', toparcha_id='$toparcha_id',mug_id='$mug', gornushi='$ders_gornushi', sagat_sany='$sagat_sany', ara_syn_deg='$arjem', synag_degish='$synagd' WHERE id='$id'");
	

?>
<thead>
                    <tr>
                      <th>Id</th>
                      <th>Dersiň ady</th>
                      <th>Dersiň görnüşi</th>
                      <th>Okadýan mugallym</th>
                      <th>Okaýan toparça</th>
                      <th>Sagat sany</th>
                      <th>Amal</th>
                    </tr>
                  </thead>
                    <tbody>
                    <?php
                      include 'dbconnection.php';
                      $query_dersler=mysqli_query($con, "SELECT ders_maglumat.id AS ders_id, ders_atlary.ady AS ders_ady,  ders_gornushi.ady AS ders_gornushi, mugallymlar.familiyasy AS mug_fam, mugallymlar.ady AS mug_ady, hunarler.gysga_ady AS hunar_gysga_ady, toparchalar.yyl AS yyl, toparchalar.toparcha AS toparcha, ders_maglumat.sagat_sany AS sagat_sany FROM hunarler, toparchalar, ders_gornushi, ders_atlary, ders_maglumat, mugallymlar WHERE hunarler.id=toparchalar.hunar AND mugallymlar.id=ders_maglumat.mug_id AND ders_maglumat.toparcha_id=toparchalar.id AND ders_gornushi.id=ders_maglumat.gornushi AND ders_maglumat.ders_id=ders_atlary.id" );
                      while ($row_dersler=mysqli_fetch_array($query_dersler)){
                        $id=$row_dersler['ders_id'];
                        ?>
                        <tr>
                          <td><?php echo $row_dersler['ders_id']; ?></td>
                          <td><?php echo $row_dersler['ders_ady']; ?></td>
                          <td><?php echo $row_dersler['ders_gornushi']; ?></td>
                          <td><?php echo $row_dersler['mug_fam']." ".$row_dersler['mug_ady']; ?></td>
                          <td><?php echo $row_dersler['hunar_gysga_ady']." ".$row_dersler['yyl']."0".$row_dersler['toparcha']; ?></td>
                          <td><?php echo $row_dersler['sagat_sany']; ?></td>
                          <td><button data-id="edit<?php echo $id;?>"  data-toggle='modal' data-target='#EditModalDers' class='uytgetmek btn-sm btn-success'><i class='fas fa-edit'></i></button><button data-id=".$id." class='ochurmek btn-sm btn-danger'><i class='fas fa-trash'></i></button></td>
                        </tr>
                      <?php }
                    ?>
                  </tbody>