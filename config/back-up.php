<?php
// Front Controller for MVC Framework
// Include the base URL configuration
require_once __DIR__ . '/../config/base_url.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="<?php echo asset_url('public/css/style.css'); ?>">
</head>
<body>
    <div class="container">
        <h1 class="header">🚀 MVC Framework - Front Controller <span class="badge">Working!</span></h1>
        <p>Welcome! This is your <strong>public/index.php</strong> front controller.</p>
        
        <div class="url-info">
            <h3>📍 Current URL Information:</h3>
            <p><strong>Base URL:</strong> <code><?php echo BASE_URL; ?></code></p>
            <p><strong>Public URL:</strong> <code><?php echo PUBLIC_URL; ?></code></p>
            <p><strong>Current Page:</strong> <code><?php echo base_url(); ?></code></p>
            <p><strong>CSS Asset URL:</strong> <code><?php echo asset_url('css/style.css'); ?></code></p>
        </div>
        
        <div class="nav">
            <h3>🔗 Navigation Examples:</h3>
            <a href="<?php echo base_url(); ?>">🏠 Home</a>
            <a href="<?php echo base_url('/about-us'); ?>">📖 About</a>
            <a href="<?php echo base_url('contact'); ?>">📧 Contact</a>
            <a href="<?php echo base_url('user/profile'); ?>">👤 User Profile</a>
        </div>
        
        <div>
            <h3>⚙️ How It Works:</h3>
            <ol>
                <li>All requests go through <code>public/index.php</code> (this file)</li>
                <li>URLs are automatically generated for both localhost and live servers</li>
                <li>Clean URLs work without <code>.php</code> extensions</li>
                <li>Assets (CSS, JS, images) are served from the <code>public/</code> folder</li>
                <li>CSS is loaded using <code>asset_url('css/style.css')</code></li>
            </ol>
        </div>
        
        <div>
            <h3>🎯 Next Steps for Your MVC:</h3>
            <ul>
                <li>✅ Base URL detection (working on localhost and live servers)</li>
                <li>✅ Asset URL generation (CSS loaded successfully)</li>
                <li>🔲 Add routing logic to handle different URLs</li>
                <li>🔲 Create controllers in an <code>app/controllers/</code> folder</li>
                <li>🔲 Create views in an <code>app/views/</code> folder</li>
                <li>🔲 Add more CSS/JS assets in <code>public/css/</code> and <code>public/js/</code></li>
            </ul>
        </div>
        
        <div class="url-info">
            <h3>🧪 Test Your URLs:</h3>
            <p>Try these URLs to test the routing:</p>
            <ul>
                <li><a href="<?php echo base_url(); ?>"><?php echo base_url(); ?></a></li>
                <li><a href="<?php echo base_url('about'); ?>"><?php echo base_url('about'); ?></a></li>
                <li><a href="<?php echo base_url('api/users'); ?>"><?php echo base_url('api/users'); ?></a></li>
            </ul>
        </div>
    </div>
</body>
</html>
