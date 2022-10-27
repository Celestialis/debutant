<?php
// включаем соединение с БД и файлы с объектами
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/product.php";

// создаём экземпляры классов БД и объектов
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->table_name = "oc_product_option_value";

// запрос данных
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Таблица Oc_product_option_value";
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
        echo "<th>product_option_value_id</th>";
        echo "<th>product_option_id</th>";
        echo "<th>product_id</th>";
        echo "<th>option_id</th>";
        echo "<th>option_value_id</th>";
        echo "<th>quantity</th>";
        echo "<th>subtract</th>";
        echo "<th>price</th>";
        echo "<th>price_prefix</th>";
        echo "<th>points</th>";
        echo "<th>points_prefix</th>";
        echo "<th>weight</th>";
        echo "<th>weight_prefix</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
            echo "<td>{$product_option_value_id}</td>";
            echo "<td>{$product_option_id}</td>";
            echo "<td>{$product_id}</td>";
            echo "<td>{$option_id}</td>";
            echo "<td>{$option_value_id}</td>";
            echo "<td>{$quantity}</td>";
            echo "<td>{$subtract}</td>";
            echo "<td>{$price}</td>";
            echo "<td>{$price_prefix}</td>";
            echo "<td>{$points}</td>";
            echo "<td>{$points_prefix}</td>";
            echo "<td>{$weight}</td>";
            echo "<td>{$weight_prefix}</td>";
        echo "</tr>";

    }

echo "</table>";
}
// сообщим пользователю, что таблица пустая
else {
    echo "<div class='alert alert-info'>Таблица пустая.</div>";
}

// страница, на которой используется пагинация
$page_url = "toc_product_option_value.php?";

// подсчёт всех товаров в базе данных, чтобы подсчитать общее количество страниц
$total_rows = $product->countAll();

// пагинация
include_once "paging.php";
?>

<?php // подвал
require_once "layout_footer.php";