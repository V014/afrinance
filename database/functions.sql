-- check user logs
SELECT l.user_id, l.action, u.role, u.username FROM users u
INNER JOIN user_logs l ON u.id = l.user_id