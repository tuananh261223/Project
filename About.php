<!DOCTYPE html>
<html>
<head>
    <title>Trang PHP</title>
    <style>
        body {
            background-color: #FF1493; /* Màu hồng */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #FFFFFF; /* Màu nền khung */
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Chào mừng </h1>
        <h2>Đề tài quản lý phòng khách sạn</h2>

        <?php
        echo "Xin chào, đây là trang giới thiệu .<br>";
        echo "Vũ Tuấn Anh.<br>";
        echo "0857014238.<br>";
        echo "Nếu bạn muốn quay lại trang chủ, <a href='index.php'>click here</a>.<br>";
        ?>
    </div>
</body>
</html>