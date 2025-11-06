<?php 
	function shifr($soz){
		$B="";$C="";$D="";
        $A="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $a=strlen($A);
        $B=$soz;
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
        return $B;
    }

    function deshifr($soz){
        $B="";$C="";$D="";
        $A="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $a=strlen($A);
        $B=$soz;
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
        for($u=0; $u<$b; $u++){
            if ($F[$u]!=-1){                    
                if ($F[$u]-$G[$u]<0){
                    $e=$F[$u]-$G[$u]+$a;
                } else
                $e=$F[$u]-$G[$u];
                $B[$u]=$A[$e];
            }
        }
        return $B;
    }

    function shifr_kichi($soz){
        $B="";$C="";$D="";
        $A="abcdefghijklmnopqrstuvwxyz";
        $a=strlen($A);
        $B=$soz;
        $C="yuser";
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
        return $B;
    }

    function deshifr_kichi($soz){
        $B="";$C="";$D="";
        $A="abcdefghijklmnopqrstuvwxyz";
        $a=strlen($A);
        $B=$soz;
        $C="yuser";
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
        for($u=0; $u<$b; $u++){
            if ($F[$u]!=-1){                    
                if ($F[$u]-$G[$u]<0){
                    $e=$F[$u]-$G[$u]+$a;
                } else
                $e=$F[$u]-$G[$u];
                $B[$u]=$A[$e];
            }
        }
        return $B;
    }
    function get_between($input, $start, $end){
        $substr = substr($input, strlen($start)+strpos($input, $start), (strlen($input) - strpos($input, $end))*(-1));
        return $substr;
    }
    function GetMac(){
        $ip = $_SERVER['REMOTE_ADDR'];
        $mac=shell_exec("arp -a ".$ip);
        $mac_string = shell_exec("arp -a $ip");
        $mac_array = explode("\n",$mac_string);
        $string = $mac_array[3];
        $spos=strpos($string, "-");
        $mac=substr($string, $spos-2, 17);
    
        return $mac;
    }
?>