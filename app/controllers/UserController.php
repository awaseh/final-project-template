<?php

namespace app\controllers; // Declare namespace for this controller

use app\models\User; // Import the User model (if not already imported)

class UserController {

    public function usersView() {
        $filePath = __DIR__ . '/../../public/assets/views/users/usersView.html';
        if (file_exists($filePath)) {
            readfile($filePath);
        } else {
            echo "Error: File not found at $filePath";
        }
        exit();
    }

    public function getUsers() {
        $user = new User();
        $users = $user->getAllUsers();
    
        error_log("Fetched users: " . print_r($users, true)); // Debugging output
        header('Content-Type: application/json');
        echo json_encode($users);
        exit();
    }
    

    public function saveUser() {
        $user = new User();
        $data = json_decode(file_get_contents('php://input'), true);

        error_log("Save user input: " . print_r($data, true));

        if (!isset($data['name']) || !isset($data['email'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Name and email are required.']);
            exit();
        }

        $result = $user->insertUser($data);
        if ($result) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to save user.']);
        }
        exit();
    }

    public function deleteUser() {
        $user = new User();
        $data = json_decode(file_get_contents('php://input'), true);

        error_log("Delete user input: " . print_r($data, true));

        if (!isset($data['id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'User ID is required.']);
            exit();
        }

        $result = $user->deleteUserById($data['id']);
        if ($result) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
        }
        exit();
    }
}
