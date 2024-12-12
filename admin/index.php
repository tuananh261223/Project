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
	<title>Hotel Management System</title>
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
    <title>Available Rooms</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .counter-container {
            width: 400px;
            padding: 20px;
            background: #4CAF50; /* Màu xanh */
            border-radius: 5px;
        }
        .counter-container p {
            text-align: center;
            margin: 0;
            color: white; /* Màu chữ trắng */
        }
    </style>
</head>
<body>
    <div class="counter-container">
        <?php
        if ($dbc) {
            $counter = 0;
            $query = "SELECT * FROM rooms WHERE status='0'";
            $result = mysqli_query($dbc, $query);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $counter++;
                }
                $message = sprintf("Number of available rooms: %d Room", $counter);
                echo "<p class='counter'>" . $message . "</p>";
            } else {
                echo "Error establishing a database connection!";
            }
        }
        ?>
    </div>
</body>
</html>
</body>
</html>
