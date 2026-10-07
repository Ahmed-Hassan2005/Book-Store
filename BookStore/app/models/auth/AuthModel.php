<?php

require_once __DIR__ . '/../Model.php';

class AuthModel extends Model {
    public static function login(): bool{
        $DB = Database::connect();

        $email = Request::input('email');
        $password = Request::input('password');

        $stmt = $DB->query(
            "SELECT *
            FROM users 
            WHERE email = '{$email}';"
        );

        $result = $stmt->fetch();

        if(!empty($result) && password_verify($password, $result['password'])){
            session('user', $result);
            return true;
        }

        return false;
    }
}