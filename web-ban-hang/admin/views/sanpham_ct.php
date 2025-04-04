<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <script type="text/javascript" src="assets/js/script.js" defer></script>
        <title>Jolliboi - Bán giày chính hãng</title>
    </head>
    <body>
        
<!---------------------product------------------------------------->
<section class="product">
    <div class="container">
        <div class="product-top row">
            <p>Trang chủ</p> <span>&#10509;</span> <p>Nữ</p> <span>&#10509;</span> <p>Hàng nữ mới về</p><span> &#10509;</span><p> Giày thể thao</p>
        </div>
        <div class="product-content row">
            <div class="product-content-left row">
                <div class="product-content-left-big-img">
                <?php if (!empty($spct['img']) && file_exists("assets/img/" . $spct['img'])): ?>
                <img src="assets/img/<?= htmlspecialchars($spct['img']) ?>"  >
            <?php endif; ?>         
                </div>
            </div>
            <div class="product-content-right">
                <div class="product-content-right-product-name">
                    <h1 ><?= isset($spct['tensp']) ? htmlspecialchars($spct['tensp']) : '' ?>"</h1>
                    
                </div>
                <div class="product-content-right-product-price">
                    <p><?= isset($spct['gia']) ? htmlspecialchars($spct['gia']) : '' ?> $</p>
                </div>
                
                <div class="product-content-right-product-size">
                    <p style="font-weight:bold;">Size: </p>
                    <div class="size">
                        <span>XS</span>
                        <span>S</span>
                        <span>M</span>
                        <span>L</span>
                        <span>XL</span>
                    </div>
                </div>
                <div class="quantity">
                    <p style="font-weight:bold;">Số lượng: </p>
                    <input type="number" min="0" value="1">
                </div>
                <div class="product-content-right-product-button">
                    <button><i class="fas fa-shopping-cart"></i><p>Thêm vào giỏ hàng</p></button>
                    <button><p>Tìm tại cửa hàng</p></button>
                </div>
                <div class="product-content-right-product-icon">
                    <div class="product-content-right-product-icon-item">
                        <i class="fas fa-phone-alt"></i><p>Hotline</p>
                    </div>
                    <div class="product-content-right-product-icon-item">
                        <i class="fas fa-comments"></i><p>Chat</p>
                    </div>
                    <div class="product-content-right-product-icon-item">
                        <i class="fas fa-envelope"></i><p>Mail</p>
                    </div>
                </div>
               
                <div class="product-content-right-bottom">
                    <div class="product-content-right-bottom-top">
                        &#8744;
                    </div>
                    <div class="product-content-right-bottom-content-big">
                        <div class="product-content-right-bottom-content-title row">
                            <div class="product-content-right-bottom-content-title-item chitiet">
                                <p>Chi tiết</p>
                                <div class="product-content-right-bottom-content">
                            <div class="product-content-right-bottom-content-chitiet">
                            <?= isset($spct['detail']) ? htmlspecialchars($spct['detail']) : '' ?>
                            </div>
                            </div>
                           
                            
                            
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-------------------------------------------product-related----------------------------->
<section class="product-related container">
    <div class="product-related-title">
        <p>SẢN PHẨM LIÊN QUAN</p>
    </div>
    <div class="row product-content">
        <div class="product-related-item">
            <img src="giaodien/images/sp2.jpg" alt="sản phẩm">
            <h1>Balo thời trang</h1>
            <p>790.000<sup>đ</sup></p>
        </div>
        <div class="product-related-item">
            <img src="giaodien/images/sp3.jpg" alt="sản phẩm">
            <h1>Balo thời trang</h1>
            <p>790.000<sup>đ</sup></p>
        </div>
        <div class="product-related-item">
            <img src="giaodien/images/sp4.jpg" alt="sản phẩm">
            <h1>Balo thời trang</h1>
            <p>790.000<sup>đ</sup></p>
        </div>
        <div class="product-related-item">
            <img src="giaodien/images/sp5.jpg" alt="sản phẩm">
            <h1>Balo thời trang</h1>
            <p>790.000<sup>đ</sup></p>
        </div>
        <div class="product-related-item">
            <img src="giaodien/images/sp6.jpg" alt="sản phẩm">
            <h1>Balo thời trang</h1>
            <p>790.000<sup>đ</sup></p>
        </div>
    </div>
</section>

<!---------------------------- footer ----------------------------->

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