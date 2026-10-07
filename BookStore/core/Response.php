<?php

require_once __DIR__ . '/../app/helpers/Helpers.php';

class Response{
    public static function error(string $message, int $code = 500): void{
        http_response_code($code);

        echo $message;

        exit;
    }//error()
    
    public static function json(array $data, string $message = 'ok', int $code = 200): void{

        http_response_code($code);
        
        json([
            'data' => $data,
            'message' => $message,
            'code' => $code
        ]);

        exit;

    }//json()
    
}//Response