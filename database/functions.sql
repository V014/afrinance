-- check user logs
SELECT l.user_id, l.action, u.role, u.username FROM users u
INNER JOIN user_logs l ON u.id = l.user_id

-- count total admins
SELECT COUNT(user_id) FROM user_logs 
INNER JOIN users ON user_logs.id = users.id
WHERE users.role != 'operator';