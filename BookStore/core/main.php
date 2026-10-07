<?php

function main(){
    session_start();

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $type = str_starts_with($path, BASE_URL . '/api') ? 'api' : 'web';

    if($type === 'api'){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');
    }

    require_once __DIR__ . "/../routes/{$type}.php";
    require_once __DIR__ . "/Request.php";
    require_once __DIR__ . "/Response.php";
    require_once __DIR__ . "/Validation.php";

    
    // $_SESSION['user'] = [];
    // $_SESSION['user']['role'] = 'admin';

    // Response::json(Route::routes(), "ok", 200);
    
    Route::dispatch();
}