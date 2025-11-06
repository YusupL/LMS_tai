<?php 
    include "dbcon.php";
    $id=$_POST['id'];
    $query=mysqli_query($con, "SELECT * FROM hunarler WHERE fakultet='$id'");
    while($row=mysqli_fetch_array($query)){
?>
        <option value="<?=$row['id']?>"><?=$row['gysga_ady']?></option>
<?php
    }    
?>