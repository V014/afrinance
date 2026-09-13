<?php 
// start a session and connect to the database
session_start();
require_once '../../controls/connection.php';

// create function that handles user feedback
function dashboardFeedback(string $message): never
{
    echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    exit;
}

// fill in the KPI's
try {
    // cross check database to see if queried KPIs
    $stmt = $pdo->prepare('SELECT username, password, role FROM users WHERE username = :user LIMIT 1');
    $stmt->execute(['user' => $username]);
    $user = $stmt->fetch();
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('KPI query failed. Please try again later.');
    exit;
}
?>