<!--classe de conexão-->
<?php
require_once(__DIR__ . '/../config/config.php');
class Database {
    private static $connection;

    public static function getConnection() {
        if (self::$connection == null) {
            self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (self::$connection->connect_error) {
                die("Conexão falhou: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}
?>
