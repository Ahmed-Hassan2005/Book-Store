<?php

function pr(mixed $var, bool $die = false): void{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    
    if($die){
        die;
    }
}//pr()

function prJson(mixed $var, bool $die = false): void{
    echo '<pre>';
    print_r(json_encode($var));
    echo '</pre>';
    
    if($die){
        die;
    }
}//pr()

function json(array $var, bool $die = false): void{
    header('Content-Type: application/json');
    echo json_encode($var);
    
    if($die){
        die;
    }
}//json

function asset(string $path): string{
    return BASE_URL . "/assets/" . ltrim($path, "/");
}//asset()

function session(string|null $key = '', mixed $value = null): mixed{
    if(func_num_args() === 1){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }

    if(func_num_args() === 2){
        $_SESSION[$key] = $value;
        return true;
    }

    if(func_num_args() === 0){
        return $_SESSION;
    }

    return null;
}//session()

function old(string $key, bool $unset = false): mixed{
    $result = session('_old')[$key] ?? '';
    if($unset)
        unset($_SESSION['_old'][$key]);
    return $result;
}//old()

function dd(mixed $var): void {
    if(is_array($var)){
        pr($var, true);
    }
    else{
        pr([$var], true);
    }
    
}//dd()

function isAuth(?string $role = null): bool{
    $user = session('user');
    if(!isset($user)){
        return false;
    }
    if($role === null){
        return true;
    }
    return $role === $user['role'] ?? null;

}//isAuth()

function auth(?string $key = null){
    return ($key !== null) ? session('user')[$key] ?? null : session('user');

}//auth()

function isGuest(): bool{
    return !isAuth();

}//isGuest()

function redirect(?string $path, bool $full = false): void{
    $url = ($full) ? $path : BASE_URL . '/' . ltrim($path, '/');

    header("Location: {$url}");
    exit;

}//redirect()

function route(?string $path = null){
    if(func_num_args() === 0){
        return BASE_URL;
    }
    return BASE_URL . '/' . ltrim($path, '/');

}//route()

function back(?string $key = null, string | array | null $messege = ''): void{
    if($key !== null){
        $_SESSION[$key] = $messege;
    }
    redirect($_SERVER['HTTP_REFERER'], true);
}//back()

function getError(string $key): string{
    $html = '';
    if(isset($_SESSION['_errors'][$key])){
        $msg = session('_errors')[$key][0];
        $html = "<p class='alert alert-danger mt-2'>{$msg}</p>";
        unset($_SESSION['_errors'][$key]);
    }
    return $html;
}//getError()

function getSseeionMsg(string $key, bool $iserror = true): string{
    $className = $iserror ? 'alert-danger' : 'alert-success';

    $html = '';

    if(isset($_SESSION[$key])){
        $msg = session($key);

        $html = "<p class='alert {$className} mt-2'>{$msg}</p>";

        unset($_SESSION[$key]);
    }

    return $html;
}//getError()

function oldSelect(string $key, string $value, bool $unset = false): string {
    $result = (isset($_SESSION['_old'][$key]) && $_SESSION['_old'][$key] == $value) ? "selected" : '';
    if(!isset($_SESSION['_old'][$key]) && $value == '')
        $result = "selected";
    

    if($unset)
        unset($_SESSION['_old'][$key]);

    return $result;
}//oldSelect()

function isSelect(mixed $value, mixed $optionValue): string {
    return ($optionValue == $value) ? "selected" : '';
}//isSelect()
