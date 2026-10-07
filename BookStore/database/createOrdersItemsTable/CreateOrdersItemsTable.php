<?php

require_once __DIR__ . '/../../core/Database.php';

class CreateOrdersItemsTable{
    public static function up(){
        $DB = Database::connect();
        $DB->query(
            "CREATE TABLE IF NOT EXISTS orders_items (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                order_id BIGINT UNSIGNED NOT NULL,
                CONSTRAINT fk_order_id
                FOREIGN KEY (order_id)
                REFERENCES orders(id)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
                book_id BIGINT UNSIGNED NOT NULL,
                CONSTRAINT fk_book_id
                FOREIGN KEY (book_id)
                REFERENCES books(id)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
                quantity INT UNSIGNED NOT NULL,
                unit_price DECIMAL(10, 2) NOT NULL,
                subtotal DECIMAL(10, 2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );"
        );
        echo 'Orders items Table is now up';
    }

    public static function down(){
        $DB = Database::connect();
        $DB->query("DROP TABLE IF EXISTS orders_items");
        echo 'Orders items Table is now down';
    }
}//End CreateOrdersItemsTable