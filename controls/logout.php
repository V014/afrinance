<?php
    session_start();
    require_once 'connection.php';
    require_once 'utilities.php';

    // create function that handles user feedback
    function logoutFeedback(string $message): never
    {
        echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
        exit;
    }

    try {
        // log the user exit
        userLog($pdo, 'Logout', 'System', 'User logged out', 'Success');

        // update user status
        $updateStmt = $pdo->prepare('UPDATE `users` SET `status` = "Inactive" WHERE `users`.`id` = :user_id');
        $updateStmt->execute(['user_id' => $_SESSION['user_id']]);

    } catch (PDOException $e) {
        error_log($e->getMessage());
        alert('Logout failed. Please try again later.');
        exit;
    }

    session_destroy();
    header('Location: ../index.php');
    exit;
?>