<?php
session_start();
ob_start();

    if(!isset($_SESSION['giohang']))$_SESSION['giohang']=[];

    include "models/database.php";
    include "models/danhmuc.php";
    include "models/sanpham_user.php";
    include "models/donhang.php";
    $conn = connectdb();

    // Lấy dữ liệu sản phẩm
    $sphome1 = getall_sanpham(0, 0);
    $sphome2 = getall_sanpham(0, 1);

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
                $dsdm = getall_danhmuc(); // Lấy danh sách danh mục
            
                // Kiểm tra nếu có ID danh mục từ URL
                $iddm = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            
                // Lấy danh sách sản phẩm theo danh mục (0 nếu không có ID danh mục)
                $dssp_dm = getall_sanpham($iddm, 0);
            
                // Lấy toàn bộ danh sách sản phẩm (có thể sắp xếp theo lượt xem hoặc ID)
                $kq = getall_sanpham(0, 0);
            
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
                
                        $iddh = insert_donhang($hoten, $sdt, $email, $diachi, $ghichu, $madh, $tongtien, $pttt, $iduser);
                        $_SESSION['iddh'] = $iddh;
                
                        if ($iddh > 0 && isset($_SESSION['giohang'])) {
                            foreach ($_SESSION['giohang'] as $item) {
                                $success = addtocart($iddh, $item[0], $item[1], $item[2], $item[3], $item[4], $item[5]);
                                if (!$success) {
                                    echo "Lỗi khi thêm sản phẩm: " . $item[1] . "<br>";
                                }
                            }
                            // ✅ Unset sau khi thêm hết
                            unset($_SESSION['giohang']);
                        }
                
                        header("Location: trangchu.php?act=donhang&id=$iddh");
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
                        header("Location: trangchu.php?act=dangnhap");
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
                    
                    include "views/dathang.php";
                    break;
                case 'account':
                    if (isset($_SESSION['user_id'])) {
                        $iduser = $_SESSION['user_id'];
                        // Lấy danh sách đơn hàng của người dùng
                        $orders = dh_ganday($iduser); // Đảm bảo rằng tên biến (orders) trùng với biến bạn sử dụng trong view
                    } else {
                        // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
                        header("Location: trangchu.php?act=dangnhap");
                        exit();
                    }
                
                    include "views/account.php";
                    break;
                case 'thongtincanhan':
                    include "views/thongtincanhan.php";
                    break;


                
                
                
                
                
            // case 'sanpham_user':
            //     $dsdm = getall_danhmuc();

            //     if(isset($_GET['id'])&&($_GET['id']>0)){
            //         $iddm=$_GET['id'];
            //         $dssp_dm=getall_sanpham($iddm, 0);
            //     }else{
            //         $dssp_dm = getall_sanpham(0, 0);
            //     }

            //     // load danh sách sản phẩm
            //     $kq = getall_sanpham();
            //     include "views/sanpham_user.php";
            //     break;

            case 'dangxuat':
                if (isset($_SESSION['role'])) {
                    unset($_SESSION['role']);
                }
                header('Location: login.php');
                exit(); // Đảm bảo script dừng lại ngay sau khi chuyển hướng
                break;

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
    // include "views/footer.php";

//     // Kiểm tra nếu đã đăng nhập với quyền admin (role = 1)
//     if (isset($_SESSION['role']) && ($_SESSION['role'] == 1)) {} else {
//     // Nếu không phải admin, chuyển hướng về trang login
//     header('Location: login.php');
//     exit();
// }
?>
