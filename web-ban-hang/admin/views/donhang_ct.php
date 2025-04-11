<?php
echo print_r($_SESSION);
 ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 8px;

        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            margin: 5px 0;
            font-size: 15px;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        img {
            max-height: 60px;
            border-radius: 6px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:last-child td {
            font-weight: bold;
            color: #000;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            table th, table td {
                font-size: 12px;
                padding: 8px;
            }

            img {
                max-height: 40px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Kiểm tra và cập nhật iddh từ URL nếu có
    if (isset($_GET['iddh']) && !empty($_GET['iddh'])) {
        $_SESSION['iddh'] = intval($_GET['iddh']);  // Cập nhật session với giá trị iddh từ URL
    }

    // Kiểm tra nếu iddh tồn tại trong session
    if (!empty($_SESSION['iddh'])) {
        $iddh = $_SESSION['iddh'];  // Lấy iddh từ session
        $orderinfo = get_one_donhang($iddh); // Lấy thông tin đơn hàng
        $orderDetails = get_donhang_ct($iddh); // Lấy chi tiết đơn hàng

        if ($orderinfo):
    ?>
        <h2>Chi tiết đơn hàng #<?= htmlspecialchars($orderinfo['madh']) ?></h2>
        <p><strong>Ngày đặt:</strong> <?= date('d/m/Y', strtotime($orderinfo['ngaydat'])) ?></p>
        <p><strong>Họ tên:</strong> <?= htmlspecialchars($orderinfo['hoten']) ?></p>
        <p><strong>Điện thoại:</strong> <?= htmlspecialchars($orderinfo['sdt']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($orderinfo['email']) ?></p>
        <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($orderinfo['diachi']) ?></p>
        <p><strong>Ghi chú:</strong> <?= nl2br(htmlspecialchars($orderinfo['ghichu'])) ?></p>
        <p><strong>Thanh toán:</strong> 
                                        <?php 
                                        switch (htmlspecialchars($orderinfo['pttt'])) {
                                            case 1: 
                                                echo "Thanh toán khi nhận hàng"; 
                                                break;
                                            case 2: 
                                                echo "Thanh toán bằng thẻ tín dụng (OnePay)"; 
                                                break;
                                            case 3: 
                                                echo "Thanh toán bằng thẻ ATM (OnePay)"; 
                                                break;
                                            case 4: 
                                                echo "Thanh toán bằng Momo"; 
                                                break;
                                            default: 
                                                echo "Thanh toán khi nhận hàng"; 
                                                break;
                                        }
                                        ?>
                                    </p>


        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Đơn giá</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $tong = 0;
                foreach ($orderDetails as $item):
                    $thanhtien = $item['dongia'] * $item['soluong'];
                    $tong += $thanhtien;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($item['tensp']) ?></td>
                        <td><img src="assets/img/<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['tensp']) ?>"></td>
                        <td><?= number_format($item['dongia'], 0, ',', '.') ?> đ</td>
                        <td><?= htmlspecialchars($item['sizes']) ?></td>
                        <td><?= $item['soluong'] ?></td>
                        <td><?= number_format($thanhtien, 0, ',', '.') ?> đ</td>
                    </tr>
                <?php endforeach;

                $vat = $tong * 0.1;
                $tongcong = $tong + $vat;
                ?>
                <tr>
                    <td colspan="5" align="right"><strong>Tổng:</strong></td>
                    <td><strong><?= number_format($tong, 0, ',', '.') ?> đ</strong></td>
                </tr>
                <tr>
                    <td colspan="5" align="right"><strong>VAT (10%):</strong></td>
                    <td><strong><?= number_format($vat, 0, ',', '.') ?> đ</strong></td>
                </tr>
                <tr>
                    <td colspan="5" align="right"><strong>Tổng cộng:</strong></td>
                    <td><strong><?= number_format($tongcong, 0, ',', '.') ?> đ</strong></td>
                </tr>
            </tbody>
        </table>
    <?php
        else:
            echo "<p>Không tìm thấy thông tin đơn hàng.</p>";
        endif;
    } else {
        echo "<p>Không tìm thấy đơn hàng.</p>";
    }
    ?>
</div>

</body>
</html>
