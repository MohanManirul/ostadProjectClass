import { NextResponse } from 'next/server';
import { readFile } from 'fs/promises';
import path from 'path';
import { sign } from 'jsonwebtoken';

const JWT_SECRET = process.env.JWT_SECRET || 'your-secret-key';

export async function POST(req: Request) {
  try {
    const { username, password } = await req.json();
    
    if (!username || !password) {
      return NextResponse.json(
        { error: 'Username and password are required' },
        { status: 400 }
      );
    }

    const usersPath = path.join(process.cwd(), 'data', 'users.json');
    const users = JSON.parse(await readFile(usersPath, 'utf8'));

    const user = users.find((u: any) => u.username === username && u.password === password);
    
    if (!user) {
      return NextResponse.json(
        { error: 'Invalid credentials' },
        { status: 401 }
      );
    }

    const token = sign({ userId: user.id, username: user.username }, JWT_SECRET, {
      expiresIn: '24h'
    });

    return NextResponse.json({ token });
  } catch (error) {
    return NextResponse.json(
      { error: 'Internal server error' },
      { status: 500 }
    );
  }
}