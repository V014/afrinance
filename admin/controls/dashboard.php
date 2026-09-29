<?php 
include_once 'utilities.php';
// create function that handles user feedback
function dashboardFeedback(string $message): never
{
    echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    exit;
}

// [fill in the KPI's]
try {
    // cross check database to see if queried KPIs are functional
    $stmt = $pdo->prepare('SELECT username, password, role FROM users WHERE id = :user_id LIMIT 1');
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Failed to query KPIs. Please try again later.');
    exit;
}

try {
    // Count total admins
    $Stmt = $pdo->prepare('SELECT COUNT(user_id) AS total FROM user_logs INNER JOIN users ON user_logs.id = users.id WHERE users.role = "Admin"');
    $Stmt->execute();
    $getTotalAdmins = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Failed to count total admins. Please try again later.');
    exit;
}

try {
    // Count inactive admins
    $Stmt = $pdo->prepare('SELECT COUNT(user_id) AS total FROM user_logs ul INNER JOIN users u ON ul.user_id = u.id WHERE u.role = "Admin" AND u.status = "Offline"');
    $Stmt->execute();
    $getTotalInactiveAdmins = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    logError($pdo, "Failed to count inactive admins: " . $e->getMessage());
    dashboardFeedback('Failed to count inactive admins. Please try again later.');
    exit;
}

try {
    // Count active admins
    $Stmt = $pdo->prepare('SELECT COUNT(user_id) AS total FROM user_logs ul INNER JOIN users u ON ul.user_id = u.id WHERE u.role = "Admin" AND u.status = "Online"');
    $Stmt->execute();
    $getTotalActiveAdmins = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    logError($pdo, "Failed to count active admins: " . $e->getMessage());
    dashboardFeedback('Failed to count active admins. Please try again later.');
    exit;
}

try {
    // Count accountants
    $Stmt = $pdo->prepare('SELECT COUNT(id) FROM users WHERE role = "Accountant"');
    $Stmt->execute();
    $getTotalAccountants = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Failed to count accountants. Please try again later...');
    exit;
}

try {
    // Count operators
    $Stmt = $pdo->prepare('SELECT COUNT(id) FROM users WHERE role = "Operator"');
    $Stmt->execute();
    $getTotalActiveOperators = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Failed to count operators. Please try again later...');
    exit;
}

try {
    // Count all managers
    $Stmt = $pdo->prepare('SELECT COUNT(id) FROM users WHERE role != "Admin"');
    $Stmt->execute();
    $getTotalManagers = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Failed to count managers. Please try again later.');
    exit;
}

try {
    // Count admin activity in last 7 days
    $Stmt = $pdo->prepare('SELECT COUNT(user_id) FROM user_logs WHERE user_id = :user_id AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)');
    $Stmt->bindParam(':user_id', $_SESSION['user_id']);
    $Stmt->execute();
    $getActivityIn7Days = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Failed to count admin activity in last 7 days. Please try again later.');
    exit;
}

try {
    // Count admin activity in last 30 days
    $Stmt = $pdo->prepare('SELECT COUNT(user_id) FROM user_logs WHERE user_id = :user_id AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)');
    $Stmt->bindParam(':user_id', $_SESSION['user_id']);
    $Stmt->execute();
    $getActivityIn30Days = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Failed to count admin activity in last 30 days. Please try again later.');
    exit;
}

try {
    // show last login of admin
    $Stmt = $pdo->prepare('SELECT MAX(created_at) FROM user_logs WHERE user_id = :user_id');
    $Stmt->bindParam(':user_id', $_SESSION['user_id']);
    $Stmt->execute();
    $getLastLogin = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Failed to show last login of admin. Please try again later.');
    exit;
}

?>