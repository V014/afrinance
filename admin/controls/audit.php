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
    $stmt = $pdo->prepare('SELECT COUNT(id) AS total FROM user_logs');
    $stmt->execute();
    $getTotalEvents = $stmt->fetch();

}   catch(PDOException $e){
    error_log($e->getMessage());
    userLog($pdo,"Read","System", "Failed to query all events: " . $e->getMessage(), "Failure");
    dashboardFeedback('Failed to query all events. Please try again later.');
    exit;
}

try {
    // count total events from today
    $stmt = $pdo->prepare('SELECT COUNT(id) AS total FROM user_logs WHERE DATE(created_at) = CURDATE()');
    $stmt->execute();
    $getTodaysEvents = $stmt->fetch();

}   catch(PDOException $e){
    error_log($e->getMessage());
    userLog($pdo,"Read","System", "Failed to query todays events: " . $e->getMessage(), "Failure");
    dashboardFeedback('Failed to query todays events. Please try again later.');
    exit;
}

try {
    // count total creates
    $stmt = $pdo->prepare('SELECT COUNT(id) AS total FROM user_logs WHERE action="Create"');
    $stmt->execute();
    $getTotalCreates = $stmt->fetch();

}   catch(PDOException $e){
    error_log($e->getMessage());
    userLog($pdo,"Read","System", "Failed to query total creates: " . $e->getMessage(), "Failure");
    dashboardFeedback('Failed to query total create. Please try again later.');
    exit;
}

try {
    // count total updated
    $stmt = $pdo->prepare('SELECT COUNT(id) AS total FROM user_logs WHERE action="Update"');
    $stmt->execute();
    $getTotalUpdates = $stmt->fetch();

}   catch(PDOException $e){
    error_log($e->getMessage());
    userLog($pdo,"Read","System", "Failed to query total updates: " . $e->getMessage(), "Failure");
    dashboardFeedback('Failed to query total updates. Please try again later.');
    exit;
}

try {
    // count total deletes
    $stmt = $pdo->prepare('SELECT COUNT(id) AS total FROM user_logs WHERE action="Delete"');
    $stmt->execute();
    $getTotalDeletes = $stmt->fetch();

}   catch(PDOException $e){
    error_log($e->getMessage());
    userLog($pdo,"Read","System", "Failed to query total deletes: " . $e->getMessage(), "Failure");
    dashboardFeedback('Failed to query total deletes. Please try again later.');
    exit;
}

// read table data
try {
    // show logs table
    $Stmt = $pdo->prepare('SELECT l.id, u.username, l.action, l.target, l.details, l.status, l.created_at 
                            FROM user_logs l LEFT JOIN users u ON l.user_id = u.id');
    $Stmt->execute();
    $getUserLogs = $Stmt->fetchAll();

} catch(PDOException $e) {
    error_log($e->getMessage());
    userLog($pdo,"Read","System", "Failed to query user logs table: " . $e->getMessage(), "Failure");
    dashboardFeedback('Failed to show users. Please try again later.');
    exit;
}
?>