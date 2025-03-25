<?php


     include "views/header/header.php";
     
     
    if(isset($_GET['act'])){   
        switch($_GET['act']){   
           case 'danhmuc' :
            // nhận yêu cầu xử lý và lấy danh sách danh mục
               
               $kq=getall_danhmuc();
               include "views/danhmuc.php";
               break;
           default:
           
           

       }
    }else{
       include "";
    }

    
    


    





    include "views/footer/footer.php";
     

?>