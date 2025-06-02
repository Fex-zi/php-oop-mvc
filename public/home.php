<?php
declare(strict_types=1);

// Security: Start session securely
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => isset($_SERVER['HTTPS']),
    'cookie_samesite' => 'Strict'
]);

// CSRF Protection
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// For forms - validate CSRF for POST requests
$action = $_GET['action'] ?? $_POST['action'] ?? 'show';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $token)) {
        http_response_code(403);
        die('CSRF token mismatch');
    }
}

// Load classes with proper security
spl_autoload_register(function (string $class): void {
    // Sanitize class name to prevent path traversal
    $class = preg_replace('/[^a-zA-Z0-9\\\\]/', '', $class);
    $file = __DIR__ . '/../src/' . str_replace('\\', '/', $class) . '.php';
    
    // Ensure the file is within allowed directory
    $realFile = realpath($file);
    $basePath = realpath(__DIR__ . '/../src/');
    
    if ($realFile && $basePath && strpos($realFile, $basePath) === 0 && file_exists($realFile)) {
        require $realFile;
    }
});

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

// Sanitize route input to prevent path traversal
$request_uri = preg_replace('/[^a-zA-Z0-9\-_]/', '', $request_uri);

// Define available routes with absolute paths
$routes = [
    'home' => __DIR__ . '/../src/controller/home.php',
    'about' => __DIR__ . '/../src/controller/about-us.php',
    'contact' => __DIR__ . '/../src/controller/contact-us.php',
    'product' => __DIR__ . '/../src/model/Product.php',
];

// Check if the route exists and is safe
if (array_key_exists($request_uri, $routes)) {
    $file_path = $routes[$request_uri];
    
    // Double-check the file exists and is within allowed directory
    $realPath = realpath($file_path);
    $allowedPath = realpath(__DIR__ . '/../src/');
    
    if ($realPath && $allowedPath && strpos($realPath, $allowedPath) === 0 && file_exists($realPath)) {
        require($realPath);
    } else {
        // File not found or outside allowed directory, show 404
        http_response_code(404);
        require(__DIR__ . '/../src/view/status-pages/404.php');
    }
} else {
    // Route not found, show 404
    http_response_code(404);
    require(__DIR__ . '/../src/view/status-pages/404.php');
}
