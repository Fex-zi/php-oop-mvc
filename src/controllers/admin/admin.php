<?php 

use models\admin\Auth;

$auth = new Auth();

// Handle different actions
switch($action) {
    case 'logout':
        $result = $auth->logout();
        if($result['success']) {
            echo '<p>' . $result['message'] . '</p>';
            echo '<a href="admin">Return to Login</a>';
        }
        break;
        
    case 'login':
        $message = '';
        $messageType = '';
        
        if($_POST) {
            $result = $auth->loginAdmin();
            if($result['success']) {
                include __DIR__ .'/../../views/admin/profile.php';
                exit;
            } else {
                $message = $result['message'];
                $messageType = 'error';
            }
        }
        
        // Include login view with message variables
        include __DIR__ .'/../../views/admin/login.php';
        break;
        
    default:
        // Check if admin is already logged in
        if($auth->isAdmin()) {
            // Show admin dashboard
            include __DIR__ .'/../../views/admin/profile.php';
            
        } else {
            // Show login form with empty message variables
            $message = '';
            $messageType = '';
            include __DIR__ .'/../../views/admin/login.php';
        }
        break;
}
?>
