<?php
// включаем соединение с БД и файлы с объектами
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/product.php";

// создаём экземпляры классов БД и объектов
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->table_name = "oc_product";

// запрос данных
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Таблица Oc_product";
require_once "layout_header.php";
?>

<div class="right-button-margin">
<a href="index.php" class="btn btn-default pull-right">К выбору таблиц</a>
</div>

<?php
// отображаем данные таблицы, если они есть
if ($num > 0) {
echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
        echo "<th>id</th>";
        echo "<th>model</th>";
        echo "<th>sku</th>";
        echo "<th>upc</th>";
        echo "<th>ean</th>";
        echo "<th>jan</th>";
        echo "<th>isbn</th>";
        echo "<th>mpn</th>";
        echo "<th>location</th>";
        echo "<th>quantity</th>";
        echo "<th>stock_status_id</th>";
        echo "<th>image</th>";
        echo "<th>manufacturer_id</th>";
        echo "<th>shipping</th>";
        echo "<th>price</th>";
        echo "<th>points</th>"; 
        echo "<th>tax_class_id</th>"; 
        echo "<th>date_available</th>"; 
        echo "<th>weight</th>";
        echo "<th>weight_class_id</th>";
        echo "<th>length</th>";
        echo "<th>width</th>";
        echo "<th>height</th>";
        echo "<th>length_class_id</th>";
        echo "<th>subtract</th>";
        echo "<th>minimum</th>";
        echo "<th>sort_order</th>";
        echo "<th>status</th>";
        echo "<th>viewed</th>";
        echo "<th>date_added</th>";  
        echo "<th>date_modified</th>";       
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
            echo "<td>{$product_id}</td>";
            echo "<td>{$model}</td>";
            echo "<td>{$sku}</td>";
            echo "<td>{$upc}</td>";
            echo "<th>{$ean}</th>";
            echo "<th>{$jan}</th>";
            echo "<th>{$isbn}</th>";
            echo "<th>{$mpn}</th>";
            echo "<th>{$location}</th>";
            echo "<th>{$quantity}</th>";
            echo "<th>{$stock_status_id}</th>";
            echo "<th>{$image}</th>";
            echo "<th>{$manufacturer_id}</th>";
            echo "<th>{$shipping}</th>";
            echo "<th>{$price}</th>";
            echo "<th>{$points}</th>";
            echo "<th>{$tax_class_id}</th>";
            echo "<th>{$date_available}</th>";
            echo "<th>{$weight}</th>";
            echo "<th>{$weight_class_id}</th>";
            echo "<th>{$length}</th>";
            echo "<th>{$width}</th>";
            echo "<th>{$height}</th>";
            echo "<th>{$length_class_id}</th>";
            echo "<th>{$subtract}</th>";
            echo "<th>{$minimum}</th>";
            echo "<th>{$sort_order}</th>";
            echo "<th>{$status}</th>";
            echo "<th>{$viewed}</th>";
            echo "<th>{$date_added}</th>";
            echo "<th>{$date_modified}</th>";
        echo "</tr>";

    }

echo "</table>";
}
// сообщим пользователю, что таблица пустая
else {
    echo "<div class='alert alert-info'>Таблица пустая.</div>";
}

// страница, на которой используется пагинация
$page_url = "toc_product.php?";

// подсчёт всех товаров в базе данных, чтобы подсчитать общее количество страниц
$total_rows = $product->countAll();

// пагинация
include_once "paging.php";
?>

<?php // подвал
require_once "layout_footer.php";