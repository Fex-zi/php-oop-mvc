
<?php 

use models\admin\Auth;

$check = new Auth();

if($check->isAdmin()){
    // User is already logged in as admin - show admin dashboard or redirect
    echo '<h1>Admin Dashboard</h1>';
    echo '<p>Welcome, Admin!</p>';
    echo '<a href="admin?action=logout">Logout</a>';
} else {
    // User is not admin - show login form
    $check->showLogin();
}

?>
