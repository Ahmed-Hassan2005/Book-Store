<?php

//Route Class
require_once __DIR__ . '/../core/Route.php';

//Controllers
require_once __DIR__ . '/../app/controllers/web/home/HomeController.php';
require_once __DIR__ . '/../app/controllers/web/login/LoginController.php';
require_once __DIR__ . '/../app/controllers/web/register/RegisterController.php';
require_once __DIR__ . '/../app/controllers/web/profile/ProfileController.php';

//Middlewares
require_once __DIR__ . '/../app/middlewares/AuthMiddleware.php';
require_once __DIR__ . '/../app/middlewares/GuestMiddleware.php';
require_once __DIR__ . '/../app/middlewares/RegisterMiddleware.php';

Route::get('/', HomeController::class, 'index');

Route::get('/login', LoginController::class, 'index', [GuestMiddleware::class]);
Route::post('/login', LoginController::class, 'login', [GuestMiddleware::class]);
Route::get('/logout', LoginController::class, 'logout', [AuthMiddleware::class]);

Route::get('/register', RegisterController::class, 'index', [RegisterMiddleware::class]);
Route::post('/register', RegisterController::class, 'register', [GuestMiddleware::class]);


Route::get('/profile', ProfileController::class, 'index', [AuthMiddleware::class]);

