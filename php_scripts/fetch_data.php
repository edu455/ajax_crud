<?php
include 'database.php';
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $query = 'SELECT * FROM PRODUCTS WHERE PRODUCT_NAME LIKE ?';
    $stmt = mysqli_prepare($conn, $query);
    $product_name = '%' . $_POST['search'] . '%';
    $stmt->bind_param('s', $product_name);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($rows);
        }
    } else {
        die('Query failed: ' . $stmt->errno);
    }
}
