<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}

// Xử lý sự kiện ấn nút
if (isset($_POST['button_name'])) {
    // Lấy giá trị của dòng cần chỉnh sửa
    $row_id = $_POST['row_id'];

    // Kiểm tra giá trị hiện tại của cột
    $sql_check = "SELECT status FROM rooms WHERE id = $row_id";
    $result_check = mysqli_query($conn, $sql_check);

    if ($result_check && mysqli_num_rows($result_check) > 0) {
        $row = mysqli_fetch_assoc($result_check);
        $current_status = $row['status'];

        // Thay đổi giá trị của dòng
        $new_status = ($current_status == 0) ? 1 : 0;

        // Thực hiện truy vấn để chỉ thay đổi giá trị của dòng cần chỉnh sửa
        $sql_update = "UPDATE rooms SET status = $new_status WHERE id = $row_id";
        header('Location: rooms.php');
        if (mysqli_query($conn, $sql_update)) {
            echo "Dòng có id $row_id đã được thay đổi giá trị thành công";
        } else {
            echo "Lỗi thay đổi giá trị dòng có id $row_id: " . mysqli_error($conn);
        }
    } else {
        echo "Không tìm thấy dòng có id $row_id";
    }
}

// Đóng kết nối
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Status</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        .form-container {
            width: 400px;
            padding: 20px;
            background: #f1f1f1;
            border-radius: 5px;
        }
        .form-container h1 {
            text-align: center;
        }
        .form-container form {
            margin-top: 20px;
        }
        .form-container form input[type="text"],
        .form-container form button[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container form button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .form-container form button[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-container a {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    
<div class="form-wrapper">
        <div class="form-container">
<h1>Nhập id phòng</h1>
    <form method="post">
        <input type="text" name="row_id" placeholder="Nhập id của phòng">
        <button type="submit" name="button_name">Thay đổi</button>
    </form>
    <a href="rooms.php">Quay lại trang chính</a>
</body>
</html>