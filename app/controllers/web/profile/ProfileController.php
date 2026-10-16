<?php

require_once  __DIR__ . '/../../Controller.php';
require_once  __DIR__ . '/../../../models/user/UserModel.php';
require_once  __DIR__ . '/../../../models/DB/DBModel.php';
require_once  __DIR__ . '/../../../models/books/BookModel.php';
require_once  __DIR__ . '/../../../models/orders/OrderModel.php';

class ProfileController extends Controller{

    public function index(){
        $data = $this->getAdminData();

        // dd($data);
        // pr($data, true);
        // DBModel::getTotal("users", [
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
    }//index()

    private function getAdminData(){
        return [
            'total' => [
                'books' => DBModel::getTotal("books"),
                'authors' => DBModel::getTotal("authors"),
                'customers' => DBModel::getTotal("users", [["role", "=", "customer"]]),
                'admins' => DBModel::getTotal("users", [["role", "=", "admin"]]),

                'orders' => [
                    'ordered' => DBModel::getTotal("orders", [['status', '=', 'ordered']]),
                    'cancelled' => DBModel::getTotal("orders", [['status', '=', 'canceled']]),
                    'done' => DBModel::getTotal("orders", [['status', '=', 'done']]),
                ]//'orders'

            ],//'total'

            'admins' => DBModel::getDataTable(
                "users", 
                [["role", "=", "admin"], ['id', '!=', auth('id')]], 
                Request::input('admins-page', 1)

            ),//'admins'

            'customers' => DBModel::getDataTable(
                "users", 
                [["role", "=", "customer"]], 
                Request::input('customers-page', 1)

            ),//'customers'

            'authors' => DBModel::getDataTable(
                "authors", 
                page: Request::input('authors-page', 1)

            ),//'authors'
            'books' => BookModel::getDataBooks(page: Request::input('books-page', Request::input('page', 1))),

            'orders' => [

                'ordered' => OrderModel::getDataOrders(
                    [["status", "=", "ordered"]], 
                    page: Request::input('orders_ordered-page', 1)
                ),

                'cancelled' => OrderModel::getDataOrders(
                    [["status", "=", "canceled"]], 
                    page: Request::input('orders_cancelled-page', 1)
                ),

                'done' => OrderModel::getDataOrders(
                    [["status", "=", "done"]], 
                    page: Request::input('orders_done-page', 1)
                ),

            ],//'orders'

        ];//retuurn

    }//getAdminData()

}//class ProfileController


