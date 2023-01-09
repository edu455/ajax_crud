<?php
include 'database.php';
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $supplier = $_POST['supplier'];
    $amount = $_POST['amount'];
    $price_per_unit = $_POST['price_per_unit'];
    if (!empty($name)&&!empty($description)&&!empty($supplier)&&!empty($amount)&&!empty($price_per_unit)) {
        $query = 'INSERT INTO PRODUCTS VALUES (NULL,?,?,?,?,?)';
        $stmt = mysqli_prepare($conn, $query);
        $stmt->bind_param('sssss', $name, $description, $supplier, $amount, $price_per_unit);
        if(!$stmt->execute()){
            die('Query failed: '.$stmt->errno);
        }
    }
}
