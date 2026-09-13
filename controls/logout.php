<?php
    session_start();
    require_once 'connection.php';

    // create function that handles user feedback
    function logoutFeedback(string $message): never
    {
        echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
        exit;
    }

    try {
        // log the user exit
        $insertStmt = $pdo->prepare('INSERT INTO user_logs (user_id, action) VALUES (:user_id, "Logout")');
        $insertStmt->execute(['user_id' => $_SESSION['user_id']]);

        // update user status
        $updateStmt = $pdo->prepare('UPDATE `users` SET `status` = "Offline" WHERE `users`.`id` = :user_id');
        $updateStmt->execute(['user_id' => $_SESSION['user_id']]);

    } catch (PDOException $e) {
        error_log($e->getMessage());
        // logoutFeedback('Logout failed. Please try again later.');
        exit;
    }

    session_destroy();
    header('Location: ../index.php');
    exit;
?>