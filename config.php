<?php
/**
 * Central configuration for the application.
 */

date_default_timezone_set('UTC');
ini_set('display_errors', '0');
ini_set('log_errors', '1');
if (function_exists('header_remove')) {
    header_remove('X-Powered-By');
}

define('ACCESS_KEY', 'fair2026');

function getQueryString(string $key): string
{
    $value = $_GET[$key] ?? '';
    return is_string($value) ? trim($value) : '';
}
