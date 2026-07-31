import Link from 'next/link';
import { COURSES } from '@/lib/data';

export default function Home() {
  return (
    <>
      <section className="hero-section">
        <div className="hero-overlay"></div>
        <div className="container hero-content">
          <div className="row align-items-center gy-5">
            <div className="col-lg-7">
              <p className="eyebrow">Luxury Hair Education • Trivandrum</p>
              <h1 className="display-1 mb-4">Professional Hair Education</h1>
              <p className="hero-copy">Master elevated hair coloring and hair care techniques through a cinematic, private-learning experience crafted for modern salons.</p>
              <div className="hero-actions d-flex flex-wrap gap-3 mt-4">
                <Link className="btn btn-luxury px-4 py-3" href="#collections">Explore Programs</Link>
                <Link className="btn btn-outline-light px-4 py-3" href="#collections">Explore Programs</Link>
              </div>
            </div>
            <div className="col-lg-5">
              <div className="hero-card">
                <div className="hero-card-inner">
                  <p className="card-label">Private Salon Library</p>
                  <h3 className="mb-3">Curated methods for color precision and hair longevity.</h3>
                  <p className="mb-0 text-white">Refined education, immersive styling, and premium amenities—delivered in a black-tie digital environment.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="collections" className="container py-5 my-5">
        <div className="row g-4">
          <div className="col-md-6">
            <Link className="collection-card text-decoration-none" href="/course/hair-coloring">
              <div className="collection-card-inner">
                <div className="icon-wrap"><i className="bi bi-brush"></i></div>
                <h2>{COURSES['hair-coloring'].title}</h2>
                <p>{COURSES['hair-coloring'].blurb}</p>
                <span className="learn-more">Discover the collection</span>
              </div>
            </Link>
          </div>
          <div className="col-md-6">
            <Link className="collection-card text-decoration-none" href="/course/hair-care">
              <div className="collection-card-inner">
                <div className="icon-wrap"><i className="bi bi-flower1"></i></div>
                <h2>{COURSES['hair-care'].title}</h2>
                <p>{COURSES['hair-care'].blurb}</p>
                <span className="learn-more">Discover the collection</span>
              </div>
            </Link>
          </div>
        </div>
      </section>
    </>
  );
}
