<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/check_access.php';

$courseId = getQueryString('id');
$language = getQueryString('lang');

if (!preg_match('/^[a-z0-9\-]+$/i', $courseId) || !preg_match('/^[a-z]+$/i', $language)) {
    http_response_code(400);
    exit('Invalid request.');
}

$course = getCourse($courseId);
if (!$course) {
    http_response_code(404);
    exit('Course not found.');
}

if (!array_key_exists($language, $course['languages'])) {
    http_response_code(404);
    exit('Language not found.');
}

$videoPath = getVideoPath($courseId, $language);
if (!is_file($videoPath) || !is_readable($videoPath)) {
    http_response_code(404);
    exit('Video not found.');
}

$fileSize = filesize($videoPath);
if ($fileSize === false || $fileSize <= 0) {
    http_response_code(404);
    exit('Video is empty or unreadable.');
}

$start = 0;
$end = $fileSize - 1;
$status = 200;

if (isset($_SERVER['HTTP_RANGE']) && preg_match('/^bytes=(\d*)-(\d*)$/', $_SERVER['HTTP_RANGE'], $matches)) {
    $rangeStart = $matches[1] === '' ? null : (int) $matches[1];
    $rangeEnd = $matches[2] === '' ? null : (int) $matches[2];

    if ($rangeStart === null && $rangeEnd === null) {
        http_response_code(416);
        header('Content-Range: bytes */' . $fileSize);
        exit;
    }

    if ($rangeStart === null) {
        $suffixLength = min($rangeEnd, $fileSize);
        $start = $fileSize - $suffixLength;
    } else {
        $start = $rangeStart;
    }

    if ($rangeEnd !== null) {
        $end = $rangeEnd;
    }

    if ($start < 0 || $start >= $fileSize || $end < $start) {
        http_response_code(416);
        header('Content-Range: bytes */' . $fileSize);
        exit;
    }

    $end = min($end, $fileSize - 1);
    $status = 206;
}

$length = $end - $start + 1;
http_response_code($status);
header('Content-Type: video/mp4');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('X-Content-Type-Options: nosniff');
header('Accept-Ranges: bytes');
header('Content-Length: ' . $length);
if ($status === 206) {
    header('Content-Range: bytes ' . $start . '-' . $end . '/' . $fileSize);
}
header('Content-Disposition: inline; filename="' . basename($videoPath) . '"');
header('X-Frame-Options: DENY');

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'HEAD') {
    exit;
}

$handle = fopen($videoPath, 'rb');
if ($handle === false) {
    http_response_code(500);
    exit('Unable to open video.');
}

fseek($handle, $start);
set_time_limit(0);
$remaining = $length;
while ($remaining > 0 && !feof($handle)) {
    $chunk = fread($handle, min(1024 * 1024, $remaining));
    if ($chunk === false || $chunk === '') {
        break;
    }
    echo $chunk;
    $remaining -= strlen($chunk);
    flush();
    if (connection_aborted()) {
        break;
    }
}
fclose($handle);
