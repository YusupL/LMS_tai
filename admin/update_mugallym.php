<?php
include "dbcon.php";
  include "functions.php";
	$id=$_POST['id_mugallym'];
	$ady=$_POST['adym'];
	$fam=$_POST['famm'];
	$aady=$_POST['aadym'];
	$kafedra=$_POST['kafedra'];
	$login=$_POST['loginm'];
	$parol=shifr($_POST['parolm']);

	
	mysqli_query($con, "UPDATE mugallymlar SET ady='$ady', familiyasy='$fam', atasynyn_ady='$aady', kafedra='$kafedra' WHERE ulanyjy_id='$id'");
	mysqli_query($con, "UPDATE ulanyjylar SET login='$login', parol='$parol' WHERE id='$id'");
	


?>
<thead>
                    <tr>
                      <th>Id</th>
                      <th>Familiýasy</th>
                      <th>Ady</th>
                      <th>Atasynyň atasy</th>
                      <th>Hünäri</th>
                      <th>Login</th>
                      <th>Parol</th>
                      <th>Amal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include "dbconnection.php";
                      $query=mysqli_query($con,"select * from ulanyjylar");
                        while ($row=mysqli_fetch_array($query)){
                          $id=$row['id'];
                          if ($row['ulanyjy_tipi']==1){
                            $query_talyp=mysqli_query($con,"select * from talyplar WHERE ulanyjy_id='$id'");
                            while ($row_talyp=mysqli_fetch_array($query_talyp)) {
                              $id_talyp=$row_talyp['id'];


                              $query_toparcha=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar, talyplar WHERE hunarler.id=toparchalar.hunar and talyplar.toparcha=toparchalar.id and talyplar.id='$id_talyp'");
                              while ($row_toparcha=mysqli_fetch_array($query_toparcha)) {
                                $gysga_ady=$row_toparcha['gysga_ady'];
                                $yyl=$row_toparcha['yyl'];
                                $toparcha=$row_toparcha['toparcha'];
                                $gysga_ady=$gysga_ady." ".$yyl."0".$toparcha;
                              }

                              echo "<tr>
                                      <td>".$id."</td>
                                      <td>".$row_talyp['familiyasy']."</td>
                                      <td>".$row_talyp['ady']."</td>
                                      <td>".$row_talyp['atasynyn_ady']."</td>
                                      <td>".$gysga_ady."</td>
                                      <td>".$row['login']."</td>
                                      <td>".$row['parol']."</td>
                                      <td><button data-id=".$id."edit  data-toggle='modal' data-target='#EditModalTalyp' class='uytgetmek btn-sm btn-success'><i class='fas fa-edit'></i></button><button data-id=".$id." class='ochurmek btn-sm btn-danger'><i class='fas fa-trash'></i></button></td>
                                    </tr>";
                            }
                          }

                          if ($row['ulanyjy_tipi']==2){
                            $query_mugallym=mysqli_query($con,"select * from mugallymlar WHERE ulanyjy_id='$id'");
                            
                            while ($row_mugallym=mysqli_fetch_array($query_mugallym)) {
                              $id_kafedra=$row_mugallym['kafedra'];
                              $query_kafedra=mysqli_query($con, "SELECT gysga_ady FROM kafedralar WHERE id='$id_kafedra' ");
                              while ($row_kafedra=mysqli_fetch_array($query_kafedra)) {
                                $gysga_ady=$row_kafedra['gysga_ady'];
                              }

                              echo "<tr>
                                      <td>".$id."</td>
                                      <td>".$row_mugallym['familiyasy']."</td>
                                      <td>".$row_mugallym['ady']."</td>
                                      <td>".$row_mugallym['atasynyn_ady']."</td>
                                      <td>".$gysga_ady."</td>
                                      <td>".$row['login']."</td>
                                      <td>".$row['parol']."</td>
                                      <td><button data-id=".$id."edit  data-toggle='modal' data-target='#EditModalMugallym' class='uytgetmek btn-sm btn-success'><i class='fas fa-edit'></i></button><button data-id=".$id." class='ochurmek btn-sm btn-danger'><i class='fas fa-trash'></i></button></td>
                                    </tr>";
                            }
                          }
                        }
                    ?>
                  </tbody>