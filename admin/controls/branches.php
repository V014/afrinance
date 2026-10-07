<?php
// [fill in the KPI's]
try {
    // cross check to make sure admin is still logged in
    $stmt = $pdo->prepare('SELECT username, password, role FROM users WHERE id = :user_id AND status = "Active" LIMIT 1');
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

}   catch(PDOException $e){
    error_log($e->getMessage());
    logError($pdo, "Failed to query admin activity: " . $e->getMessage());
    dashboardFeedback('Failed to query admin activity. Please try again later.');
    exit;
}

try {
    // Count total branches
    $Stmt = $pdo->prepare('SELECT COUNT(id) AS total FROM branch');
    $Stmt->execute();
    $getTotalBranches = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    logError($pdo, "Failed to count total branches: " . $e->getMessage());
    dashboardFeedback('Failed to count total branches. Please try again later.');
    exit;
}

try {
    // Count total active branches
    $Stmt = $pdo->prepare('SELECT COUNT(id) AS total FROM branch WHERE status = "Active"');
    $Stmt->execute();
    $getTotalActiveBranches = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    logError($pdo, "Failed to count total active branches: " . $e->getMessage());
    dashboardFeedback('Failed to count total active branches. Please try again later.');
    exit;
}

try {
    // Count total inactive branches
    $Stmt = $pdo->prepare('SELECT COUNT(id) AS total FROM branch WHERE status = "inactive"');
    $Stmt->execute();
    $getTotalInactiveBranches = $Stmt->fetch();
    
}   catch(PDOException $e){
    error_log($e->getMessage());
    logError($pdo, "Failed to count total inactive branches: " . $e->getMessage());
    dashboardFeedback('Failed to count total inactive branches. Please try again later.');
    exit;
}

try {
    // show branches table
    $Stmt = $pdo->prepare('SELECT id, name, description, location, status, created_at, updated_at FROM branch;');
    $Stmt->execute();
    $getBranches = $Stmt->fetchAll();

} catch(PDOException $e) {
    error_log($e->getMessage());
    logError($pdo, "Failed to show branches: " . $e->getMessage());
    dashboardFeedback('Failed to show branches. Please try again later.');
    exit;
}
?>