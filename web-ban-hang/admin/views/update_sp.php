<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            background-color: #f4f4f4;
            width: 100%;
        }
        .main {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
            transition: transform 0.3s ease-in-out;
        }
        .main:hover {
            transform: scale(1.02);
        }
        h2 {
            text-align: center;
            color: #007bff;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: center;
        }
        select, input[type="text"], input[type="file"], input[type="number"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="submit"] {
            padding: 8px 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        input[type="submit"]:hover {
            background: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s;
        }
        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.5s ease-in-out forwards;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let mainElement = document.querySelector(".main");
            if (mainElement) {
                mainElement.classList.add("fade-in");
            }
        });
    </script>
</head>
<body>
    <div class="main">
        <h2>Cập nhật sản phẩm</h2>
        <form action="indexs.php?act=update_sp" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= isset($spct['id']) ? htmlspecialchars($spct['id']) : '' ?>">
            
            <select name="iddm" required>
                <option value="0">Chọn danh mục</option>
                <?php
                    $iddmcur = isset($spct['iddm']) ? $spct['iddm'] : 0;
                    if (!empty($dsdm)) {
                        foreach ($dsdm as $dm) {
                            $selected = ($dm['id'] == $iddmcur) ? "selected" : "";
                            echo "<option value='" . htmlspecialchars($dm['id']) . "' $selected>" . htmlspecialchars($dm['tendm']) . "</option>";
                        }
                    } else {
                        echo "<option value='0'>Không có danh mục</option>";
                    }
                ?>
            </select>

            <input type="text" name="tensp" placeholder="Nhập tên sản phẩm" value="<?= isset($spct['tensp']) ? htmlspecialchars($spct['tensp']) : '' ?>" required>

            <?php if (!empty($spct['img']) && file_exists("assets/img/" . $spct['img'])): ?>
                <img src="assets/img/<?= htmlspecialchars($spct['img']) ?>" width="100px">
                <p>Ảnh hiện tại: <?= htmlspecialchars($spct['img']) ?></p>
            <?php endif; ?>

            <input type="file" name="img">
            <input type="number" name="gia" placeholder="Nhập giá sản phẩm" value="<?= isset($spct['gia']) ? htmlspecialchars($spct['gia']) : '' ?>" required min="0">
            <input type="number" name="view" placeholder="Nhập lượt" value="<?= isset($spct['view']) ? htmlspecialchars($spct['view']) : '' ?>" required min="0">
            <input type="text" name="detail" placeholder="Nhập thông tin sản phẩm" value="<?= isset($spct['detail']) ? htmlspecialchars($spct['detail']) : '' ?>" required>


            <input type="submit" name="capnhat" value="Cập nhật">
        </form>
    </div>
</body>
</html>