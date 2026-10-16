<?php

require_once __DIR__ . '/../../models/user/UserModel.php';

class UserController{
    public function getUsers(){
        // $users = [
        //     ['id' => 1, 'name' => 'John Doe'],
        //     ['id' => 2, 'name' => 'Jane Doe'],
        //     ['id' => 3, 'name' => 'Peter Doe'],
        // ];

        $userModel = new UserModel();
        Response::json([
            'message' => 'Users fetch successfully',
            "data" => $userModel->getUsers()
        ], "ok", 200);
    }
}