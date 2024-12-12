<!DOCTYPE html>
<html>
<head>
<style>

</style>
</head>
<body>
    <div class="container">
        <h1>Hóa đơn phòng khách sạn</h1>
       
        <p>Nếu bạn muốn quay lại trang chủ, <a href='total.php'>click here</a>.</p>

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
?>

<div style='background-color: #f1f1f1; padding: 20px; border-radius: 5px;'>
    <form method="post" action="">
        <label for="customer">Chọn khách hàng:</label>
        <select name="customer" id="customer">
            <?php
            // Lấy danh sách tên khách hàng từ bảng check_in
            $sql = "SELECT name FROM check_in";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                }
            } else {
                echo "<option value=''>Không có khách hàng</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Xem thông tin">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedCustomer = $_POST["customer"];

        // Truy vấn thông tin từ bảng check_in dựa trên tên khách hàng đã chọn
        $sql = "SELECT * FROM check_in WHERE name = '$selectedCustomer'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
                // Hiển thị thông tin trong form và tính giá tiền phòng
                echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>";
                echo "<div style='background-color: #f1f1f1; padding: 20px; border-radius: 5px;'>";
                echo "<form>";
    
                // Mảng phân loại phòng và giá tiền tương ứng
                $roomCategories = [
                    'Room 101' =>120,
                    'Room 102' =>120,
                    'Room 103' =>120, //Phòng đơn
                    'Room 104'=>200,
                    'Room 105'=>200,
                    'Room 106'=>200, //phòng đôi
                    'Room 201' => 400, 
                    'Room 202' => 400, 
                    'Room 203' => 400, //phòng gia đình
                    'Room 301' => 350, 
                    'Room 302' => 350, //phòng sang trọng
                    'Room 401' => 650, 
                    'Room 402 (S Room)' => 650, //phòng thượng hạng
                ];
            while ($row = $result->fetch_assoc()) {
                echo "Name: " . $row['name'] . "<br>";
                echo "Contact: " . $row['contact'] . "<br>";
                echo "Date In: " . $row['date_in'] . "<br>";
                echo "Date Out: " . $row['date_out'] . "<br>";
                echo "Room: " . $row['room'] . "<br>";

                $dateIn = strtotime($row['date_in']);
                $dateOut = strtotime($row['date_out']);
                $daysStayed = ($dateOut - $dateIn) / (60 * 60 * 24);

                if (array_key_exists($row['room'], $roomCategories)) {
                    $pricePerNight = $roomCategories[$row['room']];
                    $totalPrice = $pricePerNight * $daysStayed;

                    echo "Số ngày đã ở: " . $daysStayed . "<br>";
                    echo "Giá tiền mỗi đêm: " . $pricePerNight . " USD<br>";
                    echo "Tổng giá tiền phòng: " . $totalPrice . " USD<br><br>";
                } else {
                    echo "Không tìm thấy phân loại phòng.<br><br>";
                }
            }
        } else {
            echo "Không có thông tin khách hàng.";
        }
    }
    ?>
</div>
    </div>
</body>
</html>
