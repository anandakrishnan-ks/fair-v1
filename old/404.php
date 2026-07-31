<?php
require_once __DIR__ . '/config.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 • Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Govind+Serif&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="auth-page">
    <div class="auth-shell">
        <div class="auth-card text-center">
            <div class="brand-mark mx-auto mb-3">FS</div>
            <p class="eyebrow mb-3">404 • Not Found</p>
            <h1 class="display-1 fw-bold mb-3">404</h1>
            <h2 class="display-6 mb-3">The video or page you're looking for doesn't exist.</h2>
            <p class="text-white mb-4">The video file has not been uploaded to the server yet.</p>
            <p class="text-white mb-0"><a href="index.php?key=<?= urlencode(ACCESS_KEY) ?>" class="text-white">Go back to Homepage</a></p>
        </div>
    </div>
</body>
</html>
