'use client';

import { useEffect, useRef, use } from 'react';
import Link from 'next/link';
import { notFound } from 'next/navigation';
import { COURSES } from '@/lib/data';

export default function VideoPage({ params }) {
  const { courseId, language } = use(params);
  const course = COURSES[courseId];
  
  if (!course || !course.languages[language]) {
    notFound();
  }
  
  const videoRef = useRef(null);
  
  useEffect(() => {
    // Anti-Piracy: Pause on window blur
    const handleBlur = () => {
      videoRef.current?.contentWindow?.postMessage(
        JSON.stringify({ event: 'command', func: 'pauseVideo', args: [] }),
        'https://www.youtube-nocookie.com'
      );
    };
    
    // Anti-Piracy: Prevent dev tools shortcuts
    const handleKeyDown = (e) => {
      if (
        e.key === 'F12' || 
        (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'C' || e.key === 'J')) ||
        (e.ctrlKey && (e.key === 'U' || e.key === 'S'))
      ) {
        e.preventDefault();
      }
    };
    
    // Anti-Piracy: Prevent right-click context menu
    const handleContextMenu = (e) => {
      e.preventDefault();
    };

    window.addEventListener('blur', handleBlur);
    window.addEventListener('keydown', handleKeyDown);
    document.addEventListener('contextmenu', handleContextMenu);

    return () => {
      window.removeEventListener('blur', handleBlur);
      window.removeEventListener('keydown', handleKeyDown);
      document.removeEventListener('contextmenu', handleContextMenu);
    };
  }, []);

  return (
    <div className="container py-4">
      <div className="d-flex align-items-center mb-4 gap-3">
        <Link href={`/course/${courseId}`} className="btn btn-outline-light btn-sm rounded-circle p-2 lh-1">
          <i className="bi bi-arrow-left"></i>
        </Link>
        <div>
          <h1 className="h4 mb-0">{course.title}</h1>
          <p className="text-muted small mb-0">{course.languages[language].label} Edition</p>
        </div>
      </div>

      <div className="video-panel">
        <div className="video-shell">
          <div className="video-player">
            <iframe
              ref={videoRef}
              className="video-embed"
              src={`https://www.youtube-nocookie.com/embed/${course.languages[language].videoId}?controls=1&rel=0&playsinline=1&iv_load_policy=3&enablejsapi=1`}
              title={`${course.languages[language].label} hair care video`}
              allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowFullScreen
            />
          </div>
          <div className="video-overlay">
            <div className="watermark">fair2026</div>
          </div>
        </div>
      </div>
    </div>
  );
}
