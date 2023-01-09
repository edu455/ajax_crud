<?php
include 'database.php';
// update product into the products table, the table values are these: product_id,product_name,product_description,product_supplier,product_amount,product_price_per_unit
//first it must check if the $_post isset and not empty
if (isset($_POST['id']) && !empty($_POST['id'])) {
    //then it must check if the product exists
    if (check_product($_POST['id'])) {
        //if the product exists, then it must update the product
        $query = 'UPDATE products SET PRODUCT_NAME=?,PRODUCT_DESCRIPTION=?,PRODUCT_SUPPLIER=?,PRODUCT_AMOUNT=?,PRODUCT_PRICE_PER_UNIT=? WHERE PRODUCT_ID=?';
        $stmt = mysqli_prepare($conn, $query);
        $id=$_POST['id'];
        $name=$_POST['name'];
        $description=$_POST['description'];
        $supplier=$_POST['supplier'];
        $amount=$_POST['amount'];
        $price=$_POST['price_per_unit'];
        $stmt->bind_param('ssssss', $name, $description, $supplier, $amount, $price,$id );
        if ($stmt->execute()) {
            echo 'Product updated successfully';
        } else {
            die('Query failed: ' . $stmt->errno);
        }
    } else {
        echo 'Product does not exist';
    }
}