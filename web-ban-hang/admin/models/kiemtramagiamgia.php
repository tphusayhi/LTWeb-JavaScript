<?php
session_start();
header('Content-Type: application/json');
$conn = connectdb();

// Kết nối database (sửa lại thông tin kết nối cho đúng)


// Nhận dữ liệu từ form
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['ma_giam_gia'])) {
    $ma = trim($_POST['ma_giam_gia']);

    // Truy vấn mã giảm giá
    $sql = "SELECT * FROM magiamgia 
            WHERE ma = ? AND trang_thai = 'active' AND so_luong > 0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ma]);
    $voucher = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($voucher) {
        // Nếu có cột hạn sử dụng, bạn có thể kiểm tra ngày hết hạn ở đây
        // Ví dụ nếu cột han_su_dung là kiểu 'date' hoặc 'datetime'
        // Bỏ qua bước này nếu bạn không dùng ngày
        /*
        $currentDate = date('Y-m-d');
        if (isset($voucher['han_su_dung']) && $voucher['han_su_dung'] < $currentDate) {
            echo json_encode(['success' => false, 'message' => 'Mã giảm giá đã hết hạn.']);
            exit();
        }
        */

        // Tính giảm giá
        $tongtien = isset($_SESSION['tongtien']) ? floatval($_SESSION['tongtien']) : 0;
        $phantram = floatval($voucher['phan_tram_giam_gia']);
        $giamgia = $tongtien * ($phantram / 100);
        $thanhtien = $tongtien - $giamgia;

        // Lưu vào session nếu cần
        $_SESSION['giamgia'] = $giamgia;
        $_SESSION['phantram'] = $phantram;

        // (Tùy chọn) Giảm số lượng mã
        $update = $pdo->prepare("UPDATE magiamgia SET so_luong = so_luong - 1 WHERE id = ?");
        $update->execute([$voucher['id']]);

        // Trả kết quả về dạng JSON
        echo json_encode([
            'success' => true,
            'phantram' => $phantram,
            'giamgia' => $giamgia,
            'thanhtien' => $thanhtien
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Mã giảm giá không hợp lệ hoặc đã hết.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Vui lòng nhập mã giảm giá.']);
}
?>
