
<?php
// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$name = $_POST['name'];
$contact = $_POST['contact'];
$date_in = $_POST['date_in'];
$date_out = $_POST['date_out'];
$room = $_POST["room"];

// Kiểm tra trạng thái của phòng
$checkSql = "SELECT status FROM room WHERE room_number = '$room'";
$result = $conn->query($checkSql);


// Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng 'check_in'
$sql = "INSERT INTO check_in (name, contact, date_in, date_out, room)
        VALUES ('$name', '$contact', '$date_in', '$date_out','$room')";

// Thực thi câu lệnh SQL
if ($conn->query($sql) === TRUE) {
    // Cập nhật dữ liệu "status" trong bảng "rooms" từ 0 thành 1
    $updateSql = "UPDATE rooms SET status = '1' WHERE room = '$room'";
    if ($conn->query($updateSql) === TRUE) {
        // Chuyển hướng về trang success.php và truyền các thông tin cần hiển thị
        header("Location: success.php?name=$name&contact=$contact&date_in=$date_in&date_out=$date_out&room=$room");
        exit();
    } else {
        echo "Lỗi khi cập nhật dữ liệu phòng: " . $conn->error;
    }
} else {
    echo "Lỗi khi chèn dữ liệu: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>