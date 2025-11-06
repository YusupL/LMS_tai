<?php
    header('Content-Type: text/html; charset=utf-8');
    include "dbcon.php";

    $query=mysqli_query($con, "SELECT mugallymlar.ady, mugallymlar.familiyasy, ulanyjylar.parol, ulanyjylar.id, ulanyjylar.login FROM mugallymlar, ulanyjylar WHERE ulanyjylar.id=mugallymlar.ulanyjy_id AND ulanyjylar.id=14");
    while ($row=mysqli_fetch_array($query)) {
        $id=$row['id'];
        $B="";$C="";$D="";
        $A="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $a=strlen($A);
        $B=$row['parol'];
        $C="YUSER";
        $c=strlen($C);
        $b=strlen($B);
        if ($b>=$c){
            for($i=1; $i<=($b/$c); $i++){
                $D=$D.$C;
            }
            for ($j=0; $j<($b%$c); $j++){
                $D=$D.$C[$j];
            }
        } 
        else {
            for($s=0; $s<$b; $s++){
                $D=$D.$C[$s];
            }
        }

        for($k=0; $k<$b; $k++){
            $F[$k]=-1;
            for ($n=0; $n<$a; $n++){
                if($B[$k]==$A[$n]){
                    $F[$k]=$n;
                }
                if($D[$k]==$A[$n]){
                    $G[$k]=$n;
                }
            }
        }
        $e=0;
        for($u=0; $u<$b; $u++){
            if ($F[$u]!=-1){
                $e=(($F[$u]+$G[$u])%$a);
                $B[$u]=$A[$e];
            }
        }
        mysqli_query($con, "UPDATE ulanyjylar SET parol='$B' WHERE id='$id'");
    }
?>