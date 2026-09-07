<?php
// register.php
session_start();
require_once 'connection.php'; // Includes your PDO connection script ($pdo)

$errors  = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitize and collect user inputs
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    // 2. Validate input fields
    if (empty($username) || empty($password) || empty($confirm)) {
        $errors[] = 'All fields are required.';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters long.';
    }

    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }

    // 3. If validation passes, check for existing user
    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username OR role = :role LIMIT 1');
        $stmt->execute([
            'username' => $username,
            'role'     => $role,
        ]);

        if ($stmt->fetch()) {
            $errors[] = 'Username or role is already registered.';
        } else {
            // 4. Hash the password securely
            // PASSWORD_DEFAULT uses the strongest available algorithm (currently bcrypt/Argon2id depending on PHP version)
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // 5. Insert new user using a prepared statement
            $insertStmt = $pdo->prepare('
                INSERT INTO users (username, role, password) 
                VALUES (:username, :role, :password)
            ');

            $created = $insertStmt->execute([
                'username' => $username,
                'role'     => $role,
                'password' => $passwordHash,
            ]);

            if ($created) {
                $success = 'Registration successful! You can now <a href="../index.php">log in</a>.';
            } else {
                $errors[] = 'An error occurred during registration. Please try again.';
            }
        }
    }
}
?>