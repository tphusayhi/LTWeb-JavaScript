<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
ob_start();

if (isset($_SESSION['role']) && ($_SESSION['role'] == 2)) {
    include "models/database.php";
    include "models/danhmuc.php";
    include "models/sanpham.php";
    include "models/ma_giam_gia.php";
    include "models/donhang.php";
    include "models/user.php";
    include "models/thongke.php";
    $conn = connectdb();

    include "views/admin_home.php";
    if (isset($_GET['act'])) {
        switch ($_GET['act']) {
            case 'danhmuc':
                // Nhận yêu cầu xử lý và lấy danh sách danh mục
                $kq = getall_danhmuc();
                include "views/danhmuc.php";
                break;

            case 'delete_dm':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    delete_dm($id);
                }
                $kq = getall_danhmuc();
                include "views/danhmuc.php";
                break;

            case 'update_dm':
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                    $id = (int)$_GET['id']; // Ép kiểu tránh lỗi SQL Injection
                    $kqone = getonedm($id);
                    $kq = getall_danhmuc(); // Lấy thông tin danh mục cần sửa
                    include "views/update_dm.php";
                    exit();
                }

                // Xử lý cập nhật khi có dữ liệu gửi lên bằng POST
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['tendm'])) {
                    $id = (int)$_POST['id'];
                    $tendm = trim($_POST['tendm']); // Xóa khoảng trắng đầu cuối

                    if (!empty($tendm)) {
                        update_dm($id, $tendm);
                        header("Location: indexs.php?act=danhmuc"); // Chuyển hướng về danh sách
                        exit();
                    } else {
                        echo "Tên danh mục không thể để trống.";
                    }
                }
                break;

            case 'themdm':
                if (isset($_POST['them']) && !empty($_POST['tendm'])) {
                    $tendm = trim($_POST['tendm']);
                    if (!empty($tendm)) {
                        $message = themdm($tendm); // Gọi hàm themdm() để thêm danh mục
                        echo "<script>alert('$message');</script>"; // Hiển thị thông báo
                    } else {
                        echo "<script>alert('Vui lòng nhập tên danh mục!');</script>";
                    }
                }

                // Lấy danh sách danh mục sau khi thêm mới
                $kq = getall_danhmuc();
                include "views/danhmuc.php";
                break;

            // Sản phẩm  
            case 'sanpham' :
                // load danh sách danh mục 
                $dsdm=getall_danhmuc();

                
                //load danh sách sản phẩm
                $kq=getall_sanpham();
                include "views/sanpham.php";
                break; 
                case 'themsp':
                    // Load danh sách danh mục
                    $dsdm = getall_danhmuc();
                
                    if (isset($_POST['them'])) {
                    $iddm = $_POST['iddm'];
                    $tensp = $_POST['tensp'];
                    $gia = $_POST['gia'];
                    $view = $_POST['view'];
                    $detail = $_POST['detail'];
                    $img = "";  
                    $sizes = isset($_POST['sizes']) ? json_encode($_POST['sizes']) : json_encode([]);

                
                    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
                        $target_dir = "assets/img/";
                        if (!is_dir($target_dir)) {
                            mkdir($target_dir, 0777, true);
                        }
                    
                        $imageFileType = strtolower(pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
                        $allowed_types = ["jpg", "jpeg", "png", "gif"];
                    
                        if (in_array($imageFileType, $allowed_types)) {
                            $newFileName = uniqid() . "." . $imageFileType;  // Tránh trùng tên file
                            $target_file = $target_dir . $newFileName;
                    
                            if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                                $img = $newFileName; // Chỉ lưu tên file vào CSDL
                            } else {
                                echo "<script>alert('Lỗi: Không thể di chuyển file! Kiểm tra quyền thư mục.');</script>";
                                $img = "";
                            }
                        } else {
                            echo "<script>alert('Lỗi: Chỉ chấp nhận định dạng JPG, JPEG, PNG, GIF!');</script>";
                            $img = "";
                        }
                    } else {
                        echo "<script>alert('Lỗi: Không có file hoặc lỗi khi tải lên!');</script>";
                    }
                
                    // ✅ Gọi hàm thêm sản phẩm vào CSDL
                    if ($tensp != "" && $gia != "" && $iddm != "") {
                        insert_sanpham($iddm, $tensp, $img, $gia, $view, $detail, $sizes);  
                        echo "<script>alert('Thêm sản phẩm thành công!');</script>";
                        header("Location: indexs.php?act=sanpham");
                        exit();
                    } else {
                        echo "<script>alert('Lỗi: Vui lòng nhập đầy đủ thông tin sản phẩm!');</script>";
                    }echo "<script>alert('Thêm mới sản phẩm thành công!');</script>";
                }
                
                    $kq = getall_sanpham();
                    include "views/sanpham.php";
                    break;
            case 'delete_sp':
                $dsdm=getall_danhmuc();
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    delete_sp($id);
                }
                //load danh sách sản phẩm
                $kq=getall_sanpham();
                include "views/sanpham.php";;
                break;
                case 'chon_sp':
                    $dsdm = getall_danhmuc();
                    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                        $spct = getone_sp($_GET['id']);
                    }
                    $kq = getall_sanpham();
                    include "views/update_sp.php";
                    break;
                
                    case 'update_sp': 
                        // Load danh sách danh mục 
                        $dsdm = getall_danhmuc();
                    
                        if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                            $iddm = $_POST['iddm'];
                            $tensp = $_POST['tensp'];
                            $gia = $_POST['gia'];
                            $view = $_POST['view'];
                            $detail = $_POST['detail'];
                            $id = $_POST['id'];
                            $sizes = isset($_POST['sizes']) ? json_encode($_POST['sizes']) : json_encode([]);
                    
                            if ($_FILES["img"]["name"] != "") {
                                $target_dir = "assets/img/";
                                if (!is_dir($target_dir)) {
                                    mkdir($target_dir, 0777, true);
                                }
                    
                                $imageFileType = strtolower(pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
                                $allowed_types = ["jpg", "jpeg", "png", "gif"];
                    
                                if (in_array($imageFileType, $allowed_types)) {
                                    $newFileName = uniqid() . "." . $imageFileType;  // Tránh trùng tên file
                                    $target_file = $target_dir . $newFileName;
                    
                                    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
                                        $img = $newFileName; // Chỉ lưu tên file vào CSDL
                                    } else {
                                        echo "<script>alert('Lỗi: Không thể di chuyển file! Kiểm tra quyền thư mục.');</script>";
                                        $img = "";
                                    }
                                } else {
                                    echo "<script>alert('Lỗi: Chỉ chấp nhận định dạng JPG, JPEG, PNG, GIF!');</script>";
                                    $img = "";
                                }
                            } else {
                                $img = ""; // Nếu không có file mới, giữ nguyên ảnh cũ
                            }
                    
                            update_sp($id, $tensp, $img, $gia, $view, $detail, $iddm, $sizes);
                            echo "<script>alert('Cập nhật sản phẩm thành công!');</script>";
                        } else {
                            $spct = null;
                        }
                    
                        // Load danh sách sản phẩm
                        $kq = getall_sanpham();
                        include "views/sanpham.php";
                        break; 

                        case "magiamgia":
                            $ds_ma_giam_gia = getall_magiamgia();
                        include "views/magiamgia.php"; // form HTML bạn đã tạo
                            break;
                        
                        case "them_magiamgia":
                            if (isset($_POST['them'])) {
                                $ma = $_POST['ma'];
                                $phan_tram = $_POST['phan_tram_giam_gia'];
                                $so_luong = $_POST['so_luong'];
                                $han_su_dung = $_POST['han_su_dung'];
                                $trang_thai = $_POST['trang_thai'];
                                them_magiamgia($ma, $phan_tram, $so_luong, $han_su_dung, $trang_thai);
                            }
                            $ds_ma_giam_gia = getall_magiamgia();
                            include "views/magiamgia.php";
                            break;
                        
                        case "xoa_magiamgia":
                            if (isset($_GET['id']) && $_GET['id'] > 0) {
                                xoa_magiamgia($_GET['id']);
                            }
                            $ds_ma_giam_gia = getall_magiamgia();
                            include "views/magiamgia.php";
                            break;
                        
                            case "sua_magiamgia":
                                if (isset($_GET['id']) && $_GET['id'] > 0) {
                                    $id = $_GET['id'];
                                    $magiamgia = lay_1_magiamgia_theo_id($id); // Hàm bạn cần tạo
                                    include "views/update_mg.php";
                                }
                                break;
                            
                            case "update_magiamgia":
                                if (isset($_POST['capnhat'])) {
                                    $id = $_POST['id'];
                                    $ma = $_POST['ma'];
                                    $phan_tram = $_POST['phan_tram_giam_gia'];
                                    $so_luong = $_POST['so_luong'];
                                    $han_su_dung = $_POST['han_su_dung'];
                                    $trang_thai = $_POST['trang_thai'];
                            
                                    $thongbao = update_magiamgia($id, $ma, $phan_tram, $so_luong, $han_su_dung, $trang_thai);
                                }
                            
                                $ds_ma_giam_gia = getall_magiamgia();
                                include "views/magiamgia.php";
                                break;
                            case 'donhang_admin':
                                $alldonhang = getall_donhang();
                                include "views/donhang_admin.php";
                                break;
                            case 'donhang_ct_admin':
                                    // Kiểm tra nếu id đơn hàng hợp lệ
                                    if (isset($_GET['iddh']) && $_GET['iddh'] > 0) {
                                        $iddh = $_GET['iddh']; // Lấy id đơn hàng từ URL
                                        // Lấy chi tiết đơn hàng
                                        $orderDetails = get_donhang_ct($iddh); // Lấy chi tiết sản phẩm trong đơn hàng
                                        // Nếu bạn cần thêm thông tin gì khác, có thể gán thêm biến vào đây
                                        include "views/donhang_ct_admin.php"; // Gọi view để hiển thị chi tiết đơn hàng
                                    } else {
                                        // Nếu không có id hoặc id không hợp lệ, thông báo lỗi
                                        echo "Không có đơn hàng được chọn.";
                                    }
                                break; // Đảm bảo thoát khỏi case 'donhang_ct'
                            case 'capnhat_trangthai':
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    if (isset($_POST['id_donhang'], $_POST['trangthai'])) {
                                        $id_donhang = $_POST['id_donhang'];
                                        $trangthai = $_POST['trangthai'];
                                
                                        // Gọi hàm cập nhật
                                        if (update_trangthai($id_donhang, $trangthai)) {
                                            // Quay lại trang danh sách đơn hàng (có thể thay đổi URL tùy theo hệ thống)
                                            header('Location: indexs.php?act=donhang_admin');
                                            exit;
                                        } else {
                                            echo "❌ Cập nhật trạng thái thất bại!";
                                        }
                                    } else {
                                        echo "Thiếu dữ liệu cần thiết.";
                                    }
                                }
                                break;
                            case 'them_user':
                                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['them'])) {
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    $role = $_POST['role'];
                        
                                    them_user($username, $password, $role);
                                }
                        
                                
                               
                                case 'delete_user':
                                if (isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    delete_user($id);
                                }
                                case 'ds_user':
                                $kq_user = getall_users();
                                include "views/ds_user.php";
                                break;



                            
                        



                    
                    
        
                        
                
                

            case 'dangxuat':
                // Xóa toàn bộ thông tin người dùng
                if (isset($_SESSION['user'])) {
                    unset($_SESSION['user']);
                }

                // Nếu dùng session_unset() + destroy():
                session_unset();
                session_destroy();

                header("Location: login.php");
                exit();
            

            default:
                // Nếu không có hành động nào, bạn có thể cho người dùng về trang mặc định
                break;
        }
    } else {
        include "views/home_admin.php"; // Hoặc trang mặc định khác
    }
} else {
    header('Location: login.php');
}


    
?>