<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/check_access.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAIR PROFESSIONAL SALON SPA</title>
    <meta name="description" content="An exclusive luxury hair education experience in Trivandrum.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Govind+Serif&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg glass-nav px-3 px-lg-5 py-1">
            <a class="navbar-brand d-flex align-items-center gap-3" href="index.php">
               <img src="./assets/img/logo.png" alt="Fair Salon &amp; Spa" width="100" srcset="./assets/img/logo.png">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                <ul class="navbar-nav align-items-lg-center gap-lg-3">
                    <li class="nav-item"><a class="nav-link btn btn-luxury btn-sm px-4" href="#collections">Explore Programs</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-section">
            <div class="hero-overlay"></div>
            <div class="container hero-content">
                <div class="row align-items-center gy-5">
                    <div class="col-lg-7" data-aos="fade-up">
                        <p class="eyebrow">Luxury Hair Education • Trivandrum</p>
                        <h1 class="display-1 mb-4">Professional Hair Education</h1>
                        <p class="hero-copy">Master elevated hair coloring and hair care techniques through a cinematic, private-learning experience crafted for modern salons.</p>
                        <div class="hero-actions d-flex flex-wrap gap-3 mt-4">
                            <a class="btn btn-luxury px-4 py-3" href="#collections">Explore Programs</a>
                            <a class="btn btn-outline-light px-4 py-3" href="#collections">Explore Programs</a>
                        </div>
                    </div>
                    <div class="col-lg-5" data-aos="fade-left">
                        <div class="hero-card">
                            <div class="hero-card-inner">
                                <p class="card-label">Private Salon Library</p>
                                <h3 class="mb-3">Curated methods for color precision and hair longevity.</h3>
                                <p class="mb-0 text-white">Refined education, immersive styling, and premium amenities—delivered in a black-tie digital environment.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="collections" class="container py-5 my-5">
            <div class="row g-4">
                <div class="col-md-6" data-aos="fade-up">
                    <a class="collection-card text-decoration-none" href="language.php?course=hair-coloring&key=<?= urlencode(ACCESS_KEY) ?>">
                        <div class="collection-card-inner">
                            <div class="icon-wrap"><i class="bi bi-brush"></i></div>
                            <h2>Hair Coloring</h2>
                            <p>Explore modern color artistry, formulation, and luminous finishing techniques.</p>
                            <span class="learn-more">Discover the collection</span>
                        </div>
                    </a>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="150">
                    <a class="collection-card text-decoration-none" href="language.php?course=hair-care&key=<?= urlencode(ACCESS_KEY) ?>">
                        <div class="collection-card-inner">
                            <div class="icon-wrap"><i class="bi bi-flower1"></i></div>
                            <h2>Hair Care</h2>
                            <p>Learn restorative rituals, scalp care, and premium maintenance protocols.</p>
                            <span class="learn-more">Discover the collection</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
