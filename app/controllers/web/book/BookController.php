<?php

require_once __DIR__ . '/../../Controller.php';
require_once __DIR__ . '/../../../../core/Request.php';
require_once __DIR__ . '/../../../../core/Response.php';
require_once __DIR__ . '/../../../models/books/BookModel.php';

class BookController extends Controller {
    public function filterBooks(){
        // dd(Request::all());
        $author = Request::input('author', '');

        $title = Request::input('title', '');

        $minPrice = Request::input('minPrice', 0);
        $minPrice = (int)($minPrice == '' ? 0 : $minPrice);

        $maxPrice = Request::input('maxPrice', PHP_INT_MAX);
        $maxPrice = (int)($maxPrice == '' ? PHP_INT_MAX : $maxPrice);

        $stock = Request::input('stock', 0);
        $stock = (int)($stock == '' ? 0 : $stock);

        $sortBy = Request::input('sortBy', 'DESC');

        $wheres = [];
        if($author != ''){
            $wheres[] = ['authors.name', 'LIKE', "%$author%"];
        }
        if($title != ''){
            $wheres[] = ['books.title', 'LIKE', "%$title%"];
        }
        if($stock != 0){
            $wheres[] = ['books.stock', '=', $stock];
        }
        if($minPrice != 0){
            $wheres[] = ['books.price', '>=', $minPrice];
        }
        if($maxPrice != PHP_INT_MAX){
            $wheres[] = ['books.price', '<=', $maxPrice];
        }
        // pr($stock);
        // pr($wheres, true);

        $data = BookModel::getDataBooks($wheres, page: Request::input('page', 1), orderBy: "id {$sortBy}");

        Response::json($data);
    }
}