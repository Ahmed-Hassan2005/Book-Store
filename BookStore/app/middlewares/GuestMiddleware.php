<?php

require_once __DIR__ . '/Middleware.php';

class GuestMiddleware implements Middleware{
    
    public function handle(string ...$roles): void{
        if (isset($_SESSION['user'])) {
            // Response::error('Forbidden<br>Already Authenticated', 403);
            redirect('/profile');
        }//end if

    }//handle()

}//class AuthMiddleware