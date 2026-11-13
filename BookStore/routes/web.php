<?php

//Route Class
require_once __DIR__ . '/../core/Route.php';

//Controllers
require_once __DIR__ . '/../app/controllers/web/home/HomeController.php';
require_once __DIR__ . '/../app/controllers/web/login/LoginController.php';
require_once __DIR__ . '/../app/controllers/web/register/RegisterController.php';
require_once __DIR__ . '/../app/controllers/web/profile/ProfileController.php';
require_once __DIR__ . '/../app/controllers/web/user/UserController.php';
require_once __DIR__ . '/../app/controllers/web/author/AuthorController.php';
require_once __DIR__ . '/../app/controllers/web/book/BookController.php';
require_once __DIR__ . '/../app/controllers/web/admin/AdminController.php';
require_once __DIR__ . '/../app/controllers/web/cart/CartController.php';

//Middlewares
require_once __DIR__ . '/../app/middlewares/AuthMiddleware.php';
require_once __DIR__ . '/../app/middlewares/GuestMiddleware.php';
require_once __DIR__ . '/../app/middlewares/RegisterMiddleware.php';

Route::get('/', HomeController::class, 'index');

Route::get('/login', LoginController::class, 'index', [GuestMiddleware::class]);
Route::post('/login', LoginController::class, 'login', [GuestMiddleware::class]);
Route::get('/logout', LoginController::class, 'logout', [AuthMiddleware::class]);

Route::get('/register', RegisterController::class, 'index', [RegisterMiddleware::class]);
Route::post('/register', RegisterController::class, 'register', [RegisterMiddleware::class]);

Route::get('/profile', ProfileController::class, 'index', [AuthMiddleware::class]);
Route::post('/profile/editName', UserController::class, 'editName', [AuthMiddleware::class]);
Route::post('/profile/editEmail', UserController::class, 'editEmail', [AuthMiddleware::class]);
Route::post('/profile/editGender', UserController::class, 'editGender', [AuthMiddleware::class]);
Route::post('/profile/editPhone', UserController::class, 'editPhone', [AuthMiddleware::class]);
Route::post('/profile/editPassword', UserController::class, 'editPassword', [AuthMiddleware::class]);
Route::post('/profile/filterBooks', BookController::class, 'filterBooks', [AuthMiddleware::class]);
// Route::post('/profile/filterBooks', BookController::class, 'filterBooks');

//----------------------------------------------Admin-------------------------------------------

Route::post('/profile/addAuthor', AuthorController::class, 'addAuthor', ['AuthMiddleware:admin']);
Route::post('/profile/addBook', BookController::class, 'addBook', ['AuthMiddleware:admin']);
Route::post('/profile/banUser', AdminController::class, 'banUser', ['AuthMiddleware:admin']);

//----------------------------------------------Customer-------------------------------------------

Route::post('/profile/addToCart', CartController::class, 'addToCart', ['AuthMiddleware:customer']);
Route::post('/profile/getItemsIntoCarts', CartController::class, 'getItemsIntoCarts', ['AuthMiddleware:customer']);
Route::post('/profile/incOrderItem', CartController::class, 'incOrderItem', ['AuthMiddleware:customer']);
// Route::post('/profile/incOrderItem', CartController::class, 'incOrderItem');
Route::post('/profile/decOrderItem', CartController::class, 'decOrderItem', ['AuthMiddleware:customer']);
Route::post('/profile/deleteOrderItem', CartController::class, 'deleteOrderItem', ['AuthMiddleware:customer']);
Route::post('/profile/fireOrder', CartController::class, 'fireOrder', ['AuthMiddleware:customer']);




