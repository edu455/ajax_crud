<?php 
include 'database.php';
$query='SELECT * FROM PRODUCTS';
$result=mysqli_query($conn,$query);
if(!$result){
    die('Query failed: '.mysqli_errno($conn));
}
if($result->num_rows>0){
    $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($rows);
}else{
    echo '';
}
