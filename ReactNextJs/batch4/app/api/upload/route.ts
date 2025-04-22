import { NextResponse } from 'next/server';
import { writeFile } from 'fs/promises';
import path from 'path';
import { v4 as uuidv4 } from 'uuid';
import { verifyAuth } from '@/lib/auth';

export async function POST(req: Request) {
  try {
    const user = await verifyAuth(req);
    if (!user) {
      return NextResponse.json(
        { error: 'Unauthorized' },
        { status: 401 }
      );
    }

    const data = await req.formData();
    const file = data.get('file') as File;

    if (!file) {
      return NextResponse.json(
        { error: 'No file uploaded' },
        { status: 400 }
      );
    }

    // Check file size (50KB limit)
    if (file.size > 50 * 1024) {
      return NextResponse.json(
        { error: 'File size exceeds 50KB limit' },
        { status: 400 }
      );
    }

    const bytes = await file.arrayBuffer();
    const buffer = Buffer.from(bytes);

    const fileName = `${uuidv4()}-${file.name}`;
    const filePath = path.join(process.cwd(), 'public', 'uploads', fileName);
    
    await writeFile(filePath, buffer);

    return NextResponse.json({ 
      url: `/uploads/${fileName}`,
      fileName: file.name,
      size: file.size,
      type: file.type
    });
  } catch (error) {
    return NextResponse.json(
      { error: 'Internal server error' },
      { status: 500 }
    );
  }
}