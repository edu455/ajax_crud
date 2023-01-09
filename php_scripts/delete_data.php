<?php 
include 'database.php';
$product_id=$_POST['id'];
if(!empty($product_id)){
    $query='DELETE FROM PRODUCTS WHERE PRODUCT_ID=?';
    $stmt=mysqli_prepare($conn,$query);
    $stmt->bind_param('s',$product_id);
    if(!$stmt->execute()){
        die('Query failed: '.$stmt->errno);
    }
}