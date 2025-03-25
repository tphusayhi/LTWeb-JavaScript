<?php
      session_start();
      ob_start();
      include "models/database.php";
      include "models/danhmuc.php";
      include "models/sanpham.php";
      $conn = connectdb();
      
     



     include "views/header.php";
     
     if(isset($_GET['act'])){   
      switch($_GET['act']){   
         case 'danhmuc' :
          // nhận yêu cầu xử lý và lấy danh sách danh mục
             
             $kq=getall_danhmuc();
             include "views/danhmuc.php";
             break;
         case 'delete_dm':
               if(isset($_GET['id'])){
                   $id=$_GET['id'];
                   delete_dm($id);
               }
               $kq=getall_danhmuc();
               include "views/danhmuc.php";
                //include "views/updateform_dm.php";
               break;
         case 'update_dm':
            // Hiển thị form cập nhật khi có ID
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                  $id = (int)$_GET['id']; // Ép kiểu tránh lỗi SQL Injection
                  $kqone = getonedm($id);
                  $kq=getall_danhmuc(); // Lấy thông tin danh mục cần sửa
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
          // Sản Phẩm   
         case 'sanpham' :
            // load danh sách danh mục 
            $dsdm=getall_danhmuc();

            
            //load danh sách sản phẩm
            $kq=getall_sanpham();
               include "views/sanpham.php";
               break;  
         default:
         
         

     }
  }else{
     include "";
  }
     
     
     

    
    


    





    
     

?>