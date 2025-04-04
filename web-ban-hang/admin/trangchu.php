<?php
session_start();
ob_start();

// Kiểm tra nếu đã đăng nhập với quyền admin (role = 1)
if (isset($_SESSION['role']) && ($_SESSION['role'] == 1)) {
    include "models/database.php";
    include "models/danhmuc.php";
    include "models/sanpham_user.php";
    $conn = connectdb();

    // Lấy dữ liệu sản phẩm
    $sphome1 = getall_sanpham(0, 0);
    $sphome2 = getall_sanpham(0, 1);


    // Hiển thị trang chủ
    include "views/home.php";

    // Kiểm tra có tham số act hay không
    if (isset($_GET['act'])) {   
        switch ($_GET['act']) { 
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
    }

    // Hiển thị footer
    include "views/footer.php";

} else {
    // Nếu không phải admin, chuyển hướng về trang login
    header('Location: login.php');
    exit();
}
?>
