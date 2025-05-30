<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
ob_start();

    if(!isset($_SESSION['giohang']))$_SESSION['giohang']=[];

    include "models/database.php";
    include "models/danhmuc.php";
    include "models/sanpham_user.php";
    include "models/donhang.php";
    include "models/user.php";
    include "models/ma_giam_gia.php";

    $conn = connectdb();

    // Lấy dữ liệu sản phẩm
    $sphome1 = getall_sanpham(0, 0);
    $sphome2 = getall_sanpham(0, 1);
    $user_ava = getall_user_ava();

    include "views/header.php";
   
    
    
    // Hiển thị trang chủ
    // include "views/home.php";
    // Kiểm tra có tham số act hay không
    if (isset($_GET['act'])) {   
        switch ($_GET['act']) { 
            case 'home':
                $dsdm = getall_danhmuc();
                $kq = getall_sanpham();
                include "views/home.php";
                break;

                case 'sanpham_user':
                    // Lấy danh sách tất cả danh mục
                    $dsdm = getall_danhmuc();
                
                    // Lấy id danh mục từ URL nếu có, nếu không thì mặc định 0 (tức là tất cả)
                    $iddm = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                
                    // Lấy tham số sắp xếp từ URL
                    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'asc'; // Mặc định là 'asc'
                
                    // Gọi hàm để lấy sản phẩm với lọc theo danh mục và sắp xếp theo giá
                    $dssp_dm = getall_sanpham($iddm, 0, $sort); // Thực hiện lấy sản phẩm
                
                    include "views/sanpham_user.php";
                    break;
                
                
            case 'sanpham_ct':
                $dsdm = getall_danhmuc();
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $spct = getone_sp($_GET['id']);
                }
                $kq = getall_sanpham();
                include "views/sanpham_ct.php";
                break;
                case 'addcart':
                    if (isset($_POST['addtocart'])) {
                        $id = $_POST['id'];
                        $tensp = $_POST['tensp'];
                        $img = $_POST['img'];
                        $gia = $_POST['gia'];
                        $soluong = isset($_POST['soluong']) ? (int)$_POST['soluong'] : 1;
                        $size = isset($_POST['size']) ? $_POST['size'] : '';
                
                        $fg = 0;
                
                        foreach ($_SESSION['giohang'] as $index => $item) {
                            // Kiểm tra cả id và size để xác định sản phẩm trùng
                            if ($item[0] == $id && $item[5] == $size) {
                                $_SESSION['giohang'][$index][4] += $soluong; // tăng số lượng
                                $fg = 1;
                                break;
                            }
                        }
                
                        if ($fg == 0) {
                            // Thêm mới sản phẩm: 0:id, 1:tensp, 2:img, 3:gia, 4:soluong, 5:size
                            $item = array($id, $tensp, $img, $gia, $soluong, $size);
                            $_SESSION['giohang'][] = $item;
                        }
                
                        header('Location: trangchu.php?act=viewcart');
                        exit();
                    }
                    break;
                
                
            
            case 'deletecart':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    unset($_SESSION['giohang'][$id]);
                    $_SESSION['giohang'] = array_values($_SESSION['giohang']);
                } else {
                    unset($_SESSION['giohang']); // Xóa toàn bộ nếu không truyền ID
                }
                header('Location: trangchu.php?act=viewcart');
                exit();
                break;
                case 'thanhtoan':
                    // ✅ Kiểm tra người dùng đã đăng nhập chưa
                    if (!isset($_SESSION['user_id']) && !isset($_SESSION['user'])) {
                        // Chưa đăng nhập thì chuyển hướng về trang đăng nhập
                        header("Location: trangchu.php?act=dangnhap");
                        exit();
                    }
                    
                    
                    if ((isset($_POST['thanhtoan'])) && ($_POST['thanhtoan'])) {
                        $hoten = $_POST['hoten'];
                        $sdt = $_POST['sdt'];
                        $email = $_POST['email'] ?? '';
                        $diachi = $_POST['diachi'];
                        $ghichu = $_POST['ghichu'] ?? '';
                        $madh = 'DH' . rand(100000, 999999);
                        $tongtien = $_POST['tongtien'];
                        $pttt = $_POST['pttt'];
                        $iduser = $_SESSION['user']['id'] ?? 0;
                        $giamgia= $_POST['giamgia'];
                
                        $iddh = insert_donhang($hoten, $sdt, $email, $diachi, $ghichu, $madh, $tongtien, $pttt, $iduser, $giamgia);
                        $_SESSION['iddh'] = $iddh;
                
                        if ($iddh > 0 && isset($_SESSION['giohang'])) {
                            foreach ($_SESSION['giohang'] as $item) {
                                $success = addtocart($iddh, $item[0], $item[1], $item[2], $item[3], $item[4], $item[5]);
                                if (!$success) {
                                    echo "Lỗi khi thêm sản phẩm: " . $item[1] . "<br>";
                                }
                            }
                            if (isset($_SESSION['ma_giam_gia'])) {
                                $giam_ma = $_SESSION['ma_giam_gia'];
                            
                                // Lấy thông tin mã giảm giá từ CSDL
                                $coupon = lay_1_magiamgia_theo_ma($giam_ma);
                            
                                if ($coupon && $coupon['so_luong'] > 0) {
                            
                                    // ✅ Gọi hàm để trừ số lượng
                                    giam_so_luong_magiamgia($giam_ma);
                            
                                    $message = "Mã giảm giá đã được áp dụng!";
                                } else {
                                    $message = "Mã giảm giá không hợp lệ hoặc đã hết lượt dùng.";
                                }
                            }
                            echo "<script>alert('Đặt hàng thành công!');</script>";                       
                            // ✅ Unset sau khi thêm hết
                            unset($_SESSION['giohang']);
                            unset($_SESSION['giam_phan_tram']);
                        }
                        
                        // echo "<script>alert('Đặt hàng thành công!');</script>";
                        // Chuyển hướng đến trang đơn hàng
                        echo "<script>
                                    alert('Xem đơn hàng đã đặt!');
                                    window.location.href = 'trangchu.php?act=donhang&id=$iddh';
                                </script>";
                                exit();
                        
                        exit;
                    }
                    if (isset($_SESSION['giam_phan_tram'])) {
                        
                    
                        // Ví dụ: Tính tổng mới
                        // $tongtien = 500000; // số tiền gốc (lấy từ giỏ hàng)
                        // $giam = $tongtien * $_SESSION['giam_phan_tram'] / 100;
                        // $tong_sau_giam = $tong_goc - $giam;
                    
                        // echo "<p>Tổng sau giảm: " . number_format($tong_sau_giam, 0, ',', '.') . "đ</p>";
                        header("Location: trangchu.php?act=dathang");
                        exit;
                    }
                    
                    break;
                
                
                    
                case 'donhang':
                    // Kiểm tra nếu người dùng đã đăng nhập
                    if (isset($_SESSION['user_id'])) {
                        $iduser = $_SESSION['user_id'];
                        // Lấy danh sách đơn hàng của người dùng
                        $orders = get_donhang($iduser); // Đảm bảo rằng tên biến (orders) trùng với biến bạn sử dụng trong view
                        include "views/donhang.php"; // Hiển thị trang danh sách đơn hàng
                    } else {
                        // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
                        echo "<script>
                                    alert('Bạn cần đăng nhập để xem đơn hàng!');
                                    window.location.href = 'register.php';
                                </script>";
                                exit();
                    }
                    break;
                
                    case 'donhang_ct':
                        // Kiểm tra nếu id đơn hàng hợp lệ
                        if (isset($_GET['iddh']) && $_GET['iddh'] > 0) {
                            $iddh = $_GET['iddh']; // Lấy id đơn hàng từ URL
                            // Lấy chi tiết đơn hàng
                            $orderDetails = get_donhang_ct($iddh); // Lấy chi tiết sản phẩm trong đơn hàng
                            // Nếu bạn cần thêm thông tin gì khác, có thể gán thêm biến vào đây
                            include "views/donhang_ct.php"; // Gọi view để hiển thị chi tiết đơn hàng
                        } else {
                            // Nếu không có id hoặc id không hợp lệ, thông báo lỗi
                            echo "Không có đơn hàng được chọn.";
                        }
                        break; // Đảm bảo thoát khỏi case 'donhang_ct'
                    
                
                    
                case 'viewcart':
                    include "views/viewcart.php";
                    break;
                case 'dathang':
                    // ✅ Kiểm tra người dùng đã đăng nhập chưa
                    if (!isset($_SESSION['user_id']) && !isset($_SESSION['user'])) {
                        // Chưa đăng nhập thì chuyển hướng về trang đăng nhập
                        echo "<script>
                                    alert('Bạn cần đăng nhập để đặt hàng!');
                                    window.location.href = 'login.php';
                                </script>";
                                exit();
 
                    }

                    include "views/dathang.php";
                    break;
                case 'account':
                    if (!isset($_SESSION['user_id']) && !isset($_SESSION['user'])) {
                        // Chưa đăng nhập thì chuyển hướng về trang đăng nhập
                        echo "<script>
                                    alert('Bạn cần đăng nhập để xem thông tin tài khoản!');
                                    window.location.href = 'login.php';
                                </script>";
                                exit();
                    }
                    if (isset($_SESSION['user_id'])) {
                        $id=$iduser = $_SESSION['user_id'];
                        // Lấy danh sách đơn hàng của người dùng
                        $user = get_thongtin($id);
                        $orders = dh_ganday($iduser); // Đảm bảo rằng tên biến (orders) trùng với biến bạn sử dụng trong view
                    } else {
                        // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
                        header("Location: trangchu.php?act=dangnhap");
                        exit();
                    }
                
                    include "views/account.php";
                    break;
                case 'upload_avatar':
                    if (isset($_SESSION['user_id'])) {
                        $id = $_SESSION['user_id'];
                
                        // Gọi hàm lấy thông tin user từ CSDL
                        $user = get_thongtin($id);
                
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
                            // Gọi hàm upload avatar
                            $message = uploadAvatar($id, $_FILES['avatar']);
                
                            // Lấy lại thông tin đã cập nhật
                            $user = get_thongtin($id);
                            echo "<script>alert('Cập nhật Avatar thành công!');</script>";
                        }
                    } else {
                        echo "<script>alert('Bạn cần đăng nhập để tải ảnh lên!');</script>";
                    }
                    include "views/account.php"; // Gửi dữ liệu user sang view
                    break;
                case 'thongtincanhan':
                    if (isset($_SESSION['user_id'])) {
                        $id = $_SESSION['user_id'];
                
                        // Gọi hàm lấy thông tin user từ CSDL
                        $user = get_thongtin($id);
                    }

                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user']['id'])) {
                        $id = $_SESSION['user']['id'];
                
                        // Lấy dữ liệu từ form
                        $hoten = $_POST['hoten'] ?? '';
                        $email = $_POST['email'] ?? '';
                        $sdt = $_POST['sdt'] ?? '';
                        $ngaysinh = $_POST['ngaysinh'] ?? '';
                        $diachi = $_POST['diachi'] ?? '';
                
                        // Gọi hàm cập nhật thông tin
                        $success = update_user($id, $hoten, $email, $sdt, $ngaysinh, $diachi);
                
                        // Lấy lại thông tin đã cập nhật
                        $user = get_thongtin($id);
                
                        // Thông báo
                        $message = $success ? "✅ Cập nhật thành công!" : "❌ Có lỗi xảy ra khi cập nhật!";
                    }
                
                
                    include "views/thongtincanhan.php"; // Gửi dữ liệu user sang view
                    break;
                    case 'doimatkhau':
                        $message = "";
                    
                        if (isset($_SESSION['user']['id'])) {
                            $id = $_SESSION['user']['id'];
                    
                            // Gọi hàm lấy thông tin user từ DB
                            $user = get_thongtin($id); // ['id' => ..., 'password' => ..., ...]
                    
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                // Lấy dữ liệu từ form
                                $old_password = $_POST['password'] ?? '';
                                $new_password = $_POST['newpassword'] ?? '';
                                $confirm_password = $_POST['confirmpassword'] ?? '';
                    
                                // Lấy mật khẩu đã mã hóa từ DB
                                $hashed_password = $user['password'] ?? ''; // <-- Đảm bảo đúng tên cột trong DB
                    
                                // Kiểm tra mật khẩu cũ
                                if ($hashed_password && password_verify($old_password, $hashed_password)) {
                                    // Kiểm tra mật khẩu mới khớp xác nhận
                                    if ($new_password === $confirm_password) {
                                        // Mã hóa mật khẩu mới
                                        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                    
                                        // Cập nhật mật khẩu trong DB
                                        $success = update_password($id, $hashed_new_password);
                    
                                        // Thông báo kết quả
                                        $message = $success ? "✅ Đổi mật khẩu thành công!" : "❌ Có lỗi xảy ra khi đổi mật khẩu!";
                                    } else {
                                        $message = "❌ Mật khẩu xác nhận không khớp!";
                                    }
                                } else {
                                    $message = "❌ Mật khẩu cũ không đúng!";
                                }
                            }
                        } else {
                            $message = "⚠️ Bạn chưa đăng nhập!";
                        }
                    
                        include "views/thongtincanhan.php";
                        break;
                    case 'magiamgia':
                            if (isset($_GET['ma'])) {
                                xuLyMaGiamGia($_GET['ma']);
                            } else {
                                echo "<script>alert('Không có mã được gửi!'); window.location.href='trangchu.php?act=thanhtoan';</script>";
                            }
                        include "views/dathang.php";

                        break;
                    case 'use_discount':
                        // Lấy danh sách mã giảm giá từ database
                        $ds_ma_giam_gia = lay_danh_sach_magiamgia(); // Hàm này đã được định nghĩa trong models/ma_giam_gia.php
                        include "views/use_discount.php"; // Hiển thị trang mã giảm giá
                        break;
                    case 'use_discount':
                        $ds_ma_giam_gia = lay_danh_sach_magiamgia(); // Gọi hàm lấy danh sách mã giảm giá
                        include "views/use_discount.php"; // Hiển thị trang mã giảm giá
                        break;
                    case 'search':
                        // Lấy danh sách tất cả danh mục để hiển thị trong sidebar
                        $dsdm = getall_danhmuc();
                    
                        // Lấy id danh mục từ URL nếu có, nếu không thì mặc định là 0 (tức là tất cả)
                        $iddm = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                    
                        // Lấy tham số sắp xếp từ URL, mặc định là 'asc'
                        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
                    
                        // Lấy từ khóa tìm kiếm nếu có
                        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
                    
                        // Nếu có từ khóa tìm kiếm, thực hiện tìm kiếm
                        if (!empty($keyword)) {
                            $dssp_dm = searchProducts($keyword); // chỉ tìm theo từ khóa, không cần lọc danh mục ở đây
                        } else {
                            // Nếu không có từ khóa, thực hiện lọc theo danh mục và sắp xếp
                            $dssp_dm = getall_sanpham($iddm, 0, $sort);
                        }
                    
                        // Gọi view hiển thị danh sách sản phẩm
                        include "views/search.php";
                        break;
                        
                    case 'dangxuat':
                        // Xóa toàn bộ thông tin người dùng
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        echo "<script>
                            if (confirm('Bạn chắc chắn muốn đăng xuất chứ?')) {
                                window.location.href = 'trangchu.php?act=thuchiendangxuat';
                            } else {
                                window.history.back();
                            }
                        </script>";
                        exit();

                    case 'thuchiendangxuat':
                        // Thực hiện đăng xuất
                        session_unset();
                        session_destroy();

                        // Xóa cookie quảng cáo ưu đãi
                        setcookie('promo_ad', '', time() - 3600, '/'); // Đặt thời gian hết hạn trong quá khứ

                        header("Location: trangchu.php");
                        exit();

                default:
                    // Có thể hiển thị thông báo nếu hành động không hợp lệ
                    echo "<p>Hành động không hợp lệ.</p>";
                    break;
        }
    }else{
        // Nếu không có tham số act, hiển thị trang chủ mặc định
        $dsdm = getall_danhmuc();
        $kq = getall_sanpham();
        include "views/home.php";

    }


    // Hiển thị footer
    include "views/footer.php";

//     // Kiểm tra nếu đã đăng nhập với quyền admin (role = 1)
//     if (isset($_SESSION['role']) && ($_SESSION['role'] == 1)) {} else {
//     // Nếu không phải admin, chuyển hướng về trang login
//     header('Location: login.php');
//     exit();

?>
