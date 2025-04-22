import { NextResponse } from 'next/server';
import { writeFile, readFile } from 'fs/promises';
import path from 'path';
import { v4 as uuidv4 } from 'uuid';

export async function POST(req: Request) {
  try {
    const { username, password } = await req.json();
    
    if (!username || !password) {
      return NextResponse.json(
        { error: 'Username and password are required' },
        { status: 400 }
      );
    }

    const dataPath = path.join(process.cwd(), 'data');
    const usersPath = path.join(dataPath, 'users.json');
    
    let users = [];
    try {
      const data = await readFile(usersPath, 'utf8');
      users = JSON.parse(data);
    } catch (error) {
      // File doesn't exist yet, will create it
    }

    // Check if username already exists
    if (users.some((user: any) => user.username === username)) {
      return NextResponse.json(
        { error: 'Username already exists' },
        { status: 400 }
      );
    }

    const newUser = {
      id: uuidv4(),
      username,
      password, // In production, this should be hashed!
      createdAt: new Date().toISOString()
    };

    users.push(newUser);
    await writeFile(usersPath, JSON.stringify(users, null, 2));

    const { password: _, ...userWithoutPassword } = newUser;
    return NextResponse.json(userWithoutPassword);
  } catch (error) {
    return NextResponse.json(
      { error: 'Internal server error' },
      { status: 500 }
    );
  }
}