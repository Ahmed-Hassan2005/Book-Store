<?php

require_once __DIR__ . '/../../core/Database.php';

class CreateUsersTable{
    public static function up(){
        $DB = Database::connect();
        $DB->query(
            "CREATE TABLE IF NOT EXISTS users (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                phone VARCHAR(20) UNIQUE,
                is_banned BOOLEAN DEFAULT FALSE,
                gender ENUM('male', 'female') NOT NULL,
                role ENUM('customer', 'admin') NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );"
        );
        echo 'Users Table is now up';
    }

    public static function down(){
        $DB = Database::connect();
        $DB->query("DROP TABLE IF EXISTS users");
        echo 'Users Table is now down';
    }
}//End CreateUsersTable