<?php

namespace app\models;

use app\core\Model;

class User extends Model {
    protected $table = 'users';

    // Get all users
    public function getAllUsers() {
        try {
            return $this->selectAll(); // Use the inherited selectAll method
        } catch (\Exception $e) {
            // Handle potential errors (e.g., database errors)
            error_log("Error fetching users: " . $e->getMessage());
            return false;
        }
    }

    // Insert a new user into the database
    public function insertUser($data) {
        try {
            return $this->insert($data); // Use the inherited insert method
        } catch (\Exception $e) {
            // Handle errors (e.g., database errors)
            error_log("Error inserting user: " . $e->getMessage());
            return false;
        }
    }

    // Delete a user by their ID
    public function deleteUserById($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
            return $stmt->execute(['id' => $id]);
        } catch (\Exception $e) {
            // Handle errors (e.g., database errors)
            error_log("Error deleting user with ID {$id}: " . $e->getMessage());
            return false;
        }
    }
}
