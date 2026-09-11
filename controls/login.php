<?php
session_start();
require_once 'connection.php';

function loginError(string $message): never
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

if ($username === '' || $password === '') {
    loginError('Please fill in both username and password.');
}

$stmt = $pdo->prepare('SELECT id, username, password, role FROM users WHERE username = :user LIMIT 1');
$stmt->execute(['user' => $username]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    loginError('Invalid login credentials.');
}

session_regenerate_id(true);
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

$dashboard = match ($user['role']) {
    'Admin' => 'admin/dashboard.php',
    'Accountant' => 'accountant/dashboard.php',
    'Operator' => 'employee/dashboard.php',
    default => 'index.php',
};

header('HX-Redirect: ' . $dashboard);
exit;
?>