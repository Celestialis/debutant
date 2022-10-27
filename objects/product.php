<?php

class Product
{
    // подключение к базе данных и имя таблицы
    private $conn;
    public $table_name = "oc_product";

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    // метод для получения данных таблиц
    function readAll($from_record_num, $records_per_page)
    {
        // запрос MySQL
        $query = "SELECT *
                    FROM " . $this->table_name . "
                    ORDER BY
                    product_id ASC
                    LIMIT {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    // используется для пагинации данных таблиц
    public function countAll()
    {
        // запрос MySQL
        $query = "SELECT product_id FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }
}