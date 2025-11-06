<?php
  include "../dbconnection.php";
  include '../admin/functions.php';

  session_start();
    $id_ulanyjy=$_SESSION['id'];
    $query=mysqli_query($con, "SELECT * FROM synag_tapgyr");
    while ($row=mysqli_fetch_array($query)){
        if ($row['gornush']=='1'){
            $adaty_yy=$row['yarymyyllyk'];
            $adaty_aj=$row['aralyk_jemleme'];
            $adaty_ss=$row['sorag_sany'];
        }
        if ($row['gornush']=='2'){
            $bakalawr_yy=$row['yarymyyllyk'];
            $bakalawr_aj=$row['aralyk_jemleme'];
            $bakalawr_ss=$row['sorag_sany'];
        }
        if ($row['gornush']=='3'){
            $pod_yy=$row['yarymyyllyk'];
            $pod_aj=$row['aralyk_jemleme'];
            $pod_ss=$row['sorag_sany'];
        }
    }


  $id=$_POST['id_test'];
	$sorag=shifr_kichi($_POST['sorag']);
	$jogap_1=shifr_kichi($_POST['jogap_1']);
	$jogap_2=shifr_kichi($_POST['jogap_2']);
	$jogap_3=shifr_kichi($_POST['jogap_3']);
	$jogap_4=shifr_kichi($_POST['jogap_4']);

	mysqli_query($con, "UPDATE testler SET sorag='$sorag', jogap1='$jogap_1', jogap2='$jogap_2', jogap3='$jogap_3', jogap4='$jogap_4', yuklenen_wagty=now() WHERE id='$id'");

?>
<tr>
  <th style="width: 1%;">T/B</th>
  <th style="width: 37%;">Sorag</th>
  <th style="width: 12.5%;">Dogry jogap</th>
  <th style="width: 12.5%;">Ýalňyş jogap</th>
  <th style="width: 12.5%;">Ýalňyş jogap</th>
  <th style="width: 12.5%;">Ýalňyş jogap</th>
  <th style="width: 8%">Toparçalar</th>
  <th style="width: 8%">Amal</th>
</tr>
<?php
  $query_test=mysqli_query($con, "SELECT testler_degishlilik.id, testler.id AS id_test, testler.sorag, testler.jogap1, testler.jogap2, testler.jogap3, testler.jogap4 FROM testler, mugallymlar, ders_maglumat, testler_degishlilik WHERE mugallymlar.ulanyjy_id='$id_ulanyjy' AND (testler.aralyk_jem='$adaty_aj' OR testler.aralyk_jem='$bakalawr_aj' OR testler.aralyk_jem='$pod_aj') AND mugallymlar.id=ders_maglumat.mug_id AND ders_maglumat.id=testler_degishlilik.ders_id AND testler_degishlilik.test_id=testler.id GROUP BY testler.id");

  $tb=0;
    while ( $row_test=mysqli_fetch_array($query_test)) {
      $tb++;
      $id_test=$row_test['id_test']; ?>
      <tr>
        <td><?php echo $tb;?></td>
        <td><?php echo deshifr_kichi($row_test['sorag']); ?></td>
        <td><?php echo deshifr_kichi($row_test['jogap1']); ?></td>
        <td><?php echo deshifr_kichi($row_test['jogap2']); ?></td>
        <td><?php echo deshifr_kichi($row_test['jogap3']); ?></td>
        <td><?php echo deshifr_kichi($row_test['jogap4']); ?></td>
        <td>
          <?php 
          $query_toparcha=mysqli_query($con, "SELECT hunarler.gysga_ady, toparchalar.yyl, toparchalar.toparcha FROM hunarler, toparchalar, ders_maglumat, testler_degishlilik WHERE testler_degishlilik.test_id='$id_test' AND hunarler.id=toparchalar.hunar AND ders_maglumat.toparcha_id=toparchalar.id AND ders_maglumat.id=testler_degishlilik.ders_id");

          while ($row_toparcha=mysqli_fetch_array($query_toparcha)) {
            echo $row_toparcha['gysga_ady'].$row_toparcha['yyl']."0".$row_toparcha['toparcha']." ";
          }
          ?>
        </td>
          <td><div><button data-id="edit<?php echo $id_test;?>"  data-toggle='modal' data-target='#EditModalTest' class='uytgetmek'><i class="fas fa-edit"></i></button><br><button  data-id="delete<?php echo $id_test;?>" class='ochurmek'><i class="fas fa-trash-alt"></i></button></div></td>
      </tr>
      <?php
    }
    ?>