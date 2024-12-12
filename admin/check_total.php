<?php
	session_start();
	include '../connect.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" type="image/jpg" href="../img/icon_admin.png"/>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
	<title>Rooms - Management System</title>
	<style>
	</style>
</head>
<body>
  <?php
  if(!isset($_SESSION['username'])) {
    header('Location: login.php');
  }
  ?>
		<section id="left-bar">
    <h2>FLC GRAND HOTEL</h2>
		<h3>MANAGEMENT SYSTEM</h3>
		<a href="index.php">Home</a>
		<a href="booked.php">Booked</a>
		<a href="check_total.php">Check Total</a>
    <a href="total.php">Total</a>
		<a href="rooms.php">Rooms</a>
		<a href="bookadm.php">Bookroom</a>
    <a href="total_amount.php">Total amount</a>
		<a href="logout.php">Logout</a>
	</section>

	


	<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Lấy thông tin từ bảng check_in
$sql = "SELECT * FROM check_in";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Hiển thị thông tin trong form và tính giá tiền phòng
    echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>";
    echo "<div style='background-color: #f1f1f1; padding: 20px; border-radius: 5px;'>";
    echo "<form>";

    // Mảng phân loại phòng và giá tiền tương ứng
    $roomCategories = [
        'Room 101' => 120,
        'Room 102' => 120,
        'Room 103' => 120, //Phòng đơn
        'Room 104' => 200,
        'Room 105' => 200,
        'Room 106' => 200, //phòng đôi
        'Room 201' => 400,
        'Room 202' => 400,
        'Room 203' => 400, //phòng gia đình
        'Room 301' => 350,
        'Room 302' => 350, //phòng sang trọng
        'Room 401' => 650,
        'Room 402 (S Room)' => 650, //phòng thượng hạng
    ];

    while ($row = $result->fetch_assoc()) {
        echo "Id: " . $row['id'] . "<br>";
        echo "Name: " . $row['name'] . "<br>";
        echo "Contact: " . $row['contact'] . "<br>";
        echo "Date In: " . $row['date_in'] . "<br>";
        echo "Date Out: " . $row['date_out'] . "<br>";
        echo "Room: " . $row['room'] . "<br>";
    
  
        // Tính số ngày đã ở
        $dateIn = strtotime($row['date_in']);
        $dateOut = strtotime($row['date_out']);
        $daysStayed = ($dateOut - $dateIn) / (60 * 60 * 24);

        // Kiểm tra phân loại phòng của khách hàng
        $roomCategory = $row['room'];

        // Kiểm tra xem phân loại phòng có tồn tại trong mảng phân loại phòng hay không
        if (array_key_exists($roomCategory, $roomCategories)) {
            // Kiểm tra xem bản ghi đã tồn tại trong bảng "money" hay chưa
            $checkSql = "SELECT id FROM money WHERE name = '" . $row['name'] . "' AND contact = '" . $row['contact'] . "' AND date_in = '" . $row['date_in'] . "' AND date_out = '" . $row['date_out'] . "' AND room = '" . $row['room'] . "'";
            $checkResult = $conn->query($checkSql);

            if ($checkResult->num_rows > 0) {
                echo "Dữ liệu đã tồn tại trong bảng money.<br><br>";
            } else {
                // Tính giá tiền phòng
                $pricePerNight = $roomCategories[$roomCategory];
                $totalPrice = $pricePerNight * $daysStayed;

                // Chèn dữ liệu vào bảng "money"
                $insertSql = "INSERT INTO money ( name, contact, date_in, date_out, room, total_price) VALUES ('" . $row['name'] . "', '" . $row['contact'] . "', '" . $row['date_in'] . "', '" . $row['date_out'] . "', '" . $row['room'] . "', $totalPrice)";
                if($conn->query($insertSql) === TRUE) {
                    echo "Dữ liệu đã được chèn thành công vào bảng money.<br><br>";
                } else {
                    echo "Lỗi khi chèn dữ liệu vào bảng money: " . $conn->error . "<br><br>";
                }

                echo "Số ngày đã ở: " . $daysStayed . "<br>";
                echo "Giá tiền mỗi đêm: " . $pricePerNight . " USD<br>";
                echo "Tổng giá tiền phòng: " . $totalPrice . " USD<br><br>";
            }
        } else {
            echo "Không tìm thấy phân loại phòng.<br><br>";
        }
    }
    echo "</form>";
    echo "</div>";
    echo "</div>";
} else {
    echo "Không có dữ liệu check-in.";
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>
</body>

</html>
