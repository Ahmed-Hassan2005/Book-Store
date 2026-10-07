<?php

class Route{
    private static array $routes = [];

    public static function get(string $url, string $controller, string $action, array $middlewares = []): void{
        self::$routes[] = [
            'url' => $url,
            'method' => 'GET',
            'controller' => $controller,
            'action' => $action,
            'middlewares' => $middlewares,

        ];//self::$routes

    }//get()

    public static function post(string $url, string $controller, string $action, array $middlewares = []): void{
        self::$routes[] = [
            'url' => $url,
            'method' => 'POST',
            'controller' => $controller,
            'action' => $action,
            'middlewares' => $middlewares,

        ];//self::$routes

    }//post()

    public static function routes(): array{
        return self::$routes;
        
    }//routes()

    public static function dispatch(){
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $method = $_SERVER['REQUEST_METHOD'];

        $flag = false;

        foreach (self::$routes as $route) {
            $args = self::matchRoute(BASE_URL . $route['url'], $url);

            if ($args !== false) {

                if($route['method'] !== $method){
                    $flag = true;
                    continue;

                }//end if

                $flag = false;

                if(!empty($route['middlewares'])) 
                    self::runMiddlewares($route['middlewares']);

                $obj = new $route['controller']();
                $method = $route['action'];
                $obj->$method(...$args);

                return;

            }//end if

        }//foreach

        if ($flag){
            Response::error(405,"405 {$route['method']} Not Allowed");
            return;
        }

        http_response_code(404);

        echo "404 Not Found";

    }//dispatch()

    private static function matchRoute(string $route, string $url): false | array{
        $regex = '#\{[A-Za-z_][A-Za-z_0-9]*\}#';

        $pattern = preg_replace($regex, '([^/]+)', $route);

        $pattern = "#^$pattern$#";

        if(!preg_match($pattern, $url, $matches)){
            return false;
        }

        unset($matches[0]);

        return $matches;

    }//matchRoute()

    public static function runMiddlewares(array $middlewares): void{
        foreach ($middlewares as $middleware) {
            $args = [];

            if(str_contains($middleware,':')){
                $arr = explode(':',$middleware);
                $middleware = $arr[0];
                $args = explode(',',$arr[1]);
            }


            $obj = new $middleware();
            $obj->handle(...$args);

        }//foreach

    }//runMiddlewares()

}//class Route