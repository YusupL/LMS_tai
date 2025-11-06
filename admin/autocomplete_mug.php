<?php 
    include "dbcon.php";

    if(!isset($_GET['searchTerm'])){
        $json=[];
    }else{
        $search=$_GET['searchTerm'];
        $query=mysqli_query($con, "SELECT * FROM mugallymlar WHERE familiyasy LIKE '%$search%'");
        while($row=mysqli_fetch_array($query)){
            $json[]=['id'=>$row['id'], 'text'=>$row['familiyasy']." ".$row['ady']];
        }
    }
    echo json_encode($json);
?>