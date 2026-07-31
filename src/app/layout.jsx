import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.min.css';
import './globals.css';
import Script from 'next/script';
import Link from 'next/link';
import { Poppins } from 'next/font/google';

const poppins = Poppins({
  weight: ['300', '400', '500', '600', '700'],
  subsets: ['latin'],
  display: 'swap',
  variable: '--font-poppins',
});

export const metadata = {
  title: 'FAIR PROFESSIONAL SALON SPA',
  description: 'An exclusive luxury hair education experience in Trivandrum.',
};

export default function RootLayout({ children }) {
  return (
    <html lang="en" className={poppins.className}>
      <body>
        <header className="sticky-top">
          <nav className="navbar navbar-expand-lg glass-nav px-3 px-lg-5 py-1">
            <Link className="navbar-brand d-flex align-items-center gap-3" href="/">
               <img src="/img/logo.png" alt="Fair Salon & Spa" width="100" />
            </Link>
            <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span className="navbar-toggler-icon"></span>
            </button>
            <div className="collapse navbar-collapse justify-content-end" id="navMenu">
                <ul className="navbar-nav align-items-lg-center gap-lg-3">
                    <li className="nav-item">
                      <Link className="nav-link btn btn-luxury btn-sm px-4" href="/#collections">Explore Programs</Link>
                    </li>
                </ul>
            </div>
          </nav>
        </header>

        <main>{children}</main>

        <Script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" strategy="lazyOnload" />
      </body>
    </html>
  );
}
