<?php
	include "dbcon.php";
	include "functions.php";

	$yyly=$_POST['yyly'];
	$hunar=$_POST['hunar'];
	$sene=$_POST['sene'];
	if ($sene=="") $sene=date("Y-m-d");

	if (($yyly!="")&&($hunar!="")) {
		$query_toparcha=mysqli_query($con, "SELECT hunarler.gornushi, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, synag_reje.toparcha_id FROM synag_reje, toparchalar, hunarler WHERE hunarler.id=toparchalar.hunar AND synag_reje.toparcha_id=toparchalar.id AND toparchalar.yyl='$yyly' AND hunarler.id='$hunar'");
	} 
	else{
		$query_toparcha=mysqli_query($con, "SELECT hunarler.gornushi, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, synag_reje.toparcha_id FROM synag_reje, toparchalar, hunarler WHERE hunarler.id=toparchalar.hunar AND synag_reje.toparcha_id=toparchalar.id AND date_format(synag_reje.bashlayan_wagty, '%Y-%m-%d')='$sene'");
	}
	while ($row_toparcha=mysqli_fetch_array($query_toparcha)) {
		$toparcha=$row_toparcha['gysga_ady']." ".$row_toparcha['yyl']."0".$row_toparcha['toparcha'];
		$toparcha_id=$row_toparcha['toparcha_id'];
		$hunar_gornushi=$row_toparcha['gornushi'];

		$query_syn_tap=mysqli_query($con, "SELECT * FROM synag_tapgyr WHERE gornush='$hunar_gornushi'");
		$row_syn_tap=mysqli_fetch_array($query_syn_tap);
		$aralyk_jemleme=$row_syn_tap['aralyk_jemleme'];
		$sorag_sany=$row_syn_tap['sorag_sany'];

		$query_ders=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady, ders_maglumat.id AS ders_id FROM ders_maglumat, ders_atlary WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.ara_syn_deg='1' AND ders_maglumat.toparcha_id='$toparcha_id';");
		$total=mysqli_num_rows($query_ders);
		?>
			<table class="styled-table">
				<thead>
					<tr>
						<th colspan="<?php echo $total+2; ?>" style="background-color: white; color: black; font-size: 20px;"><?php echo $toparcha; ?></th>
					</tr>
					<tr>
						<th>T/b</th>
						<th>FAA</th>
						<?php
						while ($row_ders=mysqli_fetch_array($query_ders)) {
							?>
								<th class="rot"><?php echo $row_ders['ders_ady']; ?></th>
							<?php
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
					$query_talyp=mysqli_query($con, "SELECT * FROM talyplar WHERE toparcha='$toparcha_id'");
					$tb=0;
					while ($row_talyp=mysqli_fetch_array($query_talyp)) {
						$talyp_id=$row_talyp['id'];
						$tb++;
						?>
							<tr>
								<td><?php echo $tb; ?></td>
								<td><?php echo $row_talyp['familiyasy']." ".$row_talyp['ady']; ?></td>
								<?php
								$query_ders=mysqli_query($con, "SELECT ders_maglumat.id AS ders_id FROM ders_maglumat, ders_atlary WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.ara_syn_deg='1' AND ders_maglumat.toparcha_id='$toparcha_id';");
								while ($row_ders=mysqli_fetch_array($query_ders)){
										$ders_id=$row_ders['ders_id'];

										//garysyk test gornushli testlerden dogry sanyny hasaplayar
										$query_bellenen_jogap_test=mysqli_query($con, "SELECT bolmaly_jogap, bellenen_jogap FROM bellenen_jogap_test WHERE talyp_id='$talyp_id' AND ders_id='$ders_id' AND aralyk_jemleme='$aralyk_jemleme'");
										$total_bjt=mysqli_num_rows($query_bellenen_jogap_test);
										$d=0;
										if ($total_bjt>0){
											$row_bellenen_jogap_test=mysqli_fetch_array($query_bellenen_jogap_test);
											$bolmaly_jogap=deshifr_kichi($row_bellenen_jogap_test['bolmaly_jogap']);
											$bellenen_jogap=$row_bellenen_jogap_test['bellenen_jogap'];
											for ($i=0; $i<$sorag_sany; $i++) if ($bolmaly_jogap[$i]==$bellenen_jogap[$i]) $d++;
										}

										//pdf gprnuishli testler uchin dogry sany
										$query_bellenen_jogap_pdf=mysqli_query($con, "SELECT testler_pdf.jogap, bellenen_jogap_pdf.bellenen_jogap, bellenen_jogap_pdf.talyp_id, bellenen_jogap_pdf.ders_id, bellenen_jogap_pdf.aralyk_jemleme FROM testler_pdf, bellenen_jogap_pdf WHERE testler_pdf.ders_id=bellenen_jogap_pdf.ders_id AND bellenen_jogap_pdf.aralyk_jemleme='$aralyk_jemleme' AND testler_pdf.aralyk_jemleme='$aralyk_jemleme' AND bellenen_jogap_pdf.talyp_id='$talyp_id' AND bellenen_jogap_pdf.ders_id='$ders_id'");

										$total_bjp=mysqli_num_rows($query_bellenen_jogap_pdf);
										if ($total_bjp>0){
											$row_bellenen_jogap_pdf=mysqli_fetch_array($query_bellenen_jogap_pdf);
											$bolmaly_jogap=deshifr_kichi($row_bellenen_jogap_pdf['jogap']);
											$bellenen_jogap=$row_bellenen_jogap_pdf['bellenen_jogap'];
											$d=0;
											for ($i=0; $i<$sorag_sany; $i++) if ($bolmaly_jogap[$i]==$bellenen_jogap[$i]) $d++;
										}
										if (($total_bjp==0)&&($total_bjt==0)) $test_baha="..."; else $test_baha=round($d/$sorag_sany*5, 2);

										//ortacha baha
										$query_ortacha_baha=mysqli_query($con, "SELECT * FROM ortacha_baha WHERE talyp_id='$talyp_id' AND ders_id='$ders_id' AND aralyk_jemleme='$aralyk_jemleme'");
										$total_ob=mysqli_num_rows($query_ortacha_baha);
										if ($total_ob>0){
											$row_ortacha_baha=mysqli_fetch_array($query_ortacha_baha);
											$orta_baha=$row_ortacha_baha['baha'];
										}
										else $orta_baha="...";

										if (($test_baha!="...")&&($orta_baha!="...")) $jem_baha=round(($test_baha+$orta_baha)/2); 
										else if (($test_baha!="...")&&($orta_baha=="...")) $jem_baha=$test_baha;
											else $jem_baha="...";

									?>
										<td><?php echo $test_baha." | ".$orta_baha." | ".$jem_baha; ?></td>
									<?php
								}
								?>
							</tr>
						<?php
					}
					?>
				</tbody>
			</table>
					<?php
	?>
	<?php
	}
?>