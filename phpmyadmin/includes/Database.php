<?php
/**
 * Database Connection Handler
 * Manages PDO connection and provides singleton access
 */

class Database {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        require_once __DIR__ . '/../config.php';
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST, 
                DB_USER, 
                DB_PASS
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("SET NAMES '" . DB_CHARSET . "'");
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->conn;
    }
    
    public function useDatabase($database) {
        $this->conn->exec("USE `$database`");
    }
}
