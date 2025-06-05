<?php
session_start();

// Simple test interface for admin session
$action = $_GET['action'] ?? '';

switch($action) {
    case 'set-admin':
        $_SESSION['is_admin'] = true;
        echo '<h2>✅ Admin session SET</h2>';
        echo '<p>You are now logged in as admin</p>';
        break;
        
    case 'clear-admin':
        unset($_SESSION['is_admin']);
        echo '<h2>❌ Admin session CLEARED</h2>';
        echo '<p>You are now logged out</p>';
        break;
        
    default:
        echo '<h2>Admin Session Tester</h2>';
        echo '<p>Current admin status: ' . (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] ? 'ADMIN' : 'NOT ADMIN') . '</p>';
        break;
}

echo '<hr>';
echo '<a href="test-admin.php?action=set-admin">Set Admin Session</a> | ';
echo '<a href="test-admin.php?action=clear-admin">Clear Admin Session</a> | ';
echo '<a href="test-admin.php">Check Status</a><br><br>';
echo '<a href="admin">👉 Test Admin Page</a>';
?>
