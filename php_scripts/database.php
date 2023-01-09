<?php
    const db_host='localhost';
    const db_username='root';
    const db_password='';
    const db_name='inventory';
    $conn=mysqli_connect(db_host,db_username,db_password,db_name);
    if($conn->errno){
        die('Database connection failed: '.$conn->errno);
    }
    //Function to check if product exists, will accept product_id as parameter
    function check_product($product_id){
        global $conn;
        $query='SELECT * FROM PRODUCTS WHERE PRODUCT_ID=?';
        $stmt=mysqli_prepare($conn,$query);
        $stmt->bind_param('i',$product_id);
        if($stmt->execute()){
            $result=$stmt->get_result();
            if($result->num_rows>0){
                return true;
            }else{
                return false;
            }
        }else{
            die('Query failed: '.$stmt->errno);
        }
    }       