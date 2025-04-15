<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="asstes/css/style.css">
        <script type="text/javascript" src="asstes/js/script.js" defer></script>
        <title>Jolliboi - Bán giày chính hãng</title>
    </head>
    
<body>
<!--------------------------------------------cart----------------------------------->
<section class="cart">
    <?php
    // echo var_dump($_SESSION['giohang']);
    ?>
    <div class="container" style="height: 100px;">
        <div class="cart-top-wrap"></div>
        <div class="cart-top">
            <div class="cart-top-cart cart-top-item">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="cart-top-adress cart-top-item">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="cart-top-payment cart-top-item">
                <i class="fas fa-money-check-alt"></i>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="cart-content row">
            <div class="cart-content-left">
            <?php
                if((isset($_SESSION['giohang']) && count($_SESSION['giohang']) > 0)){
                    echo '
                        <table>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Size</th>
                                <th>Số lượng</th>
                                <th>Giá sản phẩm</th>
                                <th>Thành tiền</th>
                                <th>Xóa</th>
                            </tr>';
                            $tongsoluong=0;
                            $tongtien=0;
                            foreach ($_SESSION['giohang'] as $index => $item) {
                                $thanhtien = $item[3] * $item[4];  // Tính thành tiền cho sản phẩm
                                $tongsoluong += $item[4];  // Cộng dồn số lượng sản phẩm
                                $tongtien += $thanhtien;  // Cộng dồn tổng tiền
                                echo '<tr>    
                                    <td><img src="assets/img/' . htmlspecialchars($item[2]) . '" alt="Sản phẩm"></td>
                                    <td><p>'.$item[1].'</p></td>
                                    <td><p>'.$item[5].'</p></td>
                                    <td><p>' . $item[4] . '</p></td>
                                    <td><p>'.number_format($item[3]).'<sup>đ</sup></p></td>
                                    <td><p>'.number_format($thanhtien).'<sup>đ</sup></p></td>
                                    <td><span><a href="trangchu.php?act=deletecart&id='.$index.'">X</a></span></td>
                                </tr>';
                            }
                        echo '</table>
                        </div>
                    <div class="cart-content-right">
                        <table>
                            <tr>
                                <th colspan="2">TỔNG TIỀN GIỎ HÀNG: </th>
                            </tr> 
                            <tr>
                                <td>TỔNG SẢN PHẨM: </td>
                                <td>'.$tongsoluong.'</td>
                            </tr>  
                            <tr>
                                <td>TỔNG TIỀN HÀNG: </td>
                                <td><p>'.number_format($tongtien).'<sup>đ</sup></p></td>
                            </tr>
                            <tr>
                                <td>TẠM TÍNH: </td>
                                <td><p style="color: black;font-weight: bold;">'.number_format($tongtien).' <sup>đ</sup></p></td>
                            </tr>

                        </table>';
                    }
                ?>


                <div class="cart-content-right-text">
                    <p style="color:red;font-weight:bold;">Bạn được miễn ship với các đơn hàng có giá trị trên 2.000.000 đ</p>
                </div>
                <div class="cart-content-right-button">
                    <button><a href="trangchu.php?act=deletecart">XOÁ GIỎ HÀNG</a></button>
                    <button><a href="trangchu.php?act=sanpham_user">TIẾP TỤC MUA SẮM</a></button>
                    <button><a href="trangchu.php?act=dathang">ĐẶT HÀNG</a></button>
                </div>
                <div class="cart-content-right-dangnhap">
                    <p>TÀI KHOẢN JOLLIBOI</p><br>
                    <p>Hãy <a href="login.php"><u style="color: orange;">đăng nhập</u></a> tài khoản của bạn để sử dụng mã giảm giá.</p>
                </div>
            </div>
        </div>
    </div>
    <style>
        .container{
            margin-top:20px;
        }
    </style>
</section>

</body>
<script>
const header = document.querySelector("header");
window.addEventListener("scroll", function(){
x = window.pageYOffset;
    if (x>0){
        header.classList.add("sticky")
    }
    else{
        header.classList.remove("sticky")
    }
})





const imgPosition = document.querySelectorAll(".aspect-ratio-169 img");
const imgContainer = document.querySelector(".aspect-ratio-169");
const dotItem = document.querySelectorAll(".dot");
let imgNuber= imgPosition.length
let index = 0
//console.log(impgPosition)

imgPosition.forEach(function(image, index){
image.style.left = index * 100 + "%"
dotItem[index].addEventListener("click",function(){
slider(index)

})
})
function imgSlide(){
index++;
console.log(index)
if (index>=imgNuber) (index = 0)
slider (index)
}
function slider (index){
imgContainer.style.left = "-"+index*100 + "%";
const dotActive = document.querySelector(".active")
dotActive.classList.remove("active")
dotItem[index].classList.add("active")
}



setInterval(imgSlide,5000)



</script>
</html>