<?php
// включаем соединение с БД и файлы с объектами
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/product.php";

// создаём экземпляры классов БД и объектов
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->table_name = "oc_product_description";

// запрос данных
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Таблица Oc_product_description";
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
        echo "<th>product_id</th>";
        echo "<th>language_id</th>";
        echo "<th>name</th>";
        echo "<th>description</th>";
        echo "<th>tag</th>";
        echo "<th>meta_title</th>";
        echo "<th>meta_description</th>";
        echo "<th>meta_keyword</th>";         
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
            echo "<td>{$product_id}</td>";
            echo "<td>{$language_id}</td>";
            echo "<td>{$name}</td>";
            echo "<td>{$description}</td>";
            echo "<td>{$tag}</td>";
            echo "<td>{$meta_title}</td>";
            echo "<td>{$meta_description}</td>";
            echo "<td>{$meta_keyword}</td>";
        echo "</tr>";

    }

echo "</table>";
}
// сообщим пользователю, что таблица пустая
else {
    echo "<div class='alert alert-info'>Таблица пустая.</div>";
}

// страница, на которой используется пагинация
$page_url = "toc_product_description.php?";

// подсчёт всех товаров в базе данных, чтобы подсчитать общее количество страниц
$total_rows = $product->countAll();

// пагинация
include_once "paging.php";
?>

<?php // подвал
require_once "layout_footer.php";