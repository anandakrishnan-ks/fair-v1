import Link from 'next/link';
import { notFound } from 'next/navigation';
import { COURSES } from '@/lib/data';

export default async function CoursePage({ params }) {
  const { courseId } = await params;
  const course = COURSES[courseId];

  if (!course) {
    notFound();
  }

  return (
    <div className="container py-5 my-5">
      <div className="text-center mb-5">
        <p className="eyebrow">{course.category}</p>
        <h1 className="display-4 mb-3">{course.title}</h1>
        <p className="text-white mx-auto" style={{ maxWidth: '600px' }}>
          {course.subtitle} Select your preferred audio language to begin the session.
        </p>
      </div>

      <div className="row g-4 justify-content-center max-w-4xl mx-auto">
        {Object.entries(course.languages).map(([langKey, langObj]) => (
          <div className="col-sm-6 col-lg-3" key={langKey}>
            <Link className="language-card text-decoration-none text-center h-100" href={`/course/${courseId}/video/${langKey}`}>
              <div className="language-card-inner">
                <i className={`bi ${langObj.icon} language-icon`}></i>
                <h3 className="h5 mb-0 text-white">{langObj.label}</h3>
                <div className="language-footer mt-4">
                  <small>Play Video</small>
                  <i className="bi bi-play-circle-fill text-white"></i>
                </div>
              </div>
            </Link>
          </div>
        ))}
      </div>
    </div>
  );
}
