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
    <a href="total.php">Total</a>
		<a href="rooms.php">Rooms</a>
		<a href="bookadm.php">Bookroom</a>
    <a href="total_amount.php">Total amount</a>
		<a href="logout.php">Logout</a>
	</section>

	<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Đặt phòng khách sạn</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
     
    }

    .form-container {
      background-color: #f2f2f2;
      padding: 20px;
      border-radius: 5px;
      width: 300px;
      float: left;
      margin-right: 20px;
    }

    .success-container {
      background-color: #f2f2f2;
      padding: 20px;
      border-radius: 5px;
      width: 300px;
    }

    .form-container h2,
    .success-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="date"],
    select,
    input[type="submit"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border-radius: 3px;
      border: none;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Đặt phòng khách sạn</h2>

    <?php
    // Kiểm tra xem form đã được gửi chưa
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Lấy dữ liệu từ form
      $name = $_POST["name"];
      $contact = $_POST["contact"];
      $date_in = $_POST["date_in"];
      $date_out = $_POST["date_out"];
      $room = $_POST["room"];

      // Tính số ngày thuê
      $start_date = new DateTime($date_in);
      $end_date = new DateTime($date_out);
      $interval = $start_date->diff($end_date);
      $num_days = $interval->days;

      // Tính số tiền dựa trên loại phòng và số ngày thuê
      $room_price = 0;
      if ($room === "Room 101") {
        $room_price = 120; 
      } elseif ($room === "Room 102") {
        $room_price = 120; 
      }elseif ($room === "Room 103") {
        $room_price = 120; 
      }elseif ($room === "Room 104") {
        $room_price = 200; 
      }elseif ($room === "Room 105") {
        $room_price = 200; 
      }elseif ($room === "Room 106") {
        $room_price = 200; 
      }elseif ($room === "Room 301") {
        $room_price = 350; 
      }elseif ($room === "Room 302") {
        $room_price = 350; 
      }elseif ($room === "Room 201") {
        $room_price = 400; 
      }elseif ($room === "Room 202") {
        $room_price = 400; 
      }elseif ($room === "Room 203") {
        $room_price = 400; 
      }elseif ($room === "Room 401") {
        $room_price = 650; 
      }elseif ($room === "Room 402") {
        $room_price = 650; 
      }

	 
      $total_price = $room_price * $num_days;
    ?>
    
    <div class="success-container">
      <h2>Đặt phòng thành công!</h2>
      <p>Họ và tên: <?php echo $name; ?></p>
      <p>Số liên hệ: <?php echo $contact; ?></p>
      <p>Ngày nhận phòng: <?php echo $date_in; ?></p>
      <p>Ngày trả phòng: <?php echo $date_out; ?></p>
      <p>Loại phòng: <?php echo $room; ?></p>
      <p>Số tiền: <?php echo $total_price; ?></p>
    </div>
    <?php
    } // Kết thúc xử lý khi form được gửi
    
    ?>

    <form method="POST" action="new.php">
      <label for="name">Họ và tên:</label>
      <input type="text" name="name" required>

      <label for="contact">Số liên hệ:</label>
      <input type="text" name="contact" required>

      <label for="date_in">Ngày nhận phòng:</label>
      <input type="date" name="date_in" required>

      <label for="date_out">Ngày trả phòng:</label>
      <input type="date" name="date_out" required>

   
        <label for="room">Số phòng:</label>
        <select name="room" required>
        <option value="Room 101">Phòng đơn-101</option>
        <option value="Room 101">Phòng đơn-102</option>
        <option value="Room 101">Phòng đơn-103</option>
          <option value="Room 104">Phòng đôi-104</option>
          <option value="Room 105">Phòng đôi-105</option>
          <option value="Room 106">Phòng đôi-106</option>
          <option value="Room 201">Phòng gia đình-201</option>
          <option value="Room 202">Phòng gia đình-202</option>
          <option value="Room 203">Phòng gia đình-203</option>
      <option value="Room 301">Phòng sang trọng-301</option>
      <option value="Room 302">Phòng Sang trọng-302</option>
      <option value="Room 401">Phòng thượng hạng-401</option>
      <option value="Room 402">Phòng thượng hạng-402</option>
      </select>

      <input type="submit" value="Đặt phòng">
    </form>

  </div>
</body>
</html>
</html>
</body>
</html>