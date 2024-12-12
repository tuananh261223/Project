
<?php

$room_price = 0;
      if ($_GET['room'] === "Room 101") {
        $room_price = 120; 
      } elseif ($_GET['room'] === "Room 102") {
        $room_price = 120; 
      }elseif ($_GET['room'] === "Room 103") {
        $room_price = 120; 
      }elseif ($_GET['room'] === "Room 104") {
        $room_price = 200; 
      }elseif ($_GET['room'] === "Room 105") {
        $room_price = 200; 
      }elseif ($_GET['room'] === "Room 106") {
        $room_price = 200; 
      }elseif ($_GET['room'] === "Room 301") {
        $room_price = 350; 
      }elseif ($_GET['room'] === "Room 302") {
        $room_price = 350; 
      }elseif ($_GET['room'] === "Room 201") {
        $room_price = 400; 
      }elseif ($_GET['room'] === "Room 202") {
        $room_price = 400; 
      }elseif ($_GET['room'] === "Room 203") {
        $room_price = 400; 
      }elseif ($_GET['room'] === "Room 401") {
        $room_price = 650; 
      }elseif ($_GET['room'] === "Room 402") {
        $room_price = 650; 
      }
// Tính số ngày thuê phòng
$date_in = new DateTime($_GET['date_in']);
$date_out = new DateTime($_GET['date_out']);
$num_days = $date_in->diff($date_out)->days;

// Tính tổng tiền thuê phòng
$total_price = $room_price * $num_days;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đặt phòng thành công</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .success-container {
            width: 400px;
            padding: 20px;
            background: #f1f1f1;
            border-radius: 5px;
        }
        .success-container h2 {
            text-align: center;
        }
        .success-container p {
            margin: 10px 0;
        }
        .success-container form {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h2>Đặt phòng thành công!</h2>
        <p>Họ và tên: <?php echo $_GET['name']; ?></p>
        <p>Số liên hệ: <?php echo $_GET['contact']; ?></p>
        <p>Ngày nhận phòng: <?php echo $_GET['date_in']; ?></p>
        <p>Ngày trả phòng: <?php echo $_GET['date_out']; ?></p>
        <p>Số phòng: <?php echo $_GET['room']; ?></p>
        <p>Số tiền: $<?php echo number_format($total_price, 0, '.', ','); ?>.00</p>
        <p>Nếu bạn muốn quay lại trang chủ, <a href='bookadm.php'>click here</a>.</p>"
    </div>
</body>
</html>