<?php

require_once  __DIR__ . '/../../Controller.php';
require_once  __DIR__ . '/../../../../core/Request.php';
require_once  __DIR__ . '/../../../models/user/UserModel.php';

class UserController extends Controller{
    public function editName(){
        // pr(['ok']);
        $errors = Request::validate([
            'name' => ['required']
        ]);
        if(!empty($errors)){
            $_SESSION['_errors'] = [];
            back('editAlert', ["error", $errors['name'][0]]);
        }
        else {
            UserModel::edit('name', Request::input('name'));
            $_SESSION['user']['name'] = Request::input('name');
            unset($_SESSION['_old']);
            back('editAlert', ["success", "Name Has Been Updated Successfully"]);
        }
    }

    public function editEmail(){
        $errors = Request::validate([
            'email' => ['required', 'email', ['unique', 'users', auth('id')]]
        ]);
        if(!empty($errors)){
            $_SESSION['_errors'] = [];
            back('editAlert', ["error", $errors['email'][0]]);
        }
        else {
            UserModel::edit('email', Request::input('email'));
            $_SESSION['user']['email'] = Request::input('email');
            unset($_SESSION['_old']);
            back('editAlert', ["success", "Email Has Been Updated Successfully"]);
        }
    }

    public function editGender(){
        $errors = Request::validate([
            'gender' => ['required']
        ]);
        if(!empty($errors)){
            $_SESSION['_errors'] = [];
            back('editAlert', ["error", $errors['gender'][0]]);
        }
        else {
            UserModel::edit('gender', Request::input('gender'));
            $_SESSION['user']['gender'] = Request::input('gender');
            unset($_SESSION['_old']);
            back('editAlert', ["success", "Gender Has Been Updated Successfully"]);
        }
    }

    public function editPhone(){
        $errors = Request::validate([
            'phone' => ['required', 'egPhone', ['unique', 'users', auth('id')]]
        ]);
        if(!empty($errors)){
            $_SESSION['_errors'] = [];
            back('editAlert', ["error", $errors['phone'][0]]);
        }
        else {
            UserModel::edit('phone', Request::input('phone'));
            $_SESSION['user']['phone'] = Request::input('phone');
            unset($_SESSION['_old']);
            back('editAlert', ["success", "Phone Has Been Updated Successfully"]);
        }
    }

    public function editPassword(){
        $errors = Request::validate([
            'password' => ['required', ['min', 8]]
        ]);
        if(!empty($errors)){
            $_SESSION['_errors'] = [];
            back('editAlert', ["error", $errors['password'][0]]);
        }
        else {
            UserModel::edit('password', Request::input('password'));
            $_SESSION['user']['password'] = Request::input('password');
            unset($_SESSION['_old']);
            back('editAlert', ["success", "Password Has Been Updated Successfully"]);
        }
    }
}