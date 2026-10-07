<?php

require_once __DIR__ . "/Config.php";

class Database{
    private static string $dbms = DBMS;
    private static string $host = DB_HOST;
    private static string $db = DB_NAME;
    private static string $user = DB_USER;
    private static string $pass = DB_PASS;

    private static ?PDO $connection = null;

    public static function connect(): PDO{
        if(self::$connection === null){
            $dbms = self::$dbms;
            $host = self::$host;
            $db = self::$db;
            $user = self::$user;
            $pass = self::$pass;
            $dsn = "{$dbms}:host={$host};dbname={$db}";
            try{
                self::$connection = new PDO($dsn, $user, $pass);

                self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                die("Database Connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }

    public static function close(): void{
        self::$connection = null;
    }

    

}//class Database