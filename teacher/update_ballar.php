<?php
  include '../dbconnection.php';
  session_start();
  $id_ulanyjy=$_SESSION['id'];
  $id=$_POST['idbal'];
  $sany=$_POST['sany'];
  $sene=$_POST['sene'];
  $bellik=$_POST['bellik'];	
  mysqli_query($con, "UPDATE ballar SET sany='$sany', sene='$sene', bellik='$bellik' WHERE id='$id'");
?>
<thead>
                <tr class="text-center">
                <th style="width: 5%;">T/b</th>
                <th style="width: 30%;">Bölümçe</th>
                <th style="width: 10%;">Sene</th>
                <th style="width: 35%;">Bellik</th>
                <th style="width: 5%;">Sany</th>
                <th style="width: 5%;">Baly</th>
                <th style="width: 5%;">Sazlama</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $qballar=mysqli_query($con, "SELECT * FROM ballar WHERE ulanyjy_id='$id_ulanyjy' ORDER BY id DESC");
                    $i=0;
                    while ($rballar=mysqli_fetch_array($qballar)){
                      $i++;
                      $bid=$rballar['bolumche_id'];
                      $rbolumche=mysqli_fetch_array(mysqli_query($con, "SELECT ady FROM bolumcheler WHERE id='$bid'"));
                      $bolumche=$rbolumche['ady'];
                      $sene=$rballar['sene'];
                      $sany=$rballar['sany'];
                      $bellik=$rballar['bellik'];
                      $balid=$rballar['id'];
                      $baly=$rballar['baly'];                    
                  ?>
                    <tr>
                      <td><?=$i?></td>
                      <td><?=$bolumche?></td>
                      <td><?=$sene?></td>
                      <td><?=$bellik?></td>
                      <td><?=$sany?></td>
                      <td><?=$baly?></td>
                      <td> 
                        <div class="btn-group">
                          <button data-id="<?=$balid?>" type="button" class="ochurmek btn btn-danger btn-flat">
                            <i class="fas fa-trash"></i>
                          </button>                          
                          </button>
                          <button data-id="<?=$balid?>"  data-toggle='modal' data-target='#editbal' type="button" class="uytget btn btn-default btn-flat">
                            <i class="fas fa-edit"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                <?php 
                  }
                ?>
              </tbody>