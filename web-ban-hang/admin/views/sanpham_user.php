<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="assets/css/product.css" />
        <script type="text/javascript" src="assets/js/script.js" defer></script>
        <title>Jolliboi - Bán giày chính hãng</title>
    </head>
	<style>
/* Ẩn checkbox mặc định */
.custom-checkbox input[type="checkbox"] {
    display: none;
}

/* Tạo hộp checkbox tùy chỉnh */
.custom-checkbox {
    display: inline-flex;  /* Thay đổi từ flex thành inline-flex để các phần tử nằm trên cùng một dòng */
    align-items: center;
    cursor: pointer;
    font-size: 16px;
    user-select: none;
}

/* Ô vuông */
.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #333;
    border-radius: 4px;
    display: inline-block;
    position: relative;
    margin-right: 10px;
}

/* Khi checkbox được chọn, tạo dấu tick */
.custom-checkbox input:checked + .checkmark::after {
    content: "";
    position: absolute;
    left: 5px;
    top: 2px;
    width: 6px;
    height: 10px;
    border: solid #fff;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

/* Hiệu ứng khi chọn */
.custom-checkbox input:checked + .checkmark {
    background-color: #007bff;
    border-color: #007bff;
}

/* Thẻ a nằm cùng hàng với checkbox */
.custom-checkbox a {
    display: inline-block; /* Đảm bảo thẻ a cũng nằm trên cùng một dòng */
    text-decoration: none;
    color: inherit;
}



#showAllBtn {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
    transition: 0.3s;
}

#showAllBtn:hover {
    background-color: #0056b3;
}
	</style>
    <body>
        <!--category-->
        <section class="cartegory">
            <div class="contaimer">
                <div class="row">
                    <div class="cartegory-left">
                        <ul>
                            <li class="cartegory-left-li">
                                <a href=""><label class="custom-checkbox">
                                    <input type="checkbox" id="showAllCheckbox">
                                    <span class="checkmark"></span>
                                    Tất cả sản phẩm
                                </label></a>
                            </li>
                            <?php
                            foreach($dsdm as $dm) {
                                echo '<li class="cartegory-left-li"><a href=""><label class="custom-checkbox">
                                    <input type="checkbox" id="' . $dm['id'] . '">
                                    <span class="checkmark"></span><a href="trangchu.php?act=sanpham_user&id=' . $dm['id'] . '">' . htmlspecialchars($dm['tendm']) . '</a>
                                </label></a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="cartegory-right row">
                        <div class="cartegory-right-top-item">
                            <p>HÀNG MỚI VỀ</p>
                        </div>
                        <div class="cartegory-right-top-item">
                            <select name="sort" id="sort" onchange="sortProducts()">
                                <option value="">Sắp xếp</option>
                                <option value="ASC" <?php if ($sort == 'ASC') echo 'selected'; ?>>Giá thấp đến cao</option>
                                <option value="DESC" <?php if ($sort == 'DESC') echo 'selected'; ?>>Giá cao đến thấp</option>
                            </select>
                        </div>

                        <div class="section">
                            <div class="product-grid">
                            <?php
                            foreach($dssp_dm as $item) {
                                $sizes = json_decode($item['sizes'], true);
                                echo '<div class="card">
                                    <form action="trangchu.php?act=addcart" method="post">
                                        <span style="font-size: 25px; position: absolute; top: 12px; left: 20px; cursor: pointer; z-index: 2; "><i class="bx bx-heart"></i></span>
                                        <span style="font-size: 25px; position: absolute; top: 12px; right: 20px; cursor: pointer; z-index: 2; "><i class="bx bx-cart-alt"></i></span>
                                        <a href="trangchu.php?act=sanpham_ct&id=' . $item['id'] . '">
                                        <div class="card__img">
                                            <img src="assets/img/'. htmlspecialchars($item['img']) . '" style="width: 252px; height: 168px; object-fit: cover; object-position: center;" />
                                        </div>
                                        </a>
                                        <a href="trangchu.php?act=sanpham_ct&id=' . $item['id'] . '">
                                        <h2 class="card__title">'. htmlspecialchars($item['tensp']) . '</h2></a>
                                        <p class="card__price">'.htmlspecialchars($item['gia']) . ' $</p>
                                        <div class="card__size">
                                            <h3>Size:</h3>';

                                            if (is_array($sizes) && count($sizes) > 0) {
                                                echo "<p>" . implode('|| ', array_map('htmlspecialchars', $sizes)) . "</p>";
                                            } else {
                                                echo "<p>Không có size</p>";
                                            }

                                            echo '  </div>
                                        <div class="card__action">
                                            <input type="submit" value="View" formaction="trangchu.php?act=sanpham_ct&id=' . $item['id'] . '">
                                        </div>
                                        <input type="hidden" value="'. htmlspecialchars($item['id']) . '" name="id">
                                        <input type="hidden" value="'. htmlspecialchars($item['tensp']) . '" name="tensp">
                                        <input type="hidden" value="'. htmlspecialchars($item['img']) . '" name="img">
                                        <input type="hidden" value="'. htmlspecialchars($item['gia']) . '" name="gia">
                                    </form>
                                </div>';
                            }
                            ?>
                            </div>
                        </div>    
                    </div>

                </div>
            </div>
        </section>

        <script>
        // Checkbox redirection logic
        function redirectToSelectedCategories() {
    const checkboxes = document.querySelectorAll('.custom-checkbox input');
    let selectedCategories = [];

    // Duyệt qua tất cả các checkbox và lấy giá trị ID của checkbox được chọn
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            selectedCategories.push(checkbox.id);  // Thêm ID của checkbox vào mảng
        }
    });

    const currentUrl = window.location.href.split('?')[0]; // Lấy URL hiện tại
    let newUrl = currentUrl + '?act=sanpham_user';

    // Nếu có checkbox được chọn, thêm tham số vào URL
    if (selectedCategories.length > 0) {
        newUrl += '&id=' + selectedCategories.join(','); // Nối các ID với dấu phẩy
    }

    // Điều hướng đến URL mới với các tham số
    window.location.href = newUrl;
}

// Thêm event listener cho tất cả checkbox
document.querySelectorAll('.custom-checkbox input').forEach(checkbox => {
    checkbox.addEventListener('change', redirectToSelectedCategories);
});


        // Sorting function
        function sortProducts() {
            var sortValue = document.getElementById("sort").value;
            var currentUrl = window.location.href.split('?')[0]; // Lấy URL hiện tại
            var newUrl = currentUrl + '?act=sanpham_user&sort=' + sortValue; // Thêm tham số sort vào URL
            window.location.href = newUrl; // Điều hướng đến URL mới
        }
        </script>
    </body>
</html>
