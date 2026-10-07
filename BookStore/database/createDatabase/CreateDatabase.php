<?php

require_once __DIR__ . "/../../core/Config.php";

class CreateDatabase{
    private static function buildConnect(
        string $dbms,
        string $host,
        string $user,
        string $pass
    ): PDO {
        $dsn = "{$dbms}:host={$host}";

        try {
            return new PDO($dsn, $user, $pass);
        } 
        catch (PDOException $e) {
            die("Database Connection failed: " . $e->getMessage());
        }
    }//buildConnect()

    public static function up() {
        $DB = self::buildConnect(DBMS, DB_HOST, DB_USER, DB_PASS);
        $DB->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME);

    }//up()

    public static function down(){
        $DB = self::buildConnect(DBMS, DB_HOST, DB_USER, DB_PASS);
        $DB->query("DROP DATABASE IF EXISTS " . DB_NAME);

    }//down()

}//class CreateDatabase