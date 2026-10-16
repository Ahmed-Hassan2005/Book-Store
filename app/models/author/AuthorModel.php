<?php

require_once __DIR__ . '/../Model.php';

class AuthorModel extends Model{
    public static function insertAuthor(string $name, string $bio): array{
        $DB = Database::connect();

        $stmt = $DB->prepare(
            "INSERT INTO authors
            (name, bio)
            VALUES(:name, :bio);"
        );
        
        $stmt->execute([
            ':name' => $name,
            ':bio' => $bio
        ]);

        $_7amboso = (int) $DB->lastInsertId();
        return $DB->query("SELECT * FROM authors WHERE id = {$_7amboso}")->fetch();
    }
}