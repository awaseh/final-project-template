<?php

namespace app\controllers; // Declare namespace for this controller

use app\models\User; // Import the User model

class UserController {

    // Serve the usersView HTML file
    public function usersView() {
        $filePath = __DIR__ . '/../../public/assets/views/users/usersView.html';
        if (file_exists($filePath)) {
            readfile($filePath);
        } else {
            echo "Error: File not found at $filePath";
        }
        exit();
    }

    // Get all users from the database
    public function getUsers() {
        $user = new User();
        $users = $user->selectAll(); // this method exists in the User model
        
        // Debugging: Log the fetched users
        error_log("Fetched users: " . print_r($users, true));

        // Send the users data as a JSON response
        header('Content-Type: application/json');
        echo json_encode($users);
        exit();
    }

    // Save a new user to the database
    public function saveUser() {
        $user = new User();
        $data = json_decode(file_get_contents('php://input'), true); // Get raw POST data

        // Log the input data for debugging purposes
        error_log("Save user input: " . print_r($data, true));

        // Validate input: name and email are provided
        if (!isset($data['name']) || !isset($data['email'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Name and email are required.']);
            exit();
        }

        // Insert the user into the database
        $result = $user->insert($data); // insert method exists in the User model
        if ($result) {
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Failed to save user.']);
        }
        exit();
    }

    // Delete a user by ID
    public function deleteUser() {
        $user = new User();
        $data = json_decode(file_get_contents('php://input'), true); // Get raw POST data

        // Log the input data for debugging purposes
        error_log("Delete user input: " . print_r($data, true));

        // Validate input: user ID is provided
        if (!isset($data['id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'User ID is required.']);
            exit();
        }

        // Delete the user from the database
        $result = $user->deleteUserById($data['id']); // this method exists in the User model
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
