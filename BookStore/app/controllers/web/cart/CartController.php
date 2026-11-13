<?php

require_once __DIR__ . '/../../Controller.php';
require_once __DIR__ . '/../../../models/cart/CartModel.php';

class CartController extends Controller{
    public function addToCart(){
        // Response::json(Request::all());

        $errors = Request::validate([
            'book_id' => ['required', ['exists', 'books', 'id']],
            'quantity' => ['required']
        ]);

        $quantity = (int)Request::input('quantity');

        if(!empty($errors) || $quantity < 1){
            if($quantity < 1) $errors['quantity'] = 'Quantity must be at least 1';
            Response::json($errors, code: 422);
        }

        CartModel::addToCart();
        Response::json([
            'total' => CartModel::totalItemsIntoOrders()
        ]);
    }

    public function getItemsIntoCarts(){
        // Response::json(CartModel::getItemsIntoCarts());
        $orderId = Request::input('orderId');
        if($orderId == '') $orderId = null;
        if($orderId !== null){
            $errors = Request::validate([
                'orderId' => ['required', ['exists', 'orders', 'id']]
            ]);

            if(!empty($errors)){
                Response::json($errors, code:422);
            }
            $orderId = (int)$orderId;
        }
        
        $data = CartModel::getItemsIntoCarts($orderId);
        Response::json($data);
    }

    public function incOrderItem(){
        // Response::json(Request::all());
        // dd("asfdg");
        $errors = Request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']],
        ]);

        if(!empty($errors)){
            // dd($errors);
            Response::json($errors, code: 422);
        }
        $data = CartModel::incOrderItem();
        Response::json($data);
    }

    public function decOrderItem(){
        // Response::json(Request::all());
        // dd("asfdg");
        $errors = Request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']],
        ]);

        if(!empty($errors)){
            // dd($errors);
            Response::json($errors, code: 422);
        }
        $data = CartModel::decOrderItem();
        Response::json($data);
    }

    public function deleteOrderItem(){
        // Response::json(Request::all());
        // dd("asfdg");
        $errors = Request::validate([
            'orderItemId' => ['required', ['exists', 'orders_items', 'id']],
        ]);

        if(!empty($errors)){
            // dd($errors);
            Response::json($errors, code: 422);
        }
        $data = CartModel::deleteOrderItem();
        Response::json($data);
    }

    public function fireOrder(){
        // Response::json(Request::all());
        // dd("asfdg");
        $errors = Request::validate([
            'orderId' => ['required', ['exists', 'orders', 'id']],
        ]);

        if(!empty($errors)){
            // dd($errors);
            Response::json($errors, code: 422);
        }
        // $data = 
        CartModel::fireOrder();
        Response::json(/*$data*/ []);
    }//fireOrder()

}