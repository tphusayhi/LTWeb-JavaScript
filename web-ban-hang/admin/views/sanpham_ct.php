<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css"><link rel="stylesheet" href="assets/css/product.css">
        <script type="text/javascript" src="assets/js/script.js" defer></script>
        <title>Jolliboi - Bán giày chính hãng</title>
    </head>
    <style>
        .size {
    display: flex;
    flex-wrap: wrap; /* Dùng để dòng tiếp theo sẽ bắt đầu từ đầu */
    gap: 10px; /* Khoảng cách giữa các ô */
}

.size-box {
    padding: 10px 20px;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
}

.size-box:hover {
    background-color: #ddd;
}

.quantity {
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 20px 0;
}

.quantity-control {
    display: flex;
    align-items: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden;
}

.quantity-control input[type="number"] {
    width: 60px;
    text-align: center;
    border: none;
    font-size: 16px;
    padding: 6px;
    outline: none;
}

.quantity-control button {
    background-color: #eee;
    border: none;
    padding: 6px 12px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.2s;
}

quantity-control button:hover {
    background-color: #ccc;
}
.add-to-cart button {
    font-size: 18px;
    padding: 10px 20px;
}
.add-to-cart {
    margin-bottom: 20px;
}
.add-to-cart button:hover {
    background-color: black;
    color: white;
    cursor: pointer;
}
/* Chrome, Safari, Edge */
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}




        </style>
    <body>
        
<!---------------------product------------------------------------->
<section class="product">
<form action="trangchu.php?act=addcart" method="post">
        <input type="hidden" name="id" value="<?= isset($spct['id']) ? htmlspecialchars($spct['id']) : '' ?>">
        <input type="hidden" name="tensp" value="<?= isset($spct['tensp']) ? htmlspecialchars($spct['tensp']) : '' ?>">
        <input type="hidden" name="img" value="<?= isset($spct['img']) ? htmlspecialchars($spct['img']) : '' ?>">
        <input type="hidden" name="gia" value="<?= isset($spct['gia']) ? htmlspecialchars($spct['gia']) : '' ?>">
        <input type="hidden" name="sizes" value="<?= isset($spct['sizes']) ? htmlspecialchars($spct['sizes']) : '' ?>">
    <div class="container">
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
        
=======
>>>>>>> 909dbb958761e1585d4ddf95138f1cab0e7dee5f
>>>>>>> Stashed changes
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
                    <h1 ><?= isset($spct['tensp']) ? htmlspecialchars($spct['tensp']) : '' ?></h1>
                    
                </div>
                <div class="product-content-right-product-price">
                    <p><?= isset($spct['gia']) ? htmlspecialchars($spct['gia']) : '' ?> $</p>
                </div>
                
                <div class="product-content-right-product-size">
                <div class="product-content-right-product-size">
                    <p style="font-weight:bold;">Size: </p>
                        <div class="size">
                            <?php
                                $sizes = json_decode($spct['sizes'], true);
                                if (is_array($sizes) && count($sizes) > 0) {
                                    foreach ($sizes as $size) {
                                        echo '<label class="size-box">';
                                        echo '<input type="radio" name="size" value="' . htmlspecialchars($size) . '" required> ' . htmlspecialchars($size);
                                        echo '</label>';
                                    }
                                } else {
                                    echo "<p>Không có size</p>";
                                }
                            ?>
                        </div>
                    </div>
                    <br><div class="quantity">
                        <p style="font-weight:bold;">Số lượng: </p>
                        <div class="quantity-control">
                            <button type="button" class="decrease">-</button>
                            <input type="number" name="soluong" min="1" value="1" required>
                            <button type="button" class="increase">+</button>
                        </div>
                    </div>
<<<<<<< Updated upstream
=======
<<<<<<< HEAD

                   <input type="submit" value="Mua hàng" name="addtocart">
=======
>>>>>>> Stashed changes
               
            <div class="add-to-cart">
                <button type="submit" name="addtocart">
                    <i class="fas fa-shopping-cart"></i> Mua hàng
                </button>
            </div>
            
<<<<<<< Updated upstream
=======
>>>>>>> 909dbb958761e1585d4ddf95138f1cab0e7dee5f
>>>>>>> Stashed changes
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
</form>
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    const decreaseBtn = document.querySelector(".decrease");
    const increaseBtn = document.querySelector(".increase");
    const quantityInput = document.querySelector("input[name='soluong']");

    decreaseBtn.addEventListener("click", function () {
        let current = parseInt(quantityInput.value);
        if (current > 1) {
            quantityInput.value = current - 1;
        }
    });

    increaseBtn.addEventListener("click", function () {
        let current = parseInt(quantityInput.value);
        quantityInput.value = current + 1;
    });
});
</script>

</html>
