<?php

require_once __DIR__ . '/../Model.php';

class UserModel extends Model {
    // public function getUsers(): array {
    //     return $this->DB->query("SELECT * FROM customers")->fetchAll();
    // }//getUsers()

    public static function createUser(){
        $DB = Database::connect();

        $data = Request::all();

        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $DB->exec(
            "INSERT INTO users
            (role, name, email, password, phone, gender)
            VALUES
            ('{$data['role']}', '{$data['name']}', '{$data['email']}', '{$password}', '{$data['phone']}', '{$data['gender']}')
            "
        );
    }//createUser()

    public static function edit(string $column, string $value){
        $DB = Database::connect();

        $id = auth('id');

        if($column === 'password')
            $value = password_hash($value, PASSWORD_DEFAULT);

        $DB->exec(
            "UPDATE users
            SET {$column} = '{$value}'
            WHERE id = '{$id}'"
        );
    }//edit()

}