<?php

require_once __DIR__ . '/../Model.php';

class AdminModel extends Model{
    public static function toggleBanUser(): array{
        $DB = Database::connect();
        $userId = Request::input('user_id');
        $stmt = $DB->prepare(
            "SELECT *
            FROM users 
            WHERE id = :userId;"
        );
        $stmt->execute([
            'userId' => $userId
        ]);
        $user = $stmt->fetch();
        $isBanned = (bool)$user['is_banned'];
        $stmt = $DB->prepare(
            "UPDATE users 
            SET is_banned = :newBan
            WHERE id = :userId;"
        );
        $stmt->execute([
            'newBan' => !$isBanned,
            'userId' => $userId
        ]);
        $user['is_banned'] = !$isBanned;
        return $user;
    }
}