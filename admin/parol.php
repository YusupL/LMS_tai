<?php
   include "dbcon.php"; 
   include "functions.php"; 
   function pass(){
       $comb='abcdefghijkmnopqrstuvwxyz123456789ABDEFGHJKLMNOPRSTUWYZ';
       $parol=array();
       $comblen=strlen($comb)-1;
       for ($i=0; $i <8 ; $i++) { 
           $n=rand(0,$comblen);
           $parol[]=$comb[$n];

       }
       return(implode($parol));
   }
   $query=mysqli_query($con,"SELECT * FROM ulanyjylar WHERE id=14");
   while($row=mysqli_fetch_array($query)){
        $idd=$row['id'];
        echo $idd."<br>";
        $p=pass();
        echo $p."<br>";
        $s_p=shifr($p);
        echo $s_p."<br>";
        mysqli_query($con,"UPDATE ulanyjylar SET parol='$s_p' where id='$idd'");
   }
   
?>
