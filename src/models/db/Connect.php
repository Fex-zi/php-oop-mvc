<?php 
declare(strict_types=1);

namespace models\db;

use PDO;
use PDOException;

class Connect {
   

    // Constructor - connects automatically when object is created
    public function __construct(protected ?PDO $pdo = null) {
        try {
            $host = 'localhost';
            $dbname = 'ifeanyi';
            $username = 'root';
            $password = '';
            $charset = 'utf8mb4';
            
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $this->pdo = new PDO($dsn, $username, $password, $options);
            
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection failed. Please try again later.");
        }
    }

    // Getter method to access PDO connection
    public function getConnection(): ?PDO {
        return $this->pdo;
    }
}
