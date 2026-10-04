<?php
session_start();
require_once 'connection.php';

function setupFeedback(string $message): never
{
    echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';
$allowedRoles = ['Admin', 'Accountant', 'Operator'];

if ($username === '' || $password === '' || $confirm === '' || $role === '') {
    setupFeedback('All fields are required.');
}

if (!in_array($role, $allowedRoles, true)) {
    setupFeedback('Please select a valid role.');
}

if (strlen($password) < 8) {
    setupFeedback('Password must be at least 8 characters long.');
}

if ($password !== $confirm) {
    setupFeedback('Passwords do not match.');
}

try {
    $userCount = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    if ($userCount > 0) {
        setupFeedback('Initial setup is already complete. Please log in.');
    }

    // check if the username already exists for the given role
    $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username AND role = :role LIMIT 1');
    $stmt->execute(['username' => $username, 'role' => $role]);

    if ($stmt->fetch()) {
        setupFeedback('Username already registered.');
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $insertStmt = $pdo->prepare('
        INSERT INTO users (username, role, password, status, created_at)
        VALUES (:username, :role, :password, :status, NOW())
    ');

    $insertStmt->execute([
        'username' => $username,
        'role' => $role,
        'password' => $passwordHash,
        'status' => "Active",
    ]);

    // Login the user after successful registration
    $userId = $pdo->lastInsertId();

    // log the user entry
    $insertStmt = $pdo->prepare('INSERT INTO user_logs (user_id, status) VALUES (:user_id, "Active")');
    $insertStmt->execute(['user_id' => $userId]);

    // refill sessions of already active
    session_regenerate_id(true);
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;

    // route user to correct dashboard
    $dashboard = match ($role) {
        'Admin' => 'admin/dashboard.php',
        'Accountant' => 'accountant/dashboard.php',
        'Operator' => 'employee/dashboard.php',
        default => 'index.php',
    };
} catch (PDOException $e) {
    error_log($e->getMessage());
    // Log the error to the user_errors table
    try{
        $insertStmt = $pdo->prepare('
        INSERT INTO user_errors (user_id, error_message, created_at)
        VALUES (:user_id, :error_message, NOW())
        ');
        $insertStmt->execute([
            'user_id' => NULL,
            'error_message' => "Setup Error: " . $e->getMessage(),
        ]);
    } catch (PDOException $er) {
        setupFeedback('Account creation failed and error logging failed. Please check the database setup and try again.' . $e->getMessage());
    }
    setupFeedback('Account creation failed. Please check the database setup and try again.');
}

header('HX-Redirect: ' . $dashboard);
exit;
?>