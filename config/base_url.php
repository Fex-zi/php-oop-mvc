<?php

/**
 * Simple Base URL Detection for MVC Framework
 * Works on both localhost and live servers
 */

class BaseUrl {
    
    /**
     * Get the base URL automatically
     * @return string The base URL
     */
    public static function get() {
        // Detect if we're using HTTPS
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') 
                    || $_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://';
        
        // Get the host
        $host = $_SERVER['HTTP_HOST'];
        
        // Get the script directory path
        $scriptPath = dirname($_SERVER['SCRIPT_NAME']);
        
        // Remove /src from the path if it exists (for MVC structure)
        $scriptPath = str_replace('/src', '', $scriptPath);
        $scriptPath = str_replace('\\src', '', $scriptPath); // Windows compatibility
        
        // Clean up the path
        $scriptPath = rtrim($scriptPath, '/\\');
        
        // Build the base URL
        $baseUrl = $protocol . $host . $scriptPath;
        
        return $baseUrl;
    }
    
    /**
     * Get base URL with trailing slash
     * @return string
     */
    public static function getWithSlash() {
        return rtrim(self::get(), '/') . '/';
    }
    
    /**
     * Get the public URL (for assets like CSS, JS, images)
     * @return string
     */
    public static function getPublic() {
        return self::getWithSlash() . 'src/';
    }
    
    /**
     * Generate URL for a route
     * @param string $route
     * @return string
     */
    public static function route($route = '') {
        $route = ltrim($route, '/');
        return self::getWithSlash() . $route;
    }
    
    /**
     * Generate URL for assets (CSS, JS, images)
     * @param string $asset
     * @return string
     */
    public static function asset($asset = '') {
        $asset = ltrim($asset, '/');
        return self::getPublic() . $asset;
    }
}

// Define constants for easy access
define('BASE_URL', BaseUrl::get());
define('BASE_URL_SLASH', BaseUrl::getWithSlash());
define('PUBLIC_URL', BaseUrl::getPublic());

// Helper functions for convenience
function base_url($route = '') {
    return BaseUrl::route($route);
}

function asset_url($asset = '') {
    return BaseUrl::asset($asset);
}

function public_url() {
    return PUBLIC_URL;
}

?>
