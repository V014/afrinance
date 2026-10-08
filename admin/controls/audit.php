<?php
// Include utilities page
include_once '../controls/utilities.php';
// create function that handles user feedback
function dashboardFeedback(string $message): never
{
    echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    exit;
}
// [fill in the KPI's]
try {
    // count total events
    $stmt = $pdo->prepare('SELECT COUNT(id) FROM user_logs');
    $stmt->execute();
    $getTotalEvents = $stmt->fetch();

}   catch(PDOException $e){
    error_log($e->getMessage());
    logError($pdo, "Failed to query all events: " . $e->getMessage());
    dashboardFeedback('Failed to query all events. Please try again later.');
    exit;
}
?>