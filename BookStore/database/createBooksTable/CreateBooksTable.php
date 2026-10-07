<?php

require_once __DIR__ . '/../../core/Database.php';

class CreateBooksTable{
    public static function up(){
        $DB = Database::connect();
        $DB->query(
            "CREATE TABLE IF NOT EXISTS books (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                author_id BIGINT UNSIGNED NOT NULL,
                CONSTRAINT fk_author_id
                FOREIGN KEY (author_id)
                REFERENCES authors(id)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
                title VARCHAR(100) NOT NULL,
                image VARCHAR(255) NULL,
                description TEXT NULL,
                price DECIMAL(10, 2) NOT NULL,
                stock INT UNSIGNED DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );"
        );
        echo 'Books Table is now up';
    }

    public static function down(){
        $DB = Database::connect();
        $DB->query("DROP TABLE IF EXISTS books");
        echo 'Books Table is now down';
    }
}//End CreateBooksTable