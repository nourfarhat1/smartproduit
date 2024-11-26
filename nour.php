<?php
class Nour {
    private static $pdo = null;

    // Method to get a PDO connection
    public static function getConnexion() {
        if (!isset(self::$pdo)) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "smartfarm1";

            try {
                // Establish the PDO connection
                self::$pdo = new PDO(
                    "mysql:host=$servername;dbname=$dbname;charset=utf8",
                    $username,
                    $password
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                echo "PDO Connected successfully<br>";
            } catch (PDOException $e) {
                die('PDO Connection failed: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>
