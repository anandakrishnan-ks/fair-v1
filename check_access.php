<?php
require_once __DIR__ . '/config.php';

if (getQueryString('key') !== ACCESS_KEY) {
    header('Location: denied.php');
    exit;
}

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
