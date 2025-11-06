<?php
    include "../dbconnection.php";
    $id=$_POST['id'];
    $qbolumche=mysqli_query($con, "SELECT * FROM bolumcheler WHERE bolum_id='$id'");
    while ($rbolumche=mysqli_fetch_array($qbolumche)){?>
        <option value="<?=$rbolumche['id']?>"><?=$rbolumche['ady']." - ".$rbolumche['baly']." ball"?></option>
<?php    
    }  
?>