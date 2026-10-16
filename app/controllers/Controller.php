<?php

class Controller{
    protected function view(string $path, array $data = []): void{
        extract($data);
        require_once __DIR__ . "/../views/$path.php";
    }//view()

}//class Controller