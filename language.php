<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/check_access.php';

$courseId = getQueryString('course');
$course = getCourse($courseId);
if (!$course) {
    header('Location: index.php?key=' . urlencode(ACCESS_KEY));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($course['title']) ?> • Language</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Govind+Serif&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg glass-nav px-3 px-lg-5 py-3">
            <a class="navbar-brand d-flex align-items-center gap-3" href="index.php?key=<?= urlencode(ACCESS_KEY) ?>">
                <span class="brand-mark">FS</span>
                <span class="brand-name">Fair Salon &amp; Spa</span>
            </a>
        </nav>
    </header>

    <section class="container py-5">
        <div class="section-heading text-center mb-5" data-aos="fade-up">
            <p class="eyebrow">Select your language</p>
            <h2 class="display-5"><?= htmlspecialchars($course['title']) ?></h2>
            <p class="text-white mt-3">Choose the language that matches your salon practice and comfort.</p>
        </div>

        <div class="row g-4">
            <?php foreach ($course['languages'] as $code => $language): ?>
                <div class="col-sm-6 col-lg-3" data-aos="fade-up">
                    <a class="language-card text-decoration-none" href="video.php?course=<?= urlencode($courseId) ?>&lang=<?= urlencode($code) ?>&key=<?= urlencode(ACCESS_KEY) ?>">
                        <div class="language-card-inner">
                            <i class="bi <?= htmlspecialchars($language['icon']) ?> language-icon"></i>
                            <h3><?= htmlspecialchars($language['label']) ?></h3>
                            <p><?= htmlspecialchars($course['subtitle']) ?></p>
                            <div class="language-footer">
                                <span>Play lesson</span>
                                <i class="bi bi-play-circle"></i>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
