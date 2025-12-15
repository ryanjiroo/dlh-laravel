<?php

// This file is the entry point for Vercel's PHP runtime
// It handles all requests and routes them to Laravel's public/index.php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If the requested resource is a file or directory, let it through
if ($uri !== '/' && file_exists(__DIR__ . '/../public' . $uri)) {
    return false;
}

// If the request is not for a static file, route to Laravel
require __DIR__ . '/../public/index.php';
