<?php

namespace app\core;

use PDO;
use PDOException;

class Model {
    protected $pdo;
    protected $table;

    public function __construct() {
        // Load environment variables (already done in setup.php, so no need to require it here)
        
        // Use constants directly instead of $_ENV
        $dbHost = DBHOST;
        $dbName = DBNAME;
        $dbUser = DBUSER;
        $dbPassword = DBPASS;

        // Set up the PDO connection with error handling
        try {
            $this->pdo = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPassword);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function selectAll() {
        try {
            // Ensure we're querying the correct table
            $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching records: " . $e->getMessage());
        }
    }

    public function insert($data) {
        $fields = implode(',', array_keys($data));
        $placeholders = ':' . implode(',:', array_keys($data));
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})");
        return $stmt->execute($data);
    }
}


