<?php
declare(strict_types=1);
// Get the requested URI and remove query parameters
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Get the script's directory name to remove from the path
$script_name = dirname($_SERVER['SCRIPT_NAME']);
if ($script_name !== '/') {
    $request_uri = substr($request_uri, strlen($script_name));
}

// Remove leading slash and any remaining path components
$request_uri = trim($request_uri, '/');

// If empty, default to home
if (empty($request_uri)) {
    $request_uri = 'home';
}

// Define available routes
$routes = [
    'home' => 'public/controller/home.php',
    'about' => 'public/controller/about-us.php',
    'contact' => 'public/controller/contact-us.php',
    'product' => 'public/model/product.php',
];

// Check if the route exists
if (array_key_exists($request_uri, $routes)) {
    $file_path = __DIR__ . '/' . $routes[$request_uri];
    
    // Check if the file exists
    if (file_exists($file_path)) {
        require($file_path);
    } else {
        // File not found, show 404
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        echo "<p>The requested file does not exist.</p>";
    }
} else {
    // Route not found, show 404
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
    echo "<p>The requested page does not exist.</p>";
}
