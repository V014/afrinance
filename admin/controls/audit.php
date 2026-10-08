<?php
// [fill in the KPI's]
try {
    // count total events
    $stmt = $pdo->prepare('SELECT username, password, role FROM users WHERE id = :user_id AND status = "Active" LIMIT 1');
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

}   catch(PDOException $e){
    error_log($e->getMessage());
    logError($pdo, "Failed to query admin activity: " . $e->getMessage());
    dashboardFeedback('Failed to query admin activity. Please try again later.');
    exit;
}
?>