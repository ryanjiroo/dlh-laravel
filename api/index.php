<?php

// Load .env.production for Vercel deployment
$envProdFile = __DIR__ . '/../.env.production';
if (file_exists($envProdFile)) {
    $lines = file($envProdFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

// Load environment variables from Vercel env vars
require_once __DIR__ . '/env-loader.php';

// This file is the entry point for Vercel's PHP runtime
// It handles all requests and routes them to Laravel's public/index.php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If the requested resource is a file or directory, let it through
if ($uri !== '/' && file_exists(__DIR__ . '/../public' . $uri)) {
    return false;
}

// If the request is not for a static file, route to Laravel
require __DIR__ . '/../public/index.php';
