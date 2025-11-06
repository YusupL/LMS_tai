<?php
	include "dbcon.php";
	include "functions.php";
	date_default_timezone_set("Asia/Ashgabat");
	$yyl=$_POST['yyl'];
	$fakul=$_POST['fakul'];
	?>
	<div class="card">
	<div class="card-header justify-content-center d-flex p-0">               
	  <ul class="nav nav-pills p-1 text-lg">
		<li class="nav-item"><a class="nav-link active" href="#san" data-toggle="tab">Sanawjy</a></li>
		<li class="nav-item"><a class="nav-link" href="#may" data-toggle="tab">Maýdalawjy</a></li>                 
	  </ul>
	</div><!-- /.card-header -->
	<div class="card-body table-responsive p-1">
	  <div class="tab-content">
		<div class="tab-pane active" id="san">
		  <table class="table table-bordered table-striped text-center">
			<thead class="text-lg">
			  <tr id="reje">
				<th></th>
				<th></th>
				<?php
					$query_toparcha=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar WHERE hunarler.id=toparchalar.hunar AND hunarler.fakultet='$fakul' AND toparchalar.yyl='$yyl' ORDER BY toparchalar.id");
					while ($row_toparcha=mysqli_fetch_array($query_toparcha)){
						?>
						<th class="hgun"><?php echo $row_toparcha['gysga_ady']." ".$row_toparcha['yyl']."0".$row_toparcha['toparcha']; ?></th>
						<?php
					}
				?>
			  </tr>
			</thead>
			<tbody>
				<?php
				for ($g=0; $g<24; $g++){
					$gun=(int)($g/4)+1;
					$jubut=$g%4+1;
					?>
					<tr>
					<td><?php echo $gun; ?></th>
					<td><?php echo $jubut; ?></td>
					<?php
					$query_toparcha=mysqli_query($con, "SELECT toparchalar.id AS toparcha_id FROM hunarler, toparchalar WHERE hunarler.id=toparchalar.hunar AND hunarler.fakultet='$fakul' AND toparchalar.yyl='$yyl' ORDER BY toparchalar.id");
					while ($row_toparcha=mysqli_fetch_array($query_toparcha)){
						$toparcha_id=$row_toparcha['toparcha_id'];
						$query=mysqli_query($con, "SELECT umumy_reje.id, otaglar.nomer AS otag, ders_gornushi.ady as dgady, mugallymlar.ady AS mug_ady, mugallymlar.familiyasy as mug_fam, mug_dereje.dereje AS mug_dereje, ders_atlary.ady AS ders_ady FROM umumy_reje, ders_maglumat, otaglar, ders_gornushi, mugallymlar, mug_dereje, ders_atlary, ders_potok WHERE  ders_maglumat.id=umumy_reje.ders_id AND umumy_reje.otag=otaglar.id AND ders_maglumat.gornushi=ders_gornushi.id AND  mugallymlar.id=ders_maglumat.mug_id AND mug_dereje.id=mugallymlar.mug_dereje AND ders_atlary.id=ders_maglumat.ders_id AND ders_potok.ders_maglumat_id=ders_maglumat.id AND ders_potok.toparcha_id ='$toparcha_id' AND umumy_reje.gun='$gun' AND umumy_reje.jubut='$jubut'");
                        $row=mysqli_fetch_array($query);
						if (mysqli_num_rows($query)>0){
						?>
						<td><?php echo $row['ders_ady']; ?><b><br>(<?php echo $row['dgady']; ?>)</b><br><i><?php echo $row['mug_dereje']." ".$row['mug_fam']." ".$row['mug_ady'][0]."."; ?> </i><br><b> otag <?php echo $row['otag']; ?></b</td>
						<?php
						}
						else {?>
						<td></td>
						<?php
						}
					}
					?>
					</tr>
					<?php
				}
				?>                     
			</tbody>
		  </table>
		</div>
		<!-- /.tab-pane -->
		<div class="tab-pane" id="may">
		  <table class="table table-bordered table-striped text-center">
			<thead class="text-lg">
			  <tr id="reje">
				<th></th>
				<th class="hgun">Duşenbe</th>
				<th class="hgun">Sişenbe</th>
				<th class="hgun">Çarşenbe</th>
				<th class="hgun">Penşenbe</th>
				<th class="hgun">Anna</th>
				<th class="hgun">Şenbe</th>
			  </tr>
			</thead>
			<tbody>
							   
			<tr>
				<th class=" text-lg align-middle">1-nji jübüt</th>
				<td>SANLY  YKDYSADYÝET <b>(umumy)</b><br><i>mug. Galandarowa Ş.</i><br><b> otag 352</b</td>
				<td>HÄZIRKI ZAMAN TÜRKMEN JEMGYÝETI <b>(umumy)</b><br><i>mug. Ýuldaşewa H.</i><br><b> otag 319 </b></td>
				<td>  MAGLUMAT  ULGAMLARYNYŇ YGTYBARLYGY <b>(umumy)</b><br><i>mug.-öwr. Muhammedow B.</i><br><b> otag 362 </b></td>
				<td>  MAGLUMAT HOWPSUZLYGY WE MAGLUMATLARY GORAMAK <b>(umumy)</b><br><i>mug. Galandarowa Ş.</i><br><b> otag  368 </b></td>   
				<td>  Maglumat ulgamlarynyň ygtybarlygy  <b>(tejribe)</b><br><i>mug.-öwr. Muhammedow B.</i><br><b> otag  131 </b></td>   
				<td>  OBA HOJALYK ÖNÜMÇILIGINDE YKDYSADY MATEMATIKI MODELIRLEME <b>(umumy)</b><br><i>uly mug. Rahmanow A.</i><br><b> otag  352 </b></td>   
			  </tr> 
			  <tr>
				<th class=" text-lg align-middle">2-nji jübüt</th>
				<td>Sanly ykdysadyýet  <b>(tejribe) </b><br><i>mug. Galandarowa Ş.</i><br><b> otag 354</b</td>
				<td>MAGLUMAT  ULGAMLARYNY TASLAMAK <b>(umumy)</b><br><i> mug.-öwr. Rejepow B. </i><br><b> otag 352 </b></td>
				<td>  Oba hojalyk önümçiligi we telekeçiligi guramak <b>(umumy)</b><br><i>mug. Rejepow Ö. </i><br><b> otag  145 </b></td>
				<td> Sanly ykdysadyýet<b>(tejribe)</b><br><i>mug. Galandarowa Ş.</i><br><b> otag  349 </b></td>   
				<td> MAGLUMAT  ULGAMLARYNY ADMINISTRIRLEME  <b>(umumy)</b><br><i>mug.-öwr. Muhammedow N.</i><br><b> otag   361 </b></td>   
				<td> Maglumat howpsuzlygy we maglumatlary goramak  <b>(tejribe)</b><br><i> mug. Galandarowa Ş.</i><br><b> otag  353 </b></td>   
			  </tr>
			  <tr>
				<th class=" text-lg align-middle">3-nji jübüt</th>
				<td>Oba hojalyk önümçiliginde ykdysady-matematiki modelirleme<b>(tejribe) </b><br><i> uly mug. Rahmanow A.</i><br><b> otag 259</b</td>
				<td>Oba hojalyk önümçiligi we telekeçiligi guramak<b>(amaly)</b><br><i> mug. Rejepow Ö.</i><br><b> otag 355 </b></td>
				<td>Maglumat ulgamlaryny taslamak <b>(tejribe)</b><br><i>mug.-öwr. Rejepow B.</i><br><b> otag   359</b></td>
				<td>Hünär boýunça iňlis dili <b>(amaly)</b><br><i>mug. Rejepow O.</i><br><b> otag   334 </b></td>   
				<td> Maglumat ulgamlaryny taslamak <b>(tejribe)</b><br><i> mug.-öwr. Rejepow B.</i><br><b> otag   352 </b></td>   
				<td> Maglumat ulgamlaryny administrirleme<b>(tejribe)</b><br><i> mug.-öwr. Muhammedow N. </i><br><b> otag  349 </b></td>   
			  </tr>
			  <tr>
				<th class=" text-lg align-middle">4-nji jübüt</th>
				<td></td>
				<td></b></td>
				<td>Halypaçylyk sapagy<b>(söhbet)</b><br><i>mug. Welmedow H.</i><br><b> otag   350</b></td>
				<td></td>   
				<td> </td>   
				<td></td>   
			  </tr>                                  
			</tbody>
		  </table>
		</div>
		<!-- /.tab-pane -->                  
	  </div>
	  <!-- /.tab-content -->
	</div><!-- /.card-body -->
  </div>
  <!-- ./card -->
	<?php
?>

