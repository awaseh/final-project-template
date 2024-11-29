<?php

namespace app\models;

use app\core\Model;

class User extends Model {
    protected $table = 'users';

    public function getAllUsers() {
        return $this->selectAll();
    }

    public function insertUser($data) {
        return $this->insert($data);
    }

    public function deleteUserById($id) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
