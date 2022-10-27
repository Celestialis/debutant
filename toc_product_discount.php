<?php
// включаем соединение с БД и файлы с объектами
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/product.php";

// создаём экземпляры классов БД и объектов
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->table_name = "oc_product_discount";

// запрос данных
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Таблица Oc_product_discount";
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
        echo "<th>product_discount_id</th>";
        echo "<th>product_id</th>";
        echo "<th>customer_group_id </th>";
        echo "<th>quantity</th>";
        echo "<th>priority</th>";
        echo "<th>price</th>";
        echo "<th>date_start </th>";
        echo "<th>date_end</th>";         
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
            echo "<td>{$product_discount_id}</td>";
            echo "<td>{$product_id }</td>";
            echo "<td>{$customer_group_id}</td>";
            echo "<td>{$quantity}</td>";
            echo "<td>{$priority}</td>";
            echo "<td>{$price}</td>";
            echo "<td>{$date_start}</td>";
            echo "<td>{$date_end}</td>";
        echo "</tr>";

    }

echo "</table>";
}
// сообщим пользователю, что таблица пустая
else {
    echo "<div class='alert alert-info'>Таблица пустая.</div>";
}

// страница, на которой используется пагинация
$page_url = "toc_product_discount.php?";

// подсчёт всех товаров в базе данных, чтобы подсчитать общее количество страниц
$total_rows = $product->countAll();

// пагинация
include_once "paging.php";
?>

<?php // подвал
require_once "layout_footer.php";