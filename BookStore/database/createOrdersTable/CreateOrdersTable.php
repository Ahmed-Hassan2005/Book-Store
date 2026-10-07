<?php

require_once __DIR__ . '/../../core/Database.php';

class CreateOrdersTable{
    public static function up(){
        $DB = Database::connect();
        $DB->query(
            "CREATE TABLE IF NOT EXISTS orders (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                customer_id BIGINT UNSIGNED NOT NULL,
                CONSTRAINT fk_customer_id
                FOREIGN KEY (customer_id)
                REFERENCES users(id)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
                status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
                cancel_reason TEXT NULL,
                total_price DECIMAL(10, 2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );"
        );
        echo 'Orders Table is now up';
    }

    public static function down(){
        $DB = Database::connect();
        $DB->query("DROP TABLE IF EXISTS orders");
        echo 'Orders Table is now down';
    }
}//End CreateOrdersTable