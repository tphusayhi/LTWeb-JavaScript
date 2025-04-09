<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <script type="text/javascript" src="js/script.js" defer></script>
        <title>Jolliboi - Bán giày chính hãng</title>
    </head>
    <body>
        <!--------------------------------------------Delivery----------------------------------->
        <section class="delivery">
            <div class="container" style="height: 100px;">
                <div class="delivery-top-wrap"></div>
                <div class="delivery-top">
                    <div class="delivery-top-delivery delivery-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="delivery-top-adress delivery-top-item">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="delivery-top-payment delivery-top-item">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
            <div class="container">
                <?php  
                    session_start();
                    if (isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0) {
                        $tongsoluong = 0;
                        $tongtien = 0;
                        echo print_r($_SESSION['user']);
                ?>
                <form method="post" action="trangchu.php?act=thanhtoan">
                    <input type="hidden" name="ngaydat" id="ngaydat">

                    <div class="delivery-content row">
                        <div class="delivery-content-left">
                            <p>Vui lòng chọn địa chỉ giao hàng</p>
                            <div class="delivery-content-left-input-top row">
                                <div class="delivery-content-left-input-top-item">
                                    <label for="">Họ tên<span style="color:red;">*</span></label>
                                    <input type="text" name="hoten" required>
                                </div>
                                <div class="delivery-content-left-input-top-item">
                                    <label for="">Điện thoại<span style="color:red;">*</span></label>
                                    <input type="text" name="sdt" required>
                                </div>
                                <div class="delivery-content-left-input-top-item">
                                    <label for="">Email</label>
                                    <input type="text" name="email">
                                </div>
                                <div class="delivery-content-left-input-top-item">
                                    <label for="">Ghi chú<span style="color:red;">*</span></label>
                                    <input type="text" name="ghichu" required>
                                </div>
                            </div>
                            <div class="delivery-content-left-input-bottom">
                                <label for="">Địa chỉ<span style="color:red;">*</span></label>
                                <input type="text" name="diachi" required>
                            </div>

                            <div class="payment-content row">
                                <div class="payment-content-left">
                                    <div class="payment-content-left-method-delivery">
                                        <p style="font-weight:bold;">Phương thức giao hàng</p>
                                        <div class="payment-content-left-method-delivery-item">
                                            <input checked type="radio" name="giaohang" value="chuyennhanh">
                                            <label for="">Giao hàng chuyển phát nhanh</label>
                                        </div>
                                    </div>

                                    <div class="payment-content-left-method-payment">
                                        <p style="font-weight:bold;">Phương thức thanh toán</p>
                                        <p>Mọi thông tin sẽ được bảo mật.</p>
                                        <div class="payment-content-left-method-payment-item">
                                            <input name="pttt" type="radio" value="2" required>
                                            <label for="">Thanh toán bằng thẻ tín dụng (OnePay)</label>
                                        </div>
                                        <div class="payment-content-left-method-payment-item-img">
                                            <img src="giaodien/images/visa.jpg" alt="thanh toán" height="30px" width="70px">
                                        </div>
                                        <div class="payment-content-left-method-payment-item">
                                            <input name="pttt" type="radio" value="3" required>
                                            <label for="">Thanh toán bằng thẻ ATM (OnePay)</label>
                                        </div>
                                        <div class="payment-content-left-method-payment-item-img">
                                            <img src="giaodien/images/vcb.jpg" alt="thanh toán" height="100px" width="250px">
                                        </div>
                                        <div class="payment-content-left-method-payment-item">
                                            <input name="pttt" type="radio" value="4" required>
                                            <label for="">Thanh toán bằng Momo</label>
                                        </div>
                                        <div class="payment-content-left-method-payment-item-img">
                                            <img src="giaodien/images/logo-momo.png" alt="thanh toán" height="40px" width="40px">
                                        </div>
                                        <div class="payment-content-left-method-payment-item">
                                            <input name="pttt" type="radio" value="1" required>
                                            <label for="">Thanh toán khi nhận hàng</label>
                                        </div>
                                        <div class="payment-content-left-method-payment-item-img">
                                            <img src="giaodien/images/unnamed.png" alt="thanh toán" height="50px" width="50px">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="delivery-content-left-button row">
                                <a href="trangchu.php?act=viewcart"><span>&#171;</span><p style="color:orange;font-size:13px;">Quay lại giỏ hàng</p></a>
                                <button><input type="submit" name="thanhtoan" style="font-weight: bold;">THANH TOÁN VÀ GIAO HÀNG</button>
                            </div>
                        </div>

                        <div class="delivery-content-right">
                            <table>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                <?php 
                                    foreach ($_SESSION['giohang'] as $item) {
                                        $thanhtien = $item[3] * $item[4];
                                        $tongtien += $thanhtien;
                                        $tongsoluong += $item[4];
                                        echo '
                                        <tr>
                                            <td>'.$item[1].'</td>
                                            <td>'.number_format($item[3]).'<sup>đ</sup></td>
                                            <td>'.$item[4].'</td>
                                            <td>'.number_format($thanhtien).'<sup>đ</sup></td>
                                        </tr>';
                                    }
                                ?>
                                <tr>
                                    <td style="font-weight:bold" colspan="3">Tổng</td>
                                    <td style="font-weight:bold"><?php echo number_format($tongtien); ?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold" colspan="3">Thuế VAT</td>
                                    <td style="font-weight:bold"><?php echo number_format($tongtien * 0.1); ?><sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:bold" colspan="3">Tổng tiền hàng</td>
                                    <td style="font-weight:bold"><?php echo number_format($tongtien * 1.1); ?><sup>đ</sup></td>
                                    <input type="hidden" name="tongtien" value="<?php echo $tongtien * 1.1; ?>">
                                </tr>
                            </table>
                        </div>  
                    </div>
                    

                </form> 
                <?php
                    } else {
                        echo "<p>Giỏ hàng của bạn đang trống.</p>";
                    }
                ?>
            </div>
        </section>
    </body>
    <script>
        // Lấy ngày hiện tại
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Tháng từ 0-11
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

        // Gán vào input hidden
       
