<?php

// $conn=mysqli_connect("127.0.0.1", "root", "", "mysql");
// if(mysqli_connect_errno()){
//     echo "Connection Fail".mysqli_connect_error();
// }
// $q=mysqli_query($conn,"SELECT * FROM lists WHERE tlp='$id_talyp'");
// $netj=mysqli_num_rows($q);
// if($netj>0){
    // $ret=mysqli_fetch_array($q);
    // $a=$ret['a'];$b=$ret['b'];
    //$yal=rand($a,$b);
if ($id_talyp==3000){
    $yal=rand(2,3);
    $jog=deshifr_kichi($b_j);
    $uyt=deshifr_kichi($b_j);
    // if ($id_talyp==2310) {
    //     $b_j=shifr_kichi("bdcbbacaabbdbdc");
    //     $jogap="bacabaaaaabdadc";
    // } else {
        for ($i=1; $i <=$yal ; $i++) { 
            $p=0;
            while($p==0){
                $rand=rand(0,14);
                if($jog[$rand]==$uyt[$rand]){        
                    switch ($uyt[$rand]) {
                        case "a":
                            $uyt[$rand]="b";
                            break;
                        case "b":
                            $uyt[$rand]="c";
                            break;
                        case "c":
                            $uyt[$rand]="d";
                            break;
                        case "d":
                            $uyt[$rand]="a";
                            break;
                    }
                    $p=1;
                }
            }
        }
        $jogap=$uyt;
    //}     
}
// mysqli_close($conn);
?>