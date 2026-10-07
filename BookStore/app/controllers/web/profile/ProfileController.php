<?php

require_once  __DIR__ . '/../../Controller.php';
require_once  __DIR__ . '/../../../models/user/UserModel.php';

class ProfileController extends Controller{

    public function index(){
        $data = $this->getAdminData();

        // dd($data);
        // UserModel::getTotal("users", [
        //     ['id', '=', 1, 'AND', 1],
        //     ['id', '=', 2, 'AND', 0.5],
        //     ['id', '=', 2, 'AND', 0],
        //     ['id', '=', 2, 'OR', 0.5],
        //     ['id', '=', 2, 'AND', 2],
        //     ['id', '=', 2, 'AND', 3],
        //     ['id', '=', 2, 'AND', -1],
        //     ['id', '=', 3, 'AND', 1],
        // ]);

        return $this->view("profile/Profile", $data);
    }

    private function getAdminData(){
        return [
            'total' => [
                'books' => UserModel::getTotal("books"),
                'authors' => UserModel::getTotal("authors"),
                'customers' => UserModel::getTotal("users", [["role", "=", "customer"]]),
                'admins' => UserModel::getTotal("users", [["role", "=", "admin"]]),
                'orders' => [
                    'ordered' => UserModel::getTotal("orders", [['status', '=', 'ordered']]),
                    'cancelled' => UserModel::getTotal("orders", [['status', '=', 'cancelled']]),
                    'done' => UserModel::getTotal("orders", [['status', '=', 'done']]),
                ]
            ],
            'admins' => UserModel::getDataTable("users", [
                ["role", "=", "admin"],
                ['id', '!=', auth('id')]
            ]),
            'customers' => UserModel::getDataTable("users", [["role", "=", "customer"]]),
            'authors' => UserModel::getDataTable("authors"),
            'books' => UserModel::getDataTable("books"),
            'orders' => [
                'ordered' => UserModel::getDataTable("orders", [['status', '=', 'ordered']]),
                'cancelled' => UserModel::getDataTable("orders", [['status', '=', 'cancelled']]),
                'done' => UserModel::getDataTable("orders", [['status', '=', 'done']]),
            ],
        ];
    }

}