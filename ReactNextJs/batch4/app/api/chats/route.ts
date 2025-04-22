import { NextResponse } from 'next/server';
import { readFile, writeFile } from 'fs/promises';
import path from 'path';
import { v4 as uuidv4 } from 'uuid';
import { verifyAuth } from '@/lib/auth';

export async function GET(req: Request) {
  try {
    const user = await verifyAuth(req);
    if (!user) {
      return NextResponse.json(
        { error: 'Unauthorized' },
        { status: 401 }
      );
    }

    const chatsPath = path.join(process.cwd(), 'data', 'chats.json');
    const chats = JSON.parse(await readFile(chatsPath, 'utf8'));

    // Filter chats where the user is a participant
    const userChats = chats.filter((chat: any) => 
      chat.participants.includes(user.userId)
    );

    return NextResponse.json(userChats);
  } catch (error) {
    return NextResponse.json(
      { error: 'Internal server error' },
      { status: 500 }
    );
  }
}

export async function POST(req: Request) {
  try {
    const user = await verifyAuth(req);
    if (!user) {
      return NextResponse.json(
        { error: 'Unauthorized' },
        { status: 401 }
      );
    }

    const { name, participants, type = 'individual' } = await req.json();

    if (!participants || !Array.isArray(participants)) {
      return NextResponse.json(
        { error: 'Participants array is required' },
        { status: 400 }
      );
    }

    const chatsPath = path.join(process.cwd(), 'data', 'chats.json');
    let chats = [];
    try {
      chats = JSON.parse(await readFile(chatsPath, 'utf8'));
    } catch (error) {
      // File doesn't exist yet
    }

    // For individual chats, check if chat already exists
    if (type === 'individual' && participants.length === 2) {
      const existingChat = chats.find((chat: any) => 
        chat.type === 'individual' &&
        chat.participants.length === 2 &&
        chat.participants.includes(participants[0]) &&
        chat.participants.includes(participants[1])
      );

      if (existingChat) {
        return NextResponse.json(existingChat);
      }
    }

    const newChat = {
      id: uuidv4(),
      name: name || null,
      type,
      participants,
      createdBy: user.userId,
      createdAt: new Date().toISOString()
    };

    chats.push(newChat);
    await writeFile(chatsPath, JSON.stringify(chats, null, 2));

    return NextResponse.json(newChat);
  } catch (error) {
    return NextResponse.json(
      { error: 'Internal server error' },
      { status: 500 }
    );
  }
}