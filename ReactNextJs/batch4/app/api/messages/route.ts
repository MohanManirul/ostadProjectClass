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

    const { searchParams } = new URL(req.url);
    const chatId = searchParams.get('chatId');

    if (!chatId) {
      return NextResponse.json(
        { error: 'Chat ID is required' },
        { status: 400 }
      );
    }

    const messagesPath = path.join(process.cwd(), 'data', 'messages.json');
    const messages = JSON.parse(await readFile(messagesPath, 'utf8'));

    const chatMessages = messages.filter((msg: any) => msg.chatId === chatId);
    return NextResponse.json(chatMessages);
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

    const { chatId, content, type = 'text' } = await req.json();

    if (!chatId || !content) {
      return NextResponse.json(
        { error: 'Chat ID and content are required' },
        { status: 400 }
      );
    }

    const messagesPath = path.join(process.cwd(), 'data', 'messages.json');
    let messages = [];
    try {
      messages = JSON.parse(await readFile(messagesPath, 'utf8'));
    } catch (error) {
      // File doesn't exist yet
    }

    const newMessage = {
      id: uuidv4(),
      chatId,
      senderId: user.userId,
      content,
      type,
      status: 'sent',
      createdAt: new Date().toISOString(),
      seenBy: []
    };

    messages.push(newMessage);
    await writeFile(messagesPath, JSON.stringify(messages, null, 2));

    return NextResponse.json(newMessage);
  } catch (error) {
    return NextResponse.json(
      { error: 'Internal server error' },
      { status: 500 }
    );
  }
}