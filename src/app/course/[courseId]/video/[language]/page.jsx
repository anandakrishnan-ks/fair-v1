'use client';

import { useEffect, useRef, useState, use } from 'react';
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
      if (videoRef.current && !videoRef.current.paused) {
        videoRef.current.pause();
      }
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
          <video 
            ref={videoRef}
            className="video-player"
            controls
            controlsList="nodownload"
            disablePictureInPicture
            src={`/api/stream?courseId=${courseId}&language=${language}`}
          >
            Your browser does not support HTML5 video.
          </video>
          <div className="video-overlay">
            <div className="watermark">fair2026</div>
          </div>
        </div>
      </div>
    </div>
  );
}
