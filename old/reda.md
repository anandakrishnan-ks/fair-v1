# Fair Salon & Spa - Video Platform

## Description
A lightweight, secure PHP-based video streaming platform for Fair Salon & Spa. It is designed to provide access to educational courses (Hair Care and Hair Coloring) in multiple languages (English, Malayalam, Hindi, Tamil) without the need for a complex database, user accounts, or login system. 

Access is granted through a simple, secure URL key (`?key=fair2026`). 

## Key Features
- **Key-Based Access:** Simple authentication via a URL parameter.
- **Anti-Piracy Measures:** 
  - Dynamic moving watermark to deter screen recording.
  - Disabled right-click (context menu).
  - Blocked developer tools shortcuts (F12, Ctrl+Shift+I, etc.).
  - Auto-pause when the browser window loses focus.
- **Secure Video Streaming:** Direct access to `.mp4` files is blocked via `.htaccess`. Videos are securely streamed in chunks using a dedicated PHP script (`stream.php`).
- **Multilingual Support:** Video content available in English, Malayalam, Hindi, and Tamil.
- **No Database Required:** Hard-coded courses and configuration for maximum simplicity and portability.

## Project Structure
- `index.php`: Course selection page.
- `language.php`: Language selection page.
- `video.php`: Video player with anti-piracy scripts.
- `stream.php`: Secure video chunk streamer.
- `config.php`: Central configuration storing the access key.
