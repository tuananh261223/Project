<?php
session_start();
include '../connect.php';


if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Xóa dữ liệu từ cơ sở dữ liệu
    $sql = "DELETE FROM check_in WHERE id = $id";

    if (mysqli_query($dbc, $sql)) {
        echo "Dữ liệu đã được xóa thành công";
    } else {
        echo "Lỗi xóa dữ liệu: " . mysqli_error($dbc);
    }

    // Chuyển hướng trở lại trang booked.php sau khi xóa dữ liệu
    header('Location: booked.php');
} else {
    echo "Không có dữ liệu được xóa";
}
?>