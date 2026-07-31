document.addEventListener('DOMContentLoaded', () => {
  if (window.AOS) {
    AOS.init({ duration: 900, once: true, offset: 90 });
  }

  if (window.gsap) {
    gsap.from('.hero-content h1, .hero-content .hero-copy, .hero-content .hero-actions', {
      opacity: 0,
      y: 24,
      duration: 1.2,
      stagger: 0.15,
      ease: 'power3.out'
    });
  }

  const video = document.getElementById('luxuryVideo');
  const progressFill = document.getElementById('progressFill');
  const progressText = document.getElementById('progressText');
  const watermark = document.getElementById('watermark');

  if (video && progressFill) {
    video.addEventListener('timeupdate', () => {
      const percent = Math.round((video.currentTime / video.duration) * 100 || 0);
      progressFill.style.width = `${percent}%`;
      progressText.textContent = `${percent}% watched`;
    });
  }

  if (watermark) {
    setInterval(() => {
      const positions = [
        { top: '18px', left: '18px' },
        { top: '18px', right: '18px' },
        { bottom: '18px', left: '18px' },
        { bottom: '18px', right: '18px' }
      ];
      const next = positions[Math.floor(Math.random() * positions.length)];
      Object.assign(watermark.style, {
        top: 'auto',
        right: 'auto',
        bottom: 'auto',
        left: 'auto'
      }, next);
    }, 5000);
  }

  document.addEventListener('contextmenu', (event) => event.preventDefault());
  document.addEventListener('dragstart', (event) => event.preventDefault());
  document.addEventListener('drop', (event) => event.preventDefault());
  document.addEventListener('selectstart', (event) => event.preventDefault());

  document.addEventListener('keydown', (event) => {
    const blocked = [
      's', 'u', 'p', 'i', 'j', 'F12'
    ];
    if ((event.ctrlKey || event.metaKey) && blocked.includes(event.key.toLowerCase())) {
      event.preventDefault();
      return;
    }
    if (event.key === 'F12') {
      event.preventDefault();
    }
  });
});
