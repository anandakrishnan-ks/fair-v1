import { NextResponse } from 'next/server';

export function proxy(request) {
  const url = request.nextUrl;
  
  const queryKey = url.searchParams.get('key');
  const cookieKey = request.cookies.get('access_key')?.value;
  
  if (queryKey === 'fair2026') {
    const response = NextResponse.next();
    response.cookies.set('access_key', 'fair2026', { path: '/', httpOnly: true });
    return response;
  }
  
  if (cookieKey === 'fair2026') {
    return NextResponse.next();
  }

  return NextResponse.redirect(new URL('/denied', request.url));
}

export const config = {
  matcher: ['/', '/course/:path*'],
};
