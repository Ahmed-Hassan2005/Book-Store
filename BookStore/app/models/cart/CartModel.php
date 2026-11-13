<?php

require_once __DIR__ . '/../Model.php';

class CartModel extends Model{
    public static function addToCart(){
        // Response::json([self::getPendingOrderId()]);
        $DB = Database::connect();
        $authId = auth('id');
        if(!self::getPendingOrderId()){
            $DB->exec("
                INSERT INTO orders
                (customer_id)
                VALUES
                ($authId)
            ;");
        }
        $bookId = Request::input('book_id');
        $quantity = Request::input('quantity');
        $orderId = self::getPendingOrderId();
        $ordersItemId = self::getOrderItemId($orderId, $bookId);
        $unitPrice = $DB->query("SELECT price FROM books WHERE id = '$bookId'")->fetchColumn();
        $subtotal = $unitPrice * $quantity;
        if(!$ordersItemId){
            $stmt = $DB->prepare("
                INSERT INTO orders_items
                (order_id, book_id, quantity, unit_price, subtotal)
                VALUES
                (:order_id, :book_id, :quantity, :unit_price, :subtotal)
            ;");
            $stmt->execute([
                'order_id' => $orderId,
                'book_id' => $bookId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);
        }
        else{
            $DB->exec("
                UPDATE orders_items
                SET
                quantity = quantity + $quantity,
                subtotal = subtotal + $subtotal
                WHERE id = $ordersItemId
            ;");
        }
        self::updateTotalPriceOfOrder($orderId);
    }

    private static function getOrderItemId(string $orderId, string $bookId): int|false{
        $DB = Database::connect();
        $stmt = $DB->query("SELECT id FROM orders_items WHERE order_id = '$orderId' AND book_id = '$bookId'");
        return $stmt->fetchColumn();
    }

    private static function updateTotalPriceOfOrder(string $orderId){
        $DB = Database::connect();
        $totalPrice = $DB->query("
            SELECT SUM(subtotal) 
            FROM orders_items 
            WHERE order_id = '$orderId'
        ;")->fetchColumn() ?? 0;

        $DB->exec("
            UPDATE orders
            SET total_price = $totalPrice
            WHERE id = $orderId
        ;");

        return $totalPrice;
    }

    public static function totalItemsIntoOrders(): int{
        $DB = Database::connect();
        $orderId = self::getPendingOrderId();
        if(!$orderId) return 0;
        return (int) $DB->query("
            SELECT COUNT(*) AS total
            FROM orders_items
            WHERE order_id = $orderId;
        ")->fetchColumn();
    }

    private static function getPendingOrderId(): int|false{
        $DB = Database::connect();
        $customerId = auth('id');
        $stmt = $DB->query("SELECT id FROM orders WHERE customer_id = $customerId AND status = 'pending'");
        return $stmt->fetchColumn();
    }

    public static function getItemsIntoCarts(?int $orderId = null){
        $DB = Database::connect();
        if(!$orderId) {
            $orderId = self::getPendingOrderId();
        }
        $orderId = (int)$orderId;
        // $customerId = auth('id');
        $stmt = $DB->prepare("
            SELECT
                books.id AS books_id,
                books.title AS books_title,
                books.image AS books_image,
                books.description AS books_description,
                books.price AS books_price,
                books.stock AS books_stock,
                authors.id AS authors_id,
                authors.name AS authors_name,
                orders_items.id AS items_id,
                orders_items.quantity AS items_quantity,
                orders_items.subtotal AS items_subtotal,
                orders.id AS orders_id,
                orders.total_price AS orders_total_price
                
            FROM orders_items
            LEFT JOIN orders ON orders.id = orders_items.order_id
            LEFT JOIN books ON books.id = orders_items.book_id
            LEFT JOIN authors ON authors.id = books.author_id
            WHERE 
                orders.id = :orderId 
                -- AND orders.status = 'pending'
        ;");
        $stmt->execute([
            ':orderId' => $orderId
        ]);
        return $stmt->fetchAll();

    }//getItemsIntoCarts()

    public static function incOrderItem(){
        $DB = Database::connect();
        // $customerId = auth('id');

        $stmt = $DB->prepare("
            UPDATE orders_items
            SET 
                quantity = quantity + 1,
                subtotal = unit_price * quantity
            WHERE id = :orderItemId
        ;");
        $stmt->execute([
            "orderItemId" => Request::input('orderItemId')
        ]);

        $stmt = $DB->prepare("
            SELECT *
            FROM orders_items
            WHERE id = :orderItemId
        ;");
        $stmt->execute([
            "orderItemId" => Request::input('orderItemId')
        ]);

        $orderItem = $stmt->fetch();

        $orderId = self::getPendingOrderId();

        $totalPrice = self::updateTotalPriceOfOrder($orderId);
        
        return compact(
            'orderItem',
            'orderId',
            'totalPrice'
        );
    }

    public static function decOrderItem(){
        $DB = Database::connect();
        // $customerId = auth('id');

        $stmt = $DB->prepare("
            UPDATE orders_items
            SET 
                quantity = quantity - 1,
                subtotal = unit_price * quantity
            WHERE id = :orderItemId
        ;");
        $stmt->execute([
            "orderItemId" => Request::input('orderItemId')
        ]);

        $stmt = $DB->prepare("
            SELECT *
            FROM orders_items
            WHERE id = :orderItemId
        ;");
        $stmt->execute([
            "orderItemId" => Request::input('orderItemId')
        ]);

        $orderItem = $stmt->fetch();

        if($orderItem['quantity'] == 0){
            $stmt = $DB->prepare("DELETE FROM orders_items WHERE id = :orderItemId;");
            $stmt->execute([
                "orderItemId" => Request::input('orderItemId')
            ]);
        }

        $orderId = self::getPendingOrderId();

        $totalPrice = self::updateTotalPriceOfOrder($orderId);
        
        return compact(
            'orderItem',
            'orderId',
            'totalPrice'
        );
    }

    public static function deleteOrderItem(){
        $DB = Database::connect();
        // $customerId = auth('id');

        $stmt = $DB->prepare("DELETE FROM orders_items WHERE id = :orderItemId;");
        $stmt->execute([
            "orderItemId" => Request::input('orderItemId')
        ]);

        $orderId = self::getPendingOrderId();

        $totalPrice = self::updateTotalPriceOfOrder($orderId);
        
        return compact(
            // 'orderId',
            'totalPrice'
        );
    }

    public static function fireOrder(){
        $DB = Database::connect();
        // $customerId = auth('id');

        $stmt = $DB->prepare(
            "UPDATE orders
            SET status = 'ordered'
            WHERE id = :orderId;"
        );
        $stmt->execute([
            "orderId" => Request::input('orderId')
        ]);

        // $orderId = self::getPendingOrderId();

        // $totalPrice = self::updateTotalPriceOfOrder($orderId);

        // return compact(
        //     // 'orderId',
        //     'totalPrice'
        // );
    }

}//class CartModel
































/*
SELECT
    books.id AS books_id,
    books.title AS books_title,
    books.image AS books_image,
    books.description AS books_description,
    books.price AS books_price,
    books.stock AS books_stock,
    authors.id AS authors_id,
    authors.name AS authors_name,
    orders_items.id AS items_id,
    orders_items.quantity AS items_quantity,
    orders_items.subtotal AS items_subtotal,
    orders.id AS orders_id,
    orders.total_price AS orders_total_price
    
FROM orders_items
LEFT JOIN orders ON orders.id = orders_items.order_id
LEFT JOIN books ON books.id = orders_items.book_id
LEFT JOIN authors ON authors.id = books.author_id
WHERE 
    orders.customer_id = 21
    AND
    orders.status = 'pending';
*/