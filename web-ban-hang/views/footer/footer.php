<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Jollibee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .page-footer {
            background-color: #d32f2f;
            color: white;
            padding: 40px 0;
            display: flex;
            
        }
        .footer-logo img {
            max-width: 150px;
        }
        .footer .col {
            margin-bottom: 20px;
        }
        .info_address p {
            margin-bottom: 5px;
            font-size: 14px;
        }
        .list-page {
            list-style: none;
            padding: 0;
        }
        .list-page li {
            margin-bottom: 8px;
        }
        .list-page li a {
            color: white;
            text-decoration: none;
        }
        .list-page li a:hover {
            text-decoration: underline;
        }
        .block-social a {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: white;
            text-decoration: none;
        }
        .block-social img {
            margin-right: 10px;
        }
        .footer-download-app img {
            margin-right: 10px;
        }
        hr {
            border-color: white;
        }
    </style>
</head>
<body>

<footer class="page-footer">
    <div class="container">
        <div class="row">
            <!-- Cột 1: Thông tin công ty -->
            <div class="col-md-5">
                <div class="footer-logo">
                    <img src="https://jollibee.com.vn/media/logo-footer.png" alt="Jollibee Logo">
                </div>
                <div class="info_address">
                    <p><strong>CÔNG TY TNHH JOLLIBEE VIỆT NAM</strong></p>
                    <p>Địa chỉ: Tầng 26, Tòa nhà CII Tower, số 152 Điện Biên Phủ, Phường 25, Quận Bình Thạnh, TP.HCM, Việt Nam</p>
                    <p>Điện thoại: (028) 39309168</p>
                    <p>Tổng đài: <a href="tel:19001533" class="text-white">1900-1533</a></p>
                    <p>Mã số thuế: 0303883266</p>
                    <p>Ngày cấp: 15/07/2008 – Nơi cấp: Cục Thuế Hồ Chí Minh</p>
                    <p>Hộp thư góp ý: <a href="mailto:jbvnfeedback@jollibee.com.vn" class="text-white">jbvnfeedback@jollibee.com.vn</a></p>
                </div>
            </div>

            <!-- Cột 2: Chính sách & Hướng dẫn -->
            <div class="col-md-3">
                <a href="tel:19001533" title="GIAO HÀNG TẬN NƠI MIỄN PHÍ">
                    <img class="img-responsive w-100" src="https://jollibee.com.vn/media/wysiwyg/delivery-lg_1.png" alt="Giao hàng">
                </a>
                <ul class="list-page">
                    <li><a href="/lien-he">Liên hệ</a></li>
                    <li><a href="/chinh-sach-va-quy-dinh-chung">Chính sách và quy định chung</a></li>
                    <li><a href="/chinh-sach-thanh-toan-khi-dat-hang">Chính sách thanh toán</a></li>
                    <li><a href="/chinh-sach-hoat-dong">Chính sách hoạt động</a></li>
                    <li><a href="/chinh-sach-bao-mat">Chính sách bảo mật</a></li>
                    <li><a href="/thong-tin-van-chuyen-va-giao-nhan">Thông tin vận chuyển</a></li>
                    <li><a href="/huong-dan-dat-phan-an">Hướng dẫn đặt phần ăn</a></li>
                </ul>
            </div>

            <!-- Cột 3: Mạng xã hội & Tải ứng dụng -->
            <div class="col-md-4">
                <p class="text-uppercase fw-bold">HÃY KẾT NỐI VỚI CHÚNG TÔI</p>
                <div class="block-social">
                    <a href="https://www.facebook.com/JollibeeVietnam">
                        <img src="https://jollibee.com.vn/media/wysiwyg/icon-fb.png" alt="Facebook" width="34">
                        <span>Facebook</span>
                    </a>
                    <a href="mailto:jbvnfeedback@jollibee.com.vn">
                        <img src="https://jollibee.com.vn/media/wysiwyg/icon-mail.png" alt="Email" width="34">
                        <span>E-Mail</span>
                    </a>
                </div>

                <a href="https://online.gov.vn/Home/WebDetails/92800" target="_blank" rel="noopener">
                    <img src="https://jollibee.com.vn/media/wysiwyg/bocongthuong.png" alt="Bộ Công Thương">
                </a>

                <hr>

                <div class="footer-download-app">
                    <p class="fw-bold text-uppercase" style="font-size: 1.4rem;">Tải ứng dụng đặt hàng với nhiều ưu đãi hơn</p>
                    <a href="https://play.google.com/store/apps/details?id=com.jollibee.loyalty">
                        <img src="https://jollibee.com.vn/media/jollibee/logo_playstore.png" alt="Google Play" width="140" height="42">
                    </a>
                    <a href="https://apps.apple.com/vn/app/jollibee-vietnam/id1554984107">
                        <img src="https://jollibee.com.vn/media/jollibee/logo_appstore.png" alt="App Store" width="140" height="42">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
