<?php
require_once __DIR__ . '/../config.php';

const VIDEO_DIR = __DIR__ . '/../assets/videos';

/** The content catalog is intentionally hard-coded for this fixed client project. */
$COURSES = [
    'hair-coloring' => [
        'title' => 'Hair Coloring',
        'subtitle' => 'Precision color artistry for luminous, modern finishes.',
        'blurb' => 'Discover sculpted transformations, soft dimension, and premium color maintenance.',
        'languages' => [
            'en' => ['label' => 'English', 'icon' => 'bi-globe2'],
            'ml' => ['label' => 'Malayalam', 'icon' => 'bi-flower1'],
            'hi' => ['label' => 'Hindi', 'icon' => 'bi-stars'],
            'ta' => ['label' => 'Tamil', 'icon' => 'bi-sun']
        ],
        'duration' => '18 mins',
        'category' => 'Hair Coloring'
    ],
    'hair-care' => [
        'title' => 'Hair Care',
        'subtitle' => 'Elevated rituals for strength, shine, and preservation.',
        'blurb' => 'Learn refined scalp, repair, and finishing techniques that feel indulgent.',
        'languages' => [
            'en' => ['label' => 'English', 'icon' => 'bi-globe2'],
            'ml' => ['label' => 'Malayalam', 'icon' => 'bi-flower1'],
            'hi' => ['label' => 'Hindi', 'icon' => 'bi-stars'],
            'ta' => ['label' => 'Tamil', 'icon' => 'bi-sun']
        ],
        'duration' => '14 mins',
        'category' => 'Hair Care'
    ]
];

function courseList(): array
{
    global $COURSES;
    return $COURSES;
}

function getCourse(string $courseId): ?array
{
    global $COURSES;
    return $COURSES[$courseId] ?? null;
}

function getVideoFile(string $courseId, string $language): string
{
    return $courseId . '-' . $language . '.mp4';
}

function getVideoPath(string $courseId, string $language): string
{
    return VIDEO_DIR . DIRECTORY_SEPARATOR . getVideoFile($courseId, $language);
}

function currentCampaign(): string
{
    return 'Fair Salon & Spa';
}
