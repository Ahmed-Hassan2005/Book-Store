<?php

class RegisterMiddleware implements Middleware{
    public function handle(string ...$rules): void{
        if (isAuth('customer')){
            redirect('/profile');
        }
    }
}