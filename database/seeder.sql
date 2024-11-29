-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS finalproject3300;
USE finalproject3300;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Clear existing data if any
TRUNCATE TABLE users;

-- Insert sample users
INSERT INTO users (name, email) VALUES
    ('Mike Thompson', 'mikethompson89@gmail.com'),
    ('Sarah Martinez', 'smartinez@yahoo.com'),
    ('Chris Parker', 'parkerc@hotmail.com'),
    ('Rachel Chen', 'rachelc2024@gmail.com'),
    ('Kevin O''Connor', 'koconnor@outlook.com');