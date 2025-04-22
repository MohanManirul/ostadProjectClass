import { useQuery } from '@tanstack/react-query';
import { MessageSquare } from 'lucide-react';
import api from '../api/axios';
import { format } from 'date-fns';
import { useAuth } from '../context/AuthContext';

export default function ChatList({ onSelectChat, selectedChatId }) {
  const { user } = useAuth();

  const { data: chats, isLoading, error } = useQuery({
    queryKey: ['chats', user?.id],
    queryFn: async () => {
      const response = await api.get(`/chats?userId=${user.id}`);
      return response.data;
    },
    refetchInterval: 1000,
    staleTime: 0,
    cacheTime: 0,
    enabled: !!user?.id
  });

  if (isLoading) {
    return <div className="p-4">Loading chats...</div>;
  }

  if (error) {
    return <div className="p-4 text-red-500">Error loading chats: {error.message}</div>;
  }

  return (
    <div className="bg-white rounded-lg shadow">
      <div className="p-4 border-b">
        <h2 className="text-lg font-semibold">Chats</h2>
      </div>
      <div className="divide-y max-h-[calc(100vh-200px)] overflow-y-auto">
        {chats?.length === 0 && (
          <div className="p-4 text-gray-500 text-center">No chats yet</div>
        )}
        {chats?.map((chat) => (
          <div
            key={chat.id}
            onClick={() => onSelectChat(chat)}
            className={`p-4 hover:bg-gray-50 cursor-pointer ${
              selectedChatId === chat.id ? 'bg-blue-50' : ''
            }`}
          >
            <div className="flex items-center space-x-3">
              <MessageSquare className="w-10 h-10 text-gray-400" />
              <div className="flex-1">
                <h3 className="font-medium">{chat.name || 'Chat'}</h3>
                <p className="text-sm text-gray-500">
                  {format(new Date(chat.createdAt), 'PPp')}
                </p>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}