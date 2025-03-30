<?php
function connectdb() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_database";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        // Cấu hình chế độ báo lỗi
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; // Trả về đối tượng kết nối để sử dụng
    } catch (PDOException $e) {
        die("Lỗi kết nối CSDL: " . $e->getMessage()); // Dừng chương trình nếu kết nối thất bại
    }
}
?>
