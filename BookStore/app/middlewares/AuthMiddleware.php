<?php

require_once __DIR__ . '/Middleware.php';

class AuthMiddleware implements Middleware{

    public function handle(string ...$roles): void{
        if (!isset($_SESSION['user'])) {
            redirect('/login');
        }//end if

        if(empty($roles)){
            return;
        }//end if

        $currentRoleAuth = $_SESSION['user']['role'];

        if(!in_array($currentRoleAuth, $roles)){
            Response::error('Forbidden', 403);
        }//end if

    }//handle()

}//class AuthMiddleware