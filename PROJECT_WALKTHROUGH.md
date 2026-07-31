# Fair Salon & Spa — Project Walkthrough and Server Handoff

## 1. Current status

The project is a small Core PHP video site. It intentionally has no:

- Login or password system
- Database or user accounts
- Admin panel or CMS
- Upload system
- Course-management API
- Dynamic language-management system

The permanent content is hard-coded:

- 2 courses: Hair Care and Hair Coloring
- 4 languages: English, Malayalam, Hindi, and Tamil
- 8 permanent MP4 videos

The current working copy is configured for local WAMP development only.

## 2. Required visitor flow

```text
Receive Link
    ↓
https://{domain-name}/fair/index.php?key=fair2026
    ↓
Validate key in check_access.php
    ↓
Select course
    ↓
Select language
    ↓
Play protected video through stream.php
```

All internal links automatically append `?key=fair2026` to allow seamless navigation and easy sharing.

## 3. Access Link for the next server phase

Use this production URL format for sharing:

```text
https://{domain-name}/fair/index.php?key=fair2026
```

The key is defined as `ACCESS_KEY` in `config.php`.

Local QA URL:

```text
http://localhost/fair/index.php?key=fair2026
```

## 4. Application files

- `check_access.php` — single guard included by every protected page. It verifies `?key=...` matches the `ACCESS_KEY`.
- `index.php` — protected homepage and course selection.
- `language.php` — protected language selection.
- `video.php` — protected video player page with Javascript security deterrents.
- `stream.php` — protected MP4 delivery with byte-range support and chunked output.
- `denied.php` — public access-denied page.
- `404.php` — public not-found/missing-content page.
- `config.php` — central configuration containing the `ACCESS_KEY`.
- `includes/functions.php` — fixed course catalog and video mappings.
- `.htaccess` — security headers, dotfile protection, and sensitive-file protection.
- `assets/videos/.htaccess` — prevents direct public MP4 access.

## 5. URL Security and Anti-Piracy

To make link sharing as easy as possible while deterring casual piracy, the project uses the following techniques:

- **Security Through Obscurity (URL Access Key):** No sessions or database are required. Users must simply append `?key=fair2026` to the URL.
- **Dynamic Moving Watermark:** The video player features a watermark overlay that randomly bounces around the video every 3 seconds to deter screen recording.
- **Context Menu Block:** Right-clicking on the video page is disabled.
- **DevTools Block:** Keyboard shortcuts (`F12`, `Ctrl+Shift+I`, `Ctrl+U`, `Ctrl+S`) are intercepted and disabled to deter users from inspecting the page source.
- **Pause on Blur:** The video automatically pauses if the browser window loses focus.
- **Obscured Source:** Direct access to `.mp4` files is blocked by `assets/videos/.htaccess`. Files are streamed securely through `stream.php`.

## 6. Video files

Place the real permanent MP4 files in `assets/videos/` with exactly these names:

```text
hair-coloring-en.mp4
hair-coloring-ml.mp4
hair-coloring-hi.mp4
hair-coloring-ta.mp4
hair-care-en.mp4
hair-care-ml.mp4
hair-care-hi.mp4
hair-care-ta.mp4
```

The current repository contains no real MP4 files yet. The application correctly returns HTTP 404 for a missing video, but real browser playback cannot be completed until these eight files are supplied.

## 7. Local QA completed

The following tests were run against the local WAMP Apache/PHP installation:

- Valid access key URL loads `index.php`.
- Homepage works and successfully links to the language page.
- Direct homepage access without key redirects to Access Denied.
- Direct video access without key redirects to Access Denied.
- Stream access without key redirects to Access Denied.
- Attempting to right-click or use F12 on the video page is blocked.
- Watermark moves continuously.
- Direct MP4, `.git`, `.env`, and `error_log` requests return HTTP 403.
- All PHP files pass PHP 8.3 syntax checks.

## 8. Production server phase

Before the next server deployment:

1. Upload the PHP files, CSS, JavaScript, images, fonts, and all eight MP4s.
2. Enable HTTPS.
3. Enable Apache `AllowOverride` so both `.htaccess` files are honored.
4. Confirm `assets/videos/*.mp4`, `.git`, `.env`, and `error_log` cannot be downloaded.
5. Verify the full flow on desktop and mobile.

## 9. Known limitations

- The URL with the key can be freely shared by anyone.
- While the JavaScript deterrents prevent average users from saving the video, a determined user with technical knowledge or third-party extensions can still bypass these restrictions or screen-record the video. Fully unbreakable DRM requires a licensed media server (e.g., Widevine).
- Real MP4 assets are still required before the project can be declared fully functional.
