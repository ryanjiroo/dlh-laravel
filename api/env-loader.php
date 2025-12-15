<?php
/**
 * Vercel Environment Loader
 * Loads environment variables from vercel.json to application
 */

$envFile = __DIR__ . '/../.env';

// If .env doesn't exist in production, create it from env vars
if (!file_exists($envFile)) {
    $env = "APP_NAME=" . getenv('APP_NAME') . "\n";
    $env .= "APP_ENV=" . getenv('APP_ENV') . "\n";
    $env .= "APP_KEY=" . getenv('APP_KEY') . "\n";
    $env .= "APP_DEBUG=" . getenv('APP_DEBUG') . "\n";
    $env .= "APP_URL=" . getenv('APP_URL') . "\n";
    $env .= "APP_CONFIG_CACHE=" . getenv('APP_CONFIG_CACHE') . "\n";
    $env .= "APP_EVENTS_CACHE=" . getenv('APP_EVENTS_CACHE') . "\n";
    $env .= "APP_PACKAGES_CACHE=" . getenv('APP_PACKAGES_CACHE') . "\n";
    $env .= "APP_ROUTES_CACHE=" . getenv('APP_ROUTES_CACHE') . "\n";
    $env .= "APP_SERVICES_CACHE=" . getenv('APP_SERVICES_CACHE') . "\n";
    $env .= "VIEW_COMPILED_PATH=" . getenv('VIEW_COMPILED_PATH') . "\n";
    $env .= "CACHE_DRIVER=" . getenv('CACHE_DRIVER') . "\n";
    $env .= "LOG_CHANNEL=" . getenv('LOG_CHANNEL') . "\n";
    $env .= "SESSION_DRIVER=" . getenv('SESSION_DRIVER') . "\n";
    $env .= "DB_CONNECTION=" . getenv('DB_CONNECTION') . "\n";
    $env .= "DB_HOST=" . getenv('DB_HOST') . "\n";
    $env .= "DB_PORT=" . getenv('DB_PORT') . "\n";
    $env .= "DB_DATABASE=" . getenv('DB_DATABASE') . "\n";
    $env .= "DB_USERNAME=" . getenv('DB_USERNAME') . "\n";
    $env .= "DB_PASSWORD=" . getenv('DB_PASSWORD') . "\n";
    $env .= "DB_SSLMODE=" . getenv('DB_SSLMODE') . "\n";
    
    @file_put_contents($envFile, $env);
}
