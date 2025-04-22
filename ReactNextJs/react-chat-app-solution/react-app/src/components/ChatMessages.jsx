import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { Send, Upload } from 'lucide-react';
import { useState } from 'react';
import api from '../api/axios';
import { format } from 'date-fns';
import toast from 'react-hot-toast';
import { useAuth } from '../context/AuthContext';

export default function ChatMessages({ chatId }) {
  const [message, setMessage] = useState('');
  const [file, setFile] = useState(null);
  const queryClient = useQueryClient();
  const { user } = useAuth();

  const { data: messages, isLoading } = useQuery({
    queryKey: ['messages', chatId],
    queryFn: async () => {
      const response = await api.get(`/messages?chatId=${chatId}`);
      return response.data;
    },
    enabled: !!chatId,
    refetchInterval: 1000
  });

  const sendMessage = useMutation({
    mutationFn: async (data) => {
      if (file) {
        const formData = new FormData();
        formData.append('file', file);
        formData.append('uploadedBy', user.id);
        const uploadResponse = await api.post('/upload', formData);
        data.type = 'file';
        data.content = uploadResponse.data.path;
      }
      return api.post('/messages', {
        ...data,
        senderId: user.id
      });
    },
    onSuccess: () => {
      queryClient.invalidateQueries(['messages', chatId]);
      setMessage('');
      setFile(null);
    },
    onError: (error) => {
      toast.error(error.response?.data?.error || 'Failed to send message');
    }
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!message && !file) return;

    sendMessage.mutate({
      chatId,
      content: message,
      type: 'text'
    });
  };

  if (!chatId) {
    return <div className="p-4">Select a chat to start messaging</div>;
  }

  if (isLoading) {
    return <div className="p-4">Loading messages...</div>;
  }

  return (
    <div className="flex flex-col h-full">
      <div className="flex-1 overflow-y-auto p-4 space-y-4">
        {messages?.map((msg) => (
          <div 
            key={msg.id} 
            className={`flex flex-col ${msg.senderId === user.id ? 'items-end' : 'items-start'}`}
          >
            <div className={`flex items-start space-x-2 max-w-[70%] ${
              msg.senderId === user.id ? 'bg-blue-500 text-white' : 'bg-gray-100'
            } rounded-lg p-3`}>
              {msg.type === 'file' ? (
                <a
                  href={msg.content}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="hover:underline"
                >
                  View Attachment
                </a>
              ) : (
                <p>{msg.content}</p>
              )}
            </div>
            <span className="text-xs text-gray-500 mt-1">
              {format(new Date(msg.createdAt), 'PPp')}
            </span>
          </div>
        ))}
      </div>

      <form onSubmit={handleSubmit} className="p-4 border-t">
        <div className="flex items-center space-x-2">
          <input
            type="text"
            value={message}
            onChange={(e) => setMessage(e.target.value)}
            placeholder="Type a message..."
            className="flex-1 rounded-lg border p-2"
          />
          <label className="cursor-pointer">
            <Upload className="w-6 h-6 text-gray-500" />
            <input
              type="file"
              className="hidden"
              onChange={(e) => setFile(e.target.files[0])}
            />
          </label>
          <button
            type="submit"
            className="bg-blue-500 text-white rounded-lg p-2 disabled:opacity-50"
            disabled={(!message && !file) || sendMessage.isPending}
          >
            <Send className="w-5 h-5" />
          </button>
        </div>
        {file && (
          <div className="mt-2 text-sm text-gray-600">
            File selected: {file.name}
          </div>
        )}
      </form>
    </div>
  );
}