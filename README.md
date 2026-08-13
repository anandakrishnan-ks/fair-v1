# FAIR — Hair Education Platform

> Trivandrum's most famous and Asia's biggest hair salon, **FAIR**, brings professional hair knowledge directly to you.

This web platform is built to educate and inform customers about the latest in **hair care**, **hair treatment**, and **hair coloring** — curated by the expert stylists at FAIR.

---

## About

FAIR is a premium hair salon based in Trivandrum, Kerala, recognized as one of Asia's largest and most reputed hair care institutions. This platform serves as a digital learning hub where customers can access exclusive video courses on hair care, coloring techniques, and treatment methods — available in multiple languages.

## Tech Stack

- **Framework:** [Next.js](https://nextjs.org) (App Router)
- **Styling:** Bootstrap 5 + Custom CSS
- **Video Streaming:** Node.js streaming API (range-request support)
- **Auth:** Cookie-based access control

## Getting Started

```bash
npm install
npm run dev
```

Open [http://localhost:3000](http://localhost:3000) to view the app.

## Video Setup

Place course videos in the `/videos` folder at the project root, named using the pattern:

```
{courseId}-{language}.mp4
```

Example: `hair-coloring-ml.mp4`, `hair-care-en.mp4`
