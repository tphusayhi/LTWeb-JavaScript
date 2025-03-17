<?php
     include "views/header/header.php";
     
     
    if(isset($_GET['act'])){   
        switch($_GET['act']){   
           case 'danhmuc' :
               include "views/danhmuc/danhmuc.php";
               break;
           default:
           
           

       }
    }else{
       include "";
    }

    
    


    





    include "views/footer/footer.php";
     

?>