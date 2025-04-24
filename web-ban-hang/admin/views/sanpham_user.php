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

.section {
      max-width: 1200px;
      min-height: 500px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      /* border-radius: 10px; */
      /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
    }

    .product-grid {
      display: grid;
    
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      /* height: 550px; */
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
.cartegory-left {
    margin-top: 30px;   
}
.cartegory-right-top-item p {
    margin-top: 20px;
    font-size: 25px;
}
.cartegory-right-top-item select {
    margin-top: 20px;
}
	</style>
    <body>
        <!--category-->
        <section class="cartegory">
        <?php
// Tổng số sản phẩm
$totalProducts = count($dssp_dm);

// Số sản phẩm mỗi trang
$productsPerPage = 6;

// Tính tổng số trang
$totalPages = ceil($totalProducts / $productsPerPage);

// Lấy trang hiện tại từ URL, mặc định là trang 1
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Tính vị trí bắt đầu của sản phẩm trên trang hiện tại
$startIndex = ($currentPage - 1) * $productsPerPage;

// Cắt mảng sản phẩm cho trang hiện tại
$currentProducts = array_slice($dssp_dm, $startIndex, $productsPerPage);
?>

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
                                    <span class="checkmark"></span>
                                    ' . htmlspecialchars($dm['tendm']) . '
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
                            <?php foreach ($currentProducts as $item): ?>
<?php
    $sizes = json_decode($item['sizes'], true);
?>
<div class="card">
    <form action="trangchu.php?act=addcart" method="post">
        <span style="font-size: 25px; position: absolute; top: 12px; left: 20px; cursor: pointer; z-index: 2;"><i class="bx bx-heart"></i></span>
        <span style="font-size: 25px; position: absolute; top: 12px; right: 20px; cursor: pointer; z-index: 2;"><i class="bx bx-cart-alt"></i></span>
        <a href="trangchu.php?act=sanpham_ct&id=<?= $item['id'] ?>">
            <div class="card__img">
                <img src="assets/img/<?= htmlspecialchars($item['img']) ?>" style="width: 252px; height: 168px; object-fit: cover;" />
            </div>
        </a>
        <a href="trangchu.php?act=sanpham_ct&id=<?= $item['id'] ?>">
            <h2 class="card__title"><?= htmlspecialchars($item['tensp']) ?></h2>
        </a>
        <p class="card__price"><?= htmlspecialchars($item['gia']) ?> $</p>
        <div class="card__size">
            <h3>Size:</h3>
            <p>
                <?= is_array($sizes) && count($sizes) > 0 ? implode(' || ', array_map('htmlspecialchars', $sizes)) : 'Không có size' ?>
            </p>
        </div>
        <div class="card__action">
            <input type="submit" value="View" formaction="trangchu.php?act=sanpham_ct&id=<?= $item['id'] ?>">
        </div>
        <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
        <input type="hidden" name="tensp" value="<?= htmlspecialchars($item['tensp']) ?>">
        <input type="hidden" name="img" value="<?= htmlspecialchars($item['img']) ?>">
        <input type="hidden" name="gia" value="<?= htmlspecialchars($item['gia']) ?>">
    </form>
</div>
<?php endforeach; ?>

                            </div>
                        </div>  
                        
                        </p>  
                    </div>

                </div>
                <div style="margin-top: 20px; text-align: center;">
    <?php if ($totalPages > 1): ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?act=sanpham_user&page=<?= $i ?><?= isset($_GET['id']) ? '&id=' . $_GET['id'] : '' ?>" 
               style="display: inline-block; margin: 0 5px; padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px;
                      text-decoration: none; color: <?= $i == $currentPage ? '#fff' : '#007bff' ?>; 
                      background-color: <?= $i == $currentPage ? '#007bff' : '#f9f9f9' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    <?php endif; ?>
</div>
            </div>
            

        </section>

        <script>
    // Đồng bộ trạng thái checkbox và liên kết danh mục
    function syncCheckboxAndLink(checkbox) {
        const parentLabel = checkbox.closest('.custom-checkbox');
        if (parentLabel) {
            const link = parentLabel.querySelector('a');
            if (link) {
                link.style.fontWeight = checkbox.checked ? 'bold' : 'normal';
                link.style.color = checkbox.checked ? '#007bff' : 'inherit';
            }
        }
    }

    // Xử lý khi checkbox thay đổi
    function handleCheckboxChange(event) {
        const checkbox = event.target;

        // Bỏ tích tất cả các checkbox khác
        document.querySelectorAll('.custom-checkbox input').forEach(cb => {
            if (cb !== checkbox) {
                cb.checked = false;
                syncCheckboxAndLink(cb);
            }
        });

        // Đồng bộ trạng thái checkbox hiện tại
        syncCheckboxAndLink(checkbox);

        // Lưu trạng thái checkbox vào localStorage
        const selectedCategory = checkbox.checked ? checkbox.id : null;
        localStorage.setItem('selectedCategory', selectedCategory);

        // Điều hướng đến URL mới với danh mục được chọn
        const currentUrl = window.location.href.split('?')[0]; // Lấy URL hiện tại
        let newUrl = currentUrl + '?act=sanpham_user';

        if (selectedCategory) {
            newUrl += '&id=' + selectedCategory; // Thêm ID của checkbox được chọn
        }

        window.location.href = newUrl;
    }

    // Gắn sự kiện cho tất cả checkbox
    document.querySelectorAll('.custom-checkbox input').forEach(checkbox => {
        checkbox.addEventListener('change', handleCheckboxChange);
    });

    // Gắn sự kiện cho các liên kết danh mục
    document.querySelectorAll('.custom-checkbox a').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
            const checkbox = this.closest('.custom-checkbox').querySelector('input');
            
            // Đổi trạng thái checkbox
            checkbox.checked = true;

            // Gọi hàm xử lý checkbox
            handleCheckboxChange({ target: checkbox });
        });
    });

    // Khôi phục trạng thái checkbox khi tải lại trang
    window.addEventListener('DOMContentLoaded', () => {
        const selectedCategory = localStorage.getItem('selectedCategory');
        if (selectedCategory) {
            const checkbox = document.getElementById(selectedCategory);
            if (checkbox) {
                checkbox.checked = true;
                syncCheckboxAndLink(checkbox);
            }
        }
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
