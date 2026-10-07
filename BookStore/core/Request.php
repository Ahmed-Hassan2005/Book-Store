<?php

class Request{
    public static function all(): array{
        $json = json_decode(file_get_contents('php://input'), true);
        
        $all = array_merge($_GET, $_POST, is_array($json) ? $json : []);

        unset($all['url']);

        return $all;

    }//all()

    public static function input(string $key, mixed $default = null): mixed{
        return self::all()[$key] ?? $default;
    }

    public static function validate(array $rules): array{
        // pr($_POST, true);
        $all = self::all();
        $validator = new Validation($all, $rules);
        $errors = $validator->validate();
        session('_old', $all);
        session('_errors', $errors);
        return $errors;
    }

}//class Request