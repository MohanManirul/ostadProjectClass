import { verify } from 'jsonwebtoken';
import { headers } from 'next/headers';

const JWT_SECRET = process.env.JWT_SECRET || 'your-secret-key';

export async function verifyAuth(req: Request) {
  const headersList = headers();
  const authorization = headersList.get('authorization');

  if (!authorization || !authorization.startsWith('Bearer ')) {
    return null;
  }

  const token = authorization.split(' ')[1];

  try {
    const decoded = verify(token, JWT_SECRET);
    return decoded as { userId: string; username: string };
  } catch (error) {
    return null;
  }
}