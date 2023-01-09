<?php
include 'database.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (!empty($id)) {
        $query = 'SELECT * FROM products WHERE product_id=?';
        $stmt = mysqli_prepare($conn, $query);
        $stmt->bind_param('s', $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows> 0) {
                $rows = mysqli_fetch_assoc($result);
                echo json_encode($rows);
            } else {
                echo '';
            }
        } else {
            die('Query failed: ' . $stmt->errno);
        }
    }
}
