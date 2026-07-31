import { NextResponse } from 'next/server';
import fs from 'fs';
import path from 'path';

export async function GET(request) {
  const url = request.nextUrl;
  const courseId = url.searchParams.get('courseId');
  const language = url.searchParams.get('language');

  if (!courseId || !language) {
    return new NextResponse('Missing parameters', { status: 400 });
  }

  // Ensure the user has the access cookie (middleware already checks this, but extra safety)
  const cookieKey = request.cookies.get('access_key')?.value;
  if (cookieKey !== 'fair2026') {
    return new NextResponse('Unauthorized', { status: 401 });
  }

  const fileName = `${courseId}-${language}.mp4`;
  // Path to the old assets directory where videos are stored
  const filePath = path.join(process.cwd(), 'old', 'assets', 'videos', fileName);

  try {
    const stat = fs.statSync(filePath);
    const fileSize = stat.size;
    const range = request.headers.get('range');

    if (range) {
      const parts = range.replace(/bytes=/, '').split('-');
      const start = parseInt(parts[0], 10);
      const end = parts[1] ? parseInt(parts[1], 10) : fileSize - 1;
      const chunksize = (end - start) + 1;
      const file = fs.createReadStream(filePath, { start, end });
      const head = {
        'Content-Range': `bytes ${start}-${end}/${fileSize}`,
        'Accept-Ranges': 'bytes',
        'Content-Length': chunksize,
        'Content-Type': 'video/mp4',
      };
      
      // Node.js Streams to Web Streams adapter
      const readableWebStream = new ReadableStream({
        start(controller) {
          file.on('data', (chunk) => controller.enqueue(chunk));
          file.on('end', () => controller.close());
          file.on('error', (err) => controller.error(err));
        },
        cancel() {
          file.destroy();
        },
      });

      return new NextResponse(readableWebStream, { status: 206, headers: head });
    } else {
      const head = {
        'Content-Length': fileSize,
        'Content-Type': 'video/mp4',
      };
      
      const file = fs.createReadStream(filePath);
      const readableWebStream = new ReadableStream({
        start(controller) {
          file.on('data', (chunk) => controller.enqueue(chunk));
          file.on('end', () => controller.close());
          file.on('error', (err) => controller.error(err));
        },
        cancel() {
          file.destroy();
        },
      });

      return new NextResponse(readableWebStream, { status: 200, headers: head });
    }
  } catch (error) {
    console.error('Error streaming video:', error);
    return new NextResponse('Video not found', { status: 404 });
  }
}
