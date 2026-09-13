<?php
    session_start();
    session_destroy();
    require_once 'connection.php';

    try {
        // log the user exit
        $insertStmt = $pdo->prepare('INSERT INTO user_logs (user_id, status) VALUES (:user_id, "Offline")');
        $insertStmt->execute(['user_id' => $_SESSION['user_id']]);
    } catch (PDOException $e) {
        error_log($e->getMessage());
        Feedback('Logout failed. Please try again later.');
        exit;
    }

    header('Location: ../index.php');
    exit;
?>