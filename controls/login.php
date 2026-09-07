<?php
// login.php
session_start();
require_once 'connection.php'; // Includes your PDO connection script ($pdo)

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitize and collect user inputs
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // 2. Validate basic inputs
    if (empty($username) || empty($password)) {
        $errors[] = 'Please fill in both username and password.';
    } else {
        // 3. Query the user by username using a prepared statement
        $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE username = :user LIMIT 1');
        $stmt->execute(['user' => $username]);
        $user = $stmt->fetch();

        // 4. Verify user exists and check password hash
        if ($user && password_verify($password, $user['password'])) {
            // Prevent Session Fixation attacks
            session_regenerate_id(true);

            // Store user metadata in session
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to dashboard or home page
            header('Location: dashboard.php');
            exit;
        } else {
            // Generic error message to prevent account enumeration
            $errors[] = 'Invalid login credentials.';
        }
    }
}
?>