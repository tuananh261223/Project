<?php
session_start();
include '../connect.php';


if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Xóa dữ liệu từ cơ sở dữ liệu
    $sql = "DELETE FROM money WHERE id = $id";

    if (mysqli_query($dbc, $sql)) {
        echo "Dữ liệu đã được xóa thành công";
    } else {
        echo "Lỗi xóa dữ liệu: " . mysqli_error($dbc);
    }

  
    header('Location: total.php');
} else {
    echo "Không có dữ liệu được xóa";
}
?>