<?php

require_once __DIR__ . '/../../core/Database.php';

class CreateAuthorsTable{
    public static function up(){
        $DB = Database::connect();
        $DB->query(
            "CREATE TABLE IF NOT EXISTS authors (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                bio TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );"
        );
        echo 'Authors Table is now up';
    }

    public static function down(){
        $DB = Database::connect();
        $DB->query("DROP TABLE IF EXISTS authors");
        echo 'Authors Table is now down';
    }
}//End CreateAuthorsTable