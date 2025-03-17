<?php
include_once "config/database.php";
include_once "models/Product.php";


class ProductController {
    private $product;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->product = new Product($db);
    }

    public function index() {
        $stmt = $this->product->getProducts();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include "views/products/index.php";
    }
}
?>