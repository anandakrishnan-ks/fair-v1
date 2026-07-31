import Link from 'next/link';

export default function Denied() {
  return (
    <div className="auth-page auth-shell">
      <div className="auth-card text-center">
        <i className="bi bi-shield-lock display-4 mb-3 d-block text-white"></i>
        <h2 className="mb-3">Access Denied</h2>
        <p className="text-muted mb-4">You must have a valid invitation link to access this private platform.</p>
      </div>
    </div>
  );
}
