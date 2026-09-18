<?php 
// create function that handles user feedback
function dashboardFeedback(string $message): never
{
    echo '<p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>';
    exit;
}

// fill in the KPI's
try {
    // cross check database to see if queried KPIs
    $stmt = $pdo->prepare('SELECT username, password, role FROM users WHERE id = :user_id LIMIT 1');
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('KPI query failed. Please try again later.');
    exit;
}

try {
    // Count total admins
    $AdminCountStmt = $pdo->prepare('SELECT COUNT(user_id) FROM user_logs INNER JOIN users ON user_logs.id = users.id WHERE users.role = "Admin"');
    $AdminCountStmt->execute();
    $getTotalAdmins = $AdminCountStmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('KPI query failed. Please try again later.');
    exit;
}

try {
    // Count inactive admins
    $AdminStatusStmt = $pdo->prepare('SELECT COUNT(user_id) FROM user_logs INNER JOIN users ON user_logs.id = users.id WHERE users.role = "Admin" AND status = "Offline"');
    $AdminStatusStmt->execute();
    $getTotalInactiveAdmins = $AdminStatusStmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Inactive Admins KPI query failed. Please try again later.');
    exit;
}

try {
    // Count active admins
    $AdminStatusStmt = $pdo->prepare('SELECT COUNT(user_id) FROM user_logs INNER JOIN users ON user_logs.id = users.id WHERE users.role = "Admin" AND status = "Online"');
    $AdminStatusStmt->execute();
    $getTotalActiveAdmins = $AdminStatusStmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Active Admins KPI query failed. Please try again later.');
    exit;
}

try {
    // Count accountants
    $AdminStatusStmt = $pdo->prepare('SELECT COUNT(id) FROM users WHERE role = "Accountant"');
    $AdminStatusStmt->execute();
    $getTotalAccountants = $AdminStatusStmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Accountants KPI query failed. Please try again later...');
    exit;
}

try {
    // Count operators
    $AdminStatusStmt = $pdo->prepare('SELECT COUNT(id) FROM users WHERE role = "Operator"');
    $AdminStatusStmt->execute();
    $getTotalActiveOperators = $AdminStatusStmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Operators KPI query failed. Please try again later...');
    exit;
}

try {
    // Count all managers
    $AdminStatusStmt = $pdo->prepare('SELECT COUNT(id) FROM users WHERE role != "Admin"');
    $AdminStatusStmt->execute();
    $getTotalManagers = $AdminStatusStmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    dashboardFeedback('Active Admins KPI query failed. Please try again later.');
    exit;
}

?>