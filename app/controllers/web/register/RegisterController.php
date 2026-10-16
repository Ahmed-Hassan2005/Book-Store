<?php

require_once __DIR__ . "/../../Controller.php";
require_once __DIR__ . "/../../../models/user/UserModel.php";

class RegisterController extends Controller{
    public function index(){
        $this->view('register/Register');
    }

    public function register(){
        $errors = Request::validate([
            'role' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email', ['unique', 'users']],
            'password' => ['required', ['min', 8]],
            'phone' => ['required', 'egPhone', ['unique', 'users']],
            'gender' => ['required']
        ]);
        // pr(session('_errors'), true);

        if(!empty($errors)){
            back();
        }

        if(Request::input('role') === 'admin' && !isAuth('admin')){
            // $_SESSION['_errors']['_invalid'][] = 'You Must Login AS Admin To Register Admin';    
            back('_invalid', 'You Must Login AS Admin To Register An Admin');
        }

        UserModel::createUser();

        $newRole = ucfirst(Request::input('role'));

        back('_correct', "New $newRole Account Created Successfully");

    }

}//RegisterController