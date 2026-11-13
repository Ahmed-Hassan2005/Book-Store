<?php

require_once  __DIR__ . '/../../Controller.php';
require_once  __DIR__ . '/../../../models/user/UserModel.php';
require_once  __DIR__ . '/../../../models/DB/DBModel.php';
require_once  __DIR__ . '/../../../models/books/BookModel.php';
require_once  __DIR__ . '/../../../models/orders/OrderModel.php';
require_once  __DIR__ . '/../../../models/cart/CartModel.php';

class ProfileController extends Controller{

    public function index(){
        $data = [];
        if(isAuth('admin')){
            $data = $this->getAdminData();
        }
        else{
            $data = $this->getCustomerData();
        }
        // pr($data, true);

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

        ];//returrn

    }//getAdminData()

    private function getCustomerData(){
        return [
            'total' => [
                'books' => DBModel::getTotal("books"),
                'boughtBooks' => DBModel::getTotalAllBooksOfCustomer(),
                'cartsItems' => CartModel::totalItemsIntoOrders(),
                // 'authors' => [],
                // 'customers' => [],
                // 'admins' => [],
                'orders' => [
                    'ordered' => DBModel::getTotal("orders", [
                        ['status', '=', 'ordered'],
                        ['customer_id', '=', auth('id')],
                    ]),
                    'cancelled' => DBModel::getTotal("orders", [
                        ['status', '=', 'canceled'],
                        ['customer_id', '=', auth('id')],
                    ]),
                    'done' => DBModel::getTotal("orders", [
                        ['status', '=', 'done'],
                        ['customer_id', '=', auth('id')],
                    ]),
                ]//'orders'

            ],//'total'
            'admins' => [],
            'authors' => [],
            'customers' => [],
            'books' => BookModel::getDataBooks(page: Request::input('books-page', Request::input('page', 1))),
            'orders' => [

                'ordered' => OrderModel::getDataOrders(
                    [
                        ["status", "=", "ordered"],
                        ['customer_id', '=', auth('id')],
                    ], 
                    page: Request::input('orders_ordered-page', 1)
                ),

                'cancelled' => OrderModel::getDataOrders(
                    [
                        ["status", "=", "canceled"],
                        ['customer_id', '=', auth('id')],
                    ], 
                    page: Request::input('orders_cancelled-page', 1)
                ),

                'done' => OrderModel::getDataOrders(
                    [
                        ["status", "=", "done"],
                        ['customer_id', '=', auth('id')],
                    ],
                    page: Request::input('orders_done-page', 1)
                ),

            ],//'orders'

        ];//returrn

    }

}//class ProfileController
