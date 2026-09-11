<?php
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
    $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username && role = :role LIMIT 1');
    $stmt->execute(['username' => $username, 'role' => $role]);

    if ($stmt->fetch()) {
        setupFeedback('Username already registered.');
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $insertStmt = $pdo->prepare('
        INSERT INTO users (username, role, password, created_at)
        VALUES (:username, :role, :password, NOW())
    ');
    $insertStmt->execute([
        'username' => $username,
        'role' => $role,
        'password' => $passwordHash,
    ]);
} catch (PDOException $e) {
    error_log($e->getMessage());
    setupFeedback('Account creation failed. Please check the database setup and try again.');
}

header('HX-Redirect: index.php');
setupFeedback('Now try to login.');
exit;
?>