<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/check_access.php';

$courseId = getQueryString('course');
$language = getQueryString('lang');

$course = getCourse($courseId);
if (!$course || !array_key_exists($language, $course['languages'])) {
    header('Location: index.php?key=' . urlencode(ACCESS_KEY));
    exit;
}

$videoPath = getVideoPath($courseId, $language);
if (!is_file($videoPath) || !is_readable($videoPath)) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$videoUrl = 'stream.php?id=' . urlencode($courseId) . '&lang=' . urlencode($language) . '&key=' . urlencode(ACCESS_KEY);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($course['title']) ?> • <?= htmlspecialchars($course['languages'][$language]['label']) ?></title>
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
        <div class="row g-4 align-items-start">
            <div class="col-lg-8">
                <div class="video-shell" data-aos="fade-up">
                    <video id="luxuryVideo" class="video-player" controls controlsList="nodownload noplaybackrate nofullscreen" preload="metadata" playsinline>
                        <source src="<?= htmlspecialchars($videoUrl) ?>" type="video/mp4">
                    </video>
                    <div class="video-overlay">
                        <div class="watermark" id="watermark"><?= htmlspecialchars(currentCampaign()) ?> • <?= date('d M Y') ?> • <?= date('H:i') ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="video-panel" data-aos="fade-left">
                    <p class="eyebrow">Now playing</p>
                    <h2 class="display-6"><?= htmlspecialchars($course['title']) ?></h2>
                    <p class="text-white">Language: <strong><?= htmlspecialchars($course['languages'][$language]['label']) ?></strong></p>
                    <p class="text-white">Duration: <strong><?= htmlspecialchars($course['duration']) ?></strong></p>
                    <div class="progress-bar mt-4">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                    <p class="small text-white mt-3" id="progressText">0% watched</p>
                    <div class="d-flex gap-2 mt-4">
                        <a class="btn btn-outline-light" href="language.php?course=<?= urlencode($courseId) ?>&key=<?= urlencode(ACCESS_KEY) ?>">Choose another language</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.addEventListener('keydown', function (e) {
            if (e.keyCode === 123 || (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74 || e.keyCode === 67)) || (e.ctrlKey && (e.keyCode === 85 || e.keyCode === 83))) {
                e.preventDefault();
            }
        });
        window.addEventListener('blur', function() {
            var video = document.getElementById('luxuryVideo');
            if (video && !video.paused) { video.pause(); }
        });
        const watermark = document.getElementById('watermark');
        const videoShell = document.querySelector('.video-shell');
        function moveWatermark() {
            if (!watermark || !videoShell) return;
            const maxX = videoShell.clientWidth - watermark.clientWidth;
            const maxY = videoShell.clientHeight - watermark.clientHeight;
            watermark.style.transform = `translate(${Math.max(0, Math.floor(Math.random() * maxX))}px, ${Math.max(0, Math.floor(Math.random() * maxY))}px)`;
            watermark.style.position = 'absolute';
            watermark.style.transition = 'transform 3s linear';
        }
        setInterval(moveWatermark, 3000);
        window.addEventListener('resize', moveWatermark);
        setTimeout(moveWatermark, 100);
    </script>
</body>
</html>
