<?php
	include '../dbconnection.php';
	include '../admin/functions.php';
	$yyly=$_POST['yyly'];
	$hunar=$_POST['hunar'];
	// $sene=$_POST['sene'];
	// if ($sene=="") $sene=date("Y-m-d");
	if (($yyly!="")&&($hunar!="")) {
		$query_toparcha=mysqli_query($con, "SELECT hunarler.gornushi, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, synag_reje.toparcha_id FROM synag_reje, toparchalar, hunarler WHERE hunarler.id=toparchalar.hunar AND synag_reje.toparcha_id=toparchalar.id AND toparchalar.yyl='$yyly' AND hunarler.id='$hunar'");
	} 
	else{
		$query_toparcha=mysqli_query($con, "SELECT hunarler.gornushi, hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha, synag_reje.toparcha_id FROM synag_reje, toparchalar, hunarler WHERE hunarler.id=toparchalar.hunar AND synag_reje.toparcha_id=toparchalar.id AND bellenen_jogap_test.sene='$sene'");
	}
	while ($row_toparcha=mysqli_fetch_array($query_toparcha)) {
		$toparcha=$row_toparcha['gysga_ady']." ".$row_toparcha['yyl']."0".$row_toparcha['toparcha'];
		$toparcha_id=$row_toparcha['toparcha_id'];
		$hun_gor=$row_toparcha['gornushi'];

		$query_syn_tap=mysqli_query($con, "SELECT * FROM synag_tapgyr WHERE gornush='$hun_gor'");
		$row_syn_tap=mysqli_fetch_array($query_syn_tap);
		$aralyk_jemleme=$row_syn_tap['aralyk_jemleme'];
		$sorag_sany=$row_syn_tap['sorag_sany'];

		$query_ders=mysqli_query($con, "SELECT ders_atlary.ady AS ders_ady, ders_maglumat.id AS ders_id FROM ders_maglumat, ders_atlary, ders_potok WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.ara_syn_deg='1' AND ders_potok.toparcha_id='$toparcha_id' AND ders_potok.ders_maglumat_id=ders_maglumat.id;");
		$total=mysqli_num_rows($query_ders);
		?>
		<div class="col-12">
			<div class="card card-success">
          		<div class="card-header">
					<h3 class="card-title"><?=$toparcha?></h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
						</button>
					</div>
					<!-- /.card-tools -->
				</div>
				<!-- /.card-header -->
          		<div class="card-body">
					<table class="table table-head-fixed table-hover table-valign-middle text-center">
						<thead>							
							<tr>
								<th >T/b</th>
								<th >FAA</th>
								<?php
								while ($row_ders=mysqli_fetch_array($query_ders)) {
									?>
										<th style="width: 10%;"><?php echo $row_ders['ders_ady']; ?></th>
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
										$query_ders=mysqli_query($con, "SELECT ders_maglumat.id AS ders_id FROM ders_maglumat, ders_atlary, ders_potok WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_maglumat.ara_syn_deg='1' AND ders_potok.toparcha_id='$toparcha_id' AND ders_potok.ders_maglumat_id=ders_maglumat.id;");
										while ($row_ders=mysqli_fetch_array($query_ders)){
												$ders_id=$row_ders['ders_id'];
												//garysyk test gornushli testlerden dogry sanyny hasaplayar
												$query_bellenen_jogap_test=mysqli_query($con, "SELECT * FROM bellenen_jogap_test WHERE talyp_id='$talyp_id' AND ders_id='$ders_id' AND aralyk_jemleme='$aralyk_jemleme'");
												$total_bjt=mysqli_num_rows($query_bellenen_jogap_test);
												$d=0;
												$ball=0;
												if ($total_bjt>0){
													$row_bellenen_jogap_test=mysqli_fetch_array($query_bellenen_jogap_test);
													$m_jogap=deshifr_kichi($row_bellenen_jogap_test['bolmaly_jogap']);
													$t_jogap=$row_bellenen_jogap_test['bellenen_jogap'];
													$ssa=strlen($m_jogap);
                                                    if($hun_gor==1){
														$test_baha=0;
                                                      $d=0;
                                                      $y=0;
                                                      for ($j=0; $j<strlen($m_jogap); $j++){
                                                        if ($m_jogap[$j]==$t_jogap[$j]) $d++; else $y++;
                                                      }  
                                                      $test_baha=$d/$ssa*5;
                                                      $test_baha=round($test_baha, 2);
                                                    }
                                                    if ($hun_gor==2){														
														$baly=$row_bellenen_jogap_test['baly'];
                                                      	$barr=explode("-", $baly);
                                                      	for ($j=0; $j<strlen($m_jogap); $j++){
															if ($m_jogap[$j]==$t_jogap[$j]){
															$ball+=$barr[$j];
															$d++;                                                          
                                                        }
                                                      } 
                                                    }
												}

												//pdf gprnuishli testler uchin dogry sany
												// $query_bellenen_jogap_pdf=mysqli_query($con, "SELECT testler_pdf.jogap, bellenen_jogap_pdf.bellenen_jogap, bellenen_jogap_pdf.talyp_id, bellenen_jogap_pdf.ders_id, bellenen_jogap_pdf.aralyk_jemleme FROM testler_pdf, bellenen_jogap_pdf WHERE testler_pdf.ders_id=bellenen_jogap_pdf.ders_id AND bellenen_jogap_pdf.aralyk_jemleme='$aralyk_jemleme' AND testler_pdf.aralyk_jemleme='$aralyk_jemleme' AND bellenen_jogap_pdf.talyp_id='$talyp_id' AND bellenen_jogap_pdf.ders_id='$ders_id'");

												// $total_bjp=mysqli_num_rows($query_bellenen_jogap_pdf);
												// if ($total_bjp>0){
												// 	$row_bellenen_jogap_pdf=mysqli_fetch_array($query_bellenen_jogap_pdf);
												// 	$m_jogap=$row_bellenen_jogap_pdf['jogap'];
												// 	$t_jogap=$row_bellenen_jogap_pdf['bellenen_jogap'];
												// 	$d=0;
												// 	for ($i=0; $i<$sorag_sany; $i++) if ($m_jogap[$i]==$t_jogap[$i]) $d++;
												// }
												// if (($total_bjp==0)&&($total_bjt==0)) $test_baha="..."; else $test_baha=round($d/$sorag_sany*5, 2);

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
												<td>
													<?php
													if($hun_gor==1){ echo $test_baha." | ".$orta_baha." | ".$jem_baha;
													$test_baha=0;}
													//if($hun_gor==1){ echo $jem_baha;}
													if ($hun_gor==2) {echo $ball;} 
													?>
												</td>
											<?php
										}
										?>
									</tr>
								<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
					<?php
	?>
	<?php
	}
?>