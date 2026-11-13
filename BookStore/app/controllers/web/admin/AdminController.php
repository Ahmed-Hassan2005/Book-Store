<?php

require_once __DIR__ . '/../../Controller.php';
require_once __DIR__ . '/../../../models/admin/AdminModel.php';
require_once __DIR__ . '/../../../models/DB/DBModel.php';


class AdminController extends Controller{
    public function banUser(){
        // Response::json(Request::all());
        $errors = Request::validate([
            'user_id' => ['required', ['exists', 'users', 'id']],
        ]);
        // dd($errors);

        if(!empty($errors)){
            Response::json($errors, code: 422);
        }

        $bannedUserRole = DBModel::getRoleOfUser(Request::input('user_id'));
        $bannedUserId = Request::input('user_id');

        if($bannedUserRole == 'admin' && auth('id') > $bannedUserId){
            Response::json([], "You can not ban an admin with higher id u stooopid", 403);
        }

        $user = AdminModel::toggleBanUser();
        Response::json($user);
    }


}