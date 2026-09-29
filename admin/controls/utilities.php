<?php
// Utility functions for the admin dashboard
// Log the error to the user_errors table
function logError($pdo, $errorMessage) {
    try {
        $insertStmt = $pdo->prepare('
            INSERT INTO user_errors (user_id, error_message, created_at)
            VALUES (:user_id, :error_message, NOW())
        ');
        $insertStmt->execute([
            'user_id' => NULL,
            'error_message' => $errorMessage,
        ]);
    } catch (PDOException $e) {
        error_log("Failed to log error: " . $e->getMessage());
    }
}
?>